<?php

function envFlag(string $name, bool $default = true): bool
{
    $value = getenv($name);
    if ($value === false) {
        return $default;
    }
    $normalized = strtolower(trim($value));
    if ($normalized === '') {
        return $default;
    }
    return in_array($normalized, ['1', 'true', 'yes', 'on'], true);
}

function applyErrorConfig(): void
{
    $display = envFlag('APP_DISPLAY_ERRORS', true);
    error_reporting(E_ALL);
    ini_set('display_errors', $display ? '1' : '0');
    ini_set('display_startup_errors', $display ? '1' : '0');
}

function getAppConfig(): array
{
    $basePathEnv = getenv('APP_BASE_PATH');
    if ($basePathEnv === false || $basePathEnv === '') {
        $basePath = '';
    } else {
        $basePath = '/' . trim($basePathEnv, '/');
    }

    return [
        'base_path' => $basePath,
    ];
}

function appUrl(string $path = ''): string
{
    $config = getAppConfig();
    $base = rtrim($config['base_path'], '/');
    $trimmed = ltrim($path, '/');

    if ($trimmed === '') {
        return $base === '' ? '/' : $base . '/';
    }

    if ($base === '') {
        return $trimmed;
    }

    return $base . '/' . $trimmed;
}

function getDatabaseConfig(): array
{
    $host = getenv('MYSQL_HOST') ?: 'p571782.mysql.ihc.ru';
    $port = getenv('MYSQL_PORT') ?: '3306';
    $db = getenv('MYSQL_DATABASE') ?: 'p571782_oh3';
    $user = getenv('MYSQL_USER') ?: 'p571782_oh3';
    $pass = getenv('MYSQL_PASSWORD') ?: 'nggjd8fVwhf89ehwkV';
    $charset = getenv('MYSQL_CHARSET') ?: 'utf8mb4';

    $dsn_parts = ["mysql:host=$host"];
    if (!empty($port)) {
        $dsn_parts[] = "port=$port";
    }
    $dsn_parts[] = "dbname=$db";
    $dsn_parts[] = "charset=$charset";

    return [
        'dsn' => implode(';', $dsn_parts),
        'user' => $user,
        'pass' => $pass,
    ];
}

function getCaptchaConfig(): array
{
    return [
        'enabled' => envFlag('CAPTCHA_ENABLED', false),
        'site_key' => getenv('YANDEX_CAPTCHA_SITE_KEY') ?: 'YOUR_SITE_KEY',
        'secret' => getenv('YANDEX_CAPTCHA_SECRET') ?: 'YOUR_SECRET_KEY',
    ];
}

function getSheetsConfig(): array
{
    return [
        'enabled' => envFlag('GOOGLE_SHEETS_ENABLED', false),
        'sheet_id' => getenv('GOOGLE_SHEETS_ID') ?: 'YOUR_SHEET_ID',
        'range' => getenv('GOOGLE_SHEETS_RANGE') ?: 'Sheet1!A:E',
        'access_token' => getenv('GOOGLE_SHEETS_ACCESS_TOKEN') ?: 'YOUR_ACCESS_TOKEN',
    ];
}

function getTelegramConfig(): array
{
    return [
        'enabled' => envFlag('TELEGRAM_ENABLED', false),
        'bot_token' => getenv('TELEGRAM_BOT_TOKEN') ?: 'YOUR_BOT_TOKEN',
        'chat_id' => getenv('TELEGRAM_CHAT_ID') ?: 'YOUR_CHAT_ID',
    ];
}

applyErrorConfig();
