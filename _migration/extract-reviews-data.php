<?php
/* Достаёт отзывы (имя, дата, текст, ссылка) из старой секции на sertifikat.html. */

$root = realpath(__DIR__ . '/..');
$d = new DOMDocument();
libxml_use_internal_errors(true);
$d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents($root . '/sertifikat.html'));
libxml_clear_errors();
$x = new DOMXPath($d);

$t = fn($n) => $n ? trim(preg_replace('/\s+/u', ' ', $n->textContent)) : null;

$items = [];
foreach ($x->query("//li[contains(@class,'reviews__slider-slide')]") as $slide) {
    $name = $t($x->query(".//*[contains(@class,'reviews__slider-name')]", $slide)->item(0));
    $date = $t($x->query(".//*[contains(@class,'reviews__slider-date')]", $slide)->item(0));
    $text = $t($x->query(".//*[contains(@class,'reviews__slider-description')]", $slide)->item(0));
    $href = $x->query(".//a[contains(@class,'reviews__slider-link')]", $slide)->item(0)?->getAttribute('href');
    // сколько закрашенных звёзд
    $stars = $x->query(".//*[contains(@class,'reviews__slider-stars')]//*[name()='svg']", $slide)->length;

    if (!$name || !$text) continue;

    $items[] = [
        'name'   => $name,
        'date'   => $date,
        'text'   => $text,
        'rating' => $stars > 0 && $stars <= 5 ? $stars : 5,
        'href'   => $href ?: null,
    ];
}

echo 'отзывов: ' . count($items) . "\n";
foreach ($items as $i) printf("  %-22s %-18s %d★  %s…\n", $i['name'], $i['date'], $i['rating'], mb_substr($i['text'], 0, 40));

file_put_contents(
    __DIR__ . '/reviews-config.txt',
    "    'reviews' => [\n        'items' => " . var_export($items, true) . ",\n    ],\n"
);
echo "\nфрагмент: _migration/reviews-config.txt\n";
