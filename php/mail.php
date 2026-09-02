<?php
header("Access-Control-Allow-Origin: https://academy-barista.ru");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Method not allowed"]);
    exit();
}

require_once 'config.php';

$name    = strip_tags($_POST['name']    ?? 'Не указано');
$phone   = strip_tags($_POST['phone']   ?? 'Не указано');
$purpose = strip_tags($_POST['purpose'] ?? 'Заявка на консультацию');

$phone_clean = '+' . preg_replace('/\D/', '', $phone);

$subject  = "Academy Barista: {$purpose}";
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: Academy Barista <noreply@realdefo.ru>\r\n";

$mail_body = "
    <h2>Новая заявка</h2>
    <p><b>Источник:</b> {$purpose}</p>
    <p><b>Имя:</b> {$name}</p>
    <p><b>Телефон:</b> <a href=\"tel:{$phone_clean}\">{$phone}</a></p>
";

$mail_sent = mail(TO_EMAIL, $subject, $mail_body, $headers);

if ($mail_sent) {
    echo json_encode(["status" => "success"]);
} else {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Ошибка отправки письма"]);
}