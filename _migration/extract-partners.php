<?php
/* Переносит логотипы партнёров из исходной секции сайта в config/home.php. */

$root = realpath(__DIR__ . '/..');
$d = new DOMDocument();
libxml_use_internal_errors(true);
$d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents($root . '/index.html'));
libxml_clear_errors();
$x = new DOMXPath($d);

$section = $x->query("//section[contains(@class,'partners')]")->item(0);
if (!$section) { echo "секция партнёров не найдена\n"; exit(1); }

$items = [];
foreach ($x->query('.//img', $section) as $img) {
    $src = $img->getAttribute('src');
    $alt = trim($img->getAttribute('alt')) ?: 'Партнёр';
    if ($src === '') continue;
    $items[] = ['src' => $src, 'alt' => $alt];
}

echo 'логотипов: ' . count($items) . "\n";
foreach ($items as $i) echo '  - ' . $i['alt'] . "\n";

$export = "    'partners' => [\n        'items' => " . var_export($items, true) . ",\n    ],\n";
file_put_contents(__DIR__ . '/partners-config.txt', $export);
echo "\nфрагмент сохранён в _migration/partners-config.txt\n";
