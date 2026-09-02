<?php
session_start();
require_once __DIR__ . '/config.php';

// CSRF validation
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . appUrl('index.php'));
    exit;
}

$submitted_token = $_POST['csrf_token'] ?? '';
$stored_token = $_SESSION['csrf_token'] ?? '';
$token_expire = $_SESSION['token_expire'] ?? 0;

if (!hash_equals($stored_token, $submitted_token) || time() > $token_expire) {
    unset($_SESSION['csrf_token']);
    unset($_SESSION['token_expire']);
    header('Location: ' . appUrl('index.php') . '?error=' . urlencode('Недействительный или истекший CSRF токен'));
    exit;
}

$fio = trim($_POST['fio'] ?? '');
$phone_input = trim($_POST['phone'] ?? '');
$event_date = $_POST['event_date'] ?? '';
$consent = isset($_POST['consent']);
$smart_token = $_POST['smart_token'] ?? '';
$captchaConfig = getCaptchaConfig();

// Basic validation
if (empty($fio) || empty($phone_input) || empty($event_date) || !$consent || ($captchaConfig['enabled'] && empty($smart_token))) {
    header('Location: ' . appUrl('index.php') . '?error=' . urlencode('Заполните все поля и пройдите капчу'));
    exit;
}

// Phone normalization (Russian: to +7XXXXXXXXXX)
$digits = preg_replace('/\D/', '', $phone_input); // Strip non-digits
$normalized_phone = '';

if (strlen($digits) == 11 && ($digits[0] == '7' || $digits[0] == '8')) {
    if ($digits[0] == '8') {
        $normalized_phone = '+7' . substr($digits, 1); // 8 -> +7
    } else {
        $normalized_phone = '+' . $digits; // 7 -> +7
    }
} else {
    header('Location: ' . appUrl('index.php') . '?error=' . urlencode('Неверный формат телефона. Ожидается российский номер (11 цифр, начиная с +7)'));
    exit;
}

// Validate normalized (must be +7 + 10 digits, starting with 9 for mobile)
if (strlen($normalized_phone) !== 12 || substr($normalized_phone, 0, 2) !== '+7' || !preg_match('/^\+7[9]\d{9}$/', $normalized_phone)) {
    header('Location: ' . appUrl('index.php') . '?error=' . urlencode('Неверный российский номер после нормализации'));
    exit;
}

$phone = $normalized_phone;

// Yandex SmartCaptcha
if ($captchaConfig['enabled']) {
    $captcha_url = 'https://smartcaptcha.yandex.net/validate';
    $captcha_data = [
        'secret' => $captchaConfig['secret'],
        'token' => $smart_token,
        'ip' => $_SERVER['REMOTE_ADDR'] ?? ''
    ];
    $captcha_options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($captcha_data)
        ]
    ];
    $captcha_context = stream_context_create($captcha_options);
    $captcha_result = file_get_contents($captcha_url, false, $captcha_context);
    $captcha_json = json_decode($captcha_result, true);
    if (!is_array($captcha_json) || ($captcha_json['status'] ?? '') !== 'ok') {
            header('Location: ' . appUrl('index.php') . '?error=' . urlencode('Капча не пройдена'));
        exit;
    }
}

// DB connection
$dbConfig = getDatabaseConfig();
$dsn = $dbConfig['dsn'];
$user = $dbConfig['user'];
$pass = $dbConfig['pass'];

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("DB connection failed in process.php: " . $e->getMessage());
    header('Location: ' . appUrl('index.php') . '?error=' . urlencode('Ошибка подключения к БД'));
    exit;
}

// Check existing phone
$stmt = $pdo->prepare('SELECT COUNT(*) FROM registrations WHERE phone = ?');
$stmt->execute([$phone]);
if ($stmt->fetchColumn() > 0) {
    header('Location: ' . appUrl('index.php') . '?error=' . urlencode('Вы уже зарегистрированы'));
    exit;
}

// Check capacity
$stmt = $pdo->prepare('SELECT COUNT(*) FROM registrations WHERE event_date = ?');
$stmt->execute([$event_date]);
if ($stmt->fetchColumn() >= 15) {
    header('Location: ' . appUrl('index.php') . '?error=' . urlencode('Места на эту дату заполнены'));
    exit;
}

// Insert
$stmt = $pdo->prepare('INSERT INTO registrations (fio, phone, event_date) VALUES (?, ?, ?)');
$stmt->execute([$fio, $phone, $event_date]);

// Google Sheets append (v4 API)
$sheetsConfig = getSheetsConfig();
if ($sheetsConfig['enabled']) {
    $sheet_id = $sheetsConfig['sheet_id']; // e.g., from URL
    $range = $sheetsConfig['range']; // Headers: FIO | Phone | Date | Time | Created
    $values = [[$fio, $phone, $event_date, '13:00', date('Y-m-d H:i:s')]];
    $post_data = json_encode(['values' => $values]);

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://sheets.googleapis.com/v4/spreadsheets/{$sheet_id}/values/{$range}:append?valueInputOption=RAW&insertDataOption=INSERT_ROWS",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $post_data,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $sheetsConfig['access_token'], // From Google service account
            'Content-Type: application/json'
        ],
    ]);
    $sheet_response = curl_exec($curl);
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($http_code !== 200) {
        error_log("Google Sheets failed: " . $sheet_response);
    }
}

// Telegram notification
$telegramConfig = getTelegramConfig();
if ($telegramConfig['enabled']) {
    $bot_token = $telegramConfig['bot_token']; // From @BotFather
    $chat_id = $telegramConfig['chat_id']; // Personal or group
    $telegram_text = "Новая запись: {$fio}, {$phone}, {$event_date} в 13:00";
    $telegram_url = "https://api.telegram.org/bot{$bot_token}/sendMessage";
    $telegram_data = ['chat_id' => $chat_id, 'text' => $telegram_text];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $telegram_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $telegram_data,
        CURLOPT_HTTPHEADER => ['Content-Type: application/x-www-form-urlencoded']
    ]);
    $telegram_response = curl_exec($curl);
    curl_close($curl);

    if (!str_contains($telegram_response, '"ok":true')) {
        error_log("Telegram failed: " . $telegram_response);
    }
}

// Token regeneration
unset($_SESSION['csrf_token']);
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
$_SESSION['token_expire'] = time() + 1800;

// Success redirect
header('Location: ' . appUrl('success.php') . '?date=' . urlencode($event_date));
exit;
?>
