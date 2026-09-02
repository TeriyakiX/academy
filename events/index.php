<?php 

require_once __DIR__ . '/config.php';

// Session security
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1); // HTTPS only in prod
ini_set('session.use_strict_mode', 1);

session_start();

session_regenerate_id(true); // Anti-fixation

// Generate/regenerate CSRF token with 30-min expiry
if (empty($_SESSION['csrf_token']) || (isset($_SESSION['token_expire']) && time() > $_SESSION['token_expire'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    $_SESSION['token_expire'] = time() + 1800;
}
// DB connection for date availability
$dbConfig = getDatabaseConfig();
$dsn = $dbConfig['dsn'];
$user = $dbConfig['user'];
$pass = $dbConfig['pass'];
$captchaConfig = getCaptchaConfig();

$dates = [
    '2025-10-27' => '27 октября 2025',
    '2025-10-28' => '28 октября 2025',
    '2025-10-29' => '29 октября 2025',
    '2025-10-30' => '30 октября 2025',
];

$pdo = null;
$disabled_dates = [];
try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    foreach (array_keys($dates) as $date) {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM registrations WHERE event_date = ?');
        $stmt->execute([$date]);
        if ($stmt->fetchColumn() >= 15) {
            $disabled_dates[] = $date;
        }
    }
} catch (PDOException $e) {
    // Log error; form loads without date check
    error_log("DB connection failed in index.php: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Запись на курс бариста</title>
    <?php if ($captchaConfig['enabled']): ?>
        <script src="https://smartcaptcha.yandex.net/captcha.js" defer></script>
    <?php endif; ?>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f9f9f9; color: #333; }
        .container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { color: #8B4513; text-align: center; margin-bottom: 30px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        .checkbox { display: flex; align-items: center; margin-bottom: 20px; }
        .checkbox input { width: auto; margin-right: 10px; }
        button { background: #8B4513; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; }
        button:hover { background: #A0522D; }
        button:disabled { background: #ccc; cursor: not-allowed; }
        .error { color: red; margin-bottom: 10px; }
        .smart-captcha { margin: 15px 0; }
        option:disabled { color: #999; }
        @media (max-width: 768px) { .container { padding: 20px; } h1 { font-size: 1.5em; } }
    </style>
</head>
<body>
    <div class="container">
        <h1>Запись на каппинг</h1>
        <form id="registrationForm" action="<?php echo htmlspecialchars(appUrl('process.php'), ENT_QUOTES, 'UTF-8'); ?>" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="token_timestamp" value="<?php echo $_SESSION['token_expire']; ?>">
            <input type="hidden" name="smart_token" id="smart_token">

            <label for="fio">ФИО:</label>
            <input type="text" id="fio" name="fio" required maxlength="255">

            <label for="phone">Телефон:</label>
            <input type="tel" id="phone" name="phone" required pattern="\+?[7-8]?[0-9]{10,}" placeholder="+7 (900) 123-45-67" title="Российский номер: +7 или 8 с 10 цифрами">

            <label for="event_date">Дата мероприятия (13:00):</label>
            <select id="event_date" name="event_date" required>
                <option value="">Выберите дату</option>
                <?php foreach ($dates as $value => $label): ?>
                    <option value="<?php echo $value; ?>" <?php echo (in_array($value, $disabled_dates) ? 'disabled' : ''); ?>>
                        <?php echo $label . (in_array($value, $disabled_dates) ? ' (заполнено)' : ''); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div class="checkbox">
                <input type="checkbox" id="consent" name="consent" required>
                <label for="consent">
                    Я согласен на обработку персональных данных
                    (<a href="https://academy-barista.ru/docs/%D0%A1%D0%BE%D0%B3%D0%BB%D0%B0%D1%81%D0%B8%D0%B5_%D0%BE%D0%B1%D1%80%D0%B0%D0%B1%D0%BE%D1%82%D0%BA%D0%B8_%D0%9F%D0%94_%D0%90%D0%BA%D0%B0%D0%B4%D0%B5%D0%BC%D0%B8%D0%B8_%D0%B1%D0%B0%D1%80%D0%B8%D1%81%D1%82%D0%B0.pdf" target="_blank" rel="noopener noreferrer">Согласие</a>,
                    <a href="https://academy-barista.ru/docs/%D0%9F%D0%BE%D0%BB%D0%B8%D1%82%D0%B8%D0%BA%D0%B0_%D0%BA%D0%BE%D0%BD%D1%84%D0%B8%D0%B4%D0%B5%D0%BD%D1%86%D0%B8%D0%B0%D0%BB%D1%8C%D0%BD%D0%BE%D1%81%D1%82%D0%B8_%D0%90%D0%BA%D0%B0%D0%B4%D0%B5%D0%BC%D0%B8%D0%B8_%D0%B1%D0%B0%D1%80%D0%B8%D1%81%D1%82%D0%B0.pdf" target="_blank" rel="noopener noreferrer">Политика</a>)
                </label>
            </div>

            <?php if ($captchaConfig['enabled']): ?>
                <div id="captcha" class="smart-captcha" data-sitekey="<?php echo htmlspecialchars($captchaConfig['site_key'], ENT_QUOTES, 'UTF-8'); ?>"></div>
            <?php endif; ?>

            <?php if (isset($_GET['error'])): ?>
                <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>

            <button type="submit">Записаться</button>
        </form>

        <script>
            document.getElementById('registrationForm').addEventListener('submit', function(e) {
                <?php if ($captchaConfig['enabled']): ?>
                const token = window.smartCaptcha.getResponse();
                if (!token) {
                    e.preventDefault();
                    alert('Пройдите капчу');
                    return false;
                }
                document.getElementById('smart_token').value = token;
                <?php endif; ?>
            });
        </script>
    </div>
</body>
</html>
