<?php
/*
 | Возвращает в home-blocks.css секции, которые были потеряны
 | при неаккуратной вырезке блока «Заявка».
 | Источник — версия файла из коммита 7b24a4d.
 */

$prev = file_get_contents(__DIR__ . '/prev-home-blocks.css');
$file = __DIR__ . '/../laravel/resources/css/home-blocks.css';
$now  = file_get_contents($file);

/** Вырезает из текста именованную секцию до следующей секции. */
function section(string $css, string $name): ?string
{
    $needle = "/* ================= {$name} =================";
    $start = strpos($css, $needle);
    if ($start === false) return null;

    $next = strpos($css, '/* ================= ', $start + strlen($needle));
    return $next === false
        ? substr($css, $start)
        : substr($css, $start, $next - $start);
}

$restore = [
    'Первый экран',
    'Школа в цифрах',
    'Отзывы',
    'Частые вопросы',
    'О школе',
    'Подарочный сертификат',
];

$added = [];
foreach ($restore as $name) {
    if (str_contains($now, "/* ================= {$name} =================")) {
        echo "уже на месте: $name\n";
        continue;
    }
    $chunk = section($prev, $name);
    if (!$chunk) { echo "НЕ НАЙДЕНА в источнике: $name\n"; continue; }
    $now .= "\n" . rtrim($chunk) . "\n";
    $added[] = $name;
}

file_put_contents($file, $now);

echo "\nвосстановлено секций: " . count($added) . "\n";
foreach ($added as $a) echo "  + $a\n";
echo "размер файла: " . strlen($now) . " байт\n";
