<?php
$root = realpath(__DIR__ . '/..');
$d = new DOMDocument(); libxml_use_internal_errors(true);
$d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents($root . '/sertifikat.html'));
libxml_clear_errors();
$x = new DOMXPath($d);
foreach ($x->query('//section') as $s) {
    $t = mb_strtolower(trim($x->query('.//h2', $s)->item(0)?->textContent ?? ''));
    if (!str_contains($t, 'отзыв')) continue;
    $html = $d->saveHTML($s);
    $html = str_replace(['https://academy-barista.ru/', 'https://academy-barista.ru'], ['/', ''], $html);
    file_put_contents($root . '/laravel/resources/views/partials/blocks/reviews.blade.php', $html);
    echo "отзывов: " . $x->query(".//li[contains(@class,'reviews__slider-slide')]", $s)->length . "\n";
    break;
}
