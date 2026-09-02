<?php
/* Достаёт услуги для бизнеса из busines.html в конфиг. */

$root = realpath(__DIR__ . '/..');
$d = new DOMDocument();
libxml_use_internal_errors(true);
$d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents($root . '/busines.html'));
libxml_clear_errors();
$x = new DOMXPath($d);

$t = fn($n) => $n ? trim(preg_replace('/\s+/u', ' ', $n->textContent)) : null;

$items = [];
foreach ($x->query("//article[contains(concat(' ', normalize-space(@class), ' '), ' courses__card ')]") as $card) {
    $title = $t($x->query(".//*[contains(@class,'courses__card-name')]", $card)->item(0))
        ?? $t($x->query('.//h3', $card)->item(0));
    $descr = $t($x->query(".//*[contains(@class,'courses__card-text')]", $card)->item(0));

    $points = [];
    foreach ($x->query(".//li[contains(@class,'courses__card-item')]", $card) as $li) {
        $v = $t($li);
        if ($v && mb_strlen($v) > 3) $points[] = rtrim($v, ';.');
    }

    // в колонках карточки лежат цена и длительность
    $price = null;
    $duration = null;
    foreach ($x->query(".//*[contains(@class,'courses__card-col')]", $card) as $col) {
        $v = $t($col);
        if (!$v) continue;
        if (str_contains($v, '₽'))                      $price = (int) preg_replace('/\D/', '', $v) ?: null;
        elseif (preg_match('/час|день|дн|недел/u', $v))  $duration = $v;
    }

    $image = $x->query(".//*[contains(@class,'courses__card-image')]//img", $card)->item(0)?->getAttribute('src');

    if (!$title) continue;

    $items[] = [
        'title'    => $title,
        'text'     => $descr,
        'points'   => array_slice(array_values(array_unique($points)), 0, 8),
        'price'    => $price,
        'duration' => $duration,
        'image'    => $image && !str_starts_with($image, 'data:') ? $image : null,
    ];
}

echo 'услуг: ' . count($items) . "\n";
foreach ($items as $i) printf("  %-46s пунктов:%-2d цена:%s\n", mb_substr($i['title'], 0, 44), count($i['points']), $i['price'] ?? '—');

file_put_contents(
    __DIR__ . '/business-config.txt',
    "    'business' => [\n        'items' => " . var_export($items, true) . ",\n    ],\n"
);
echo "\nфрагмент: _migration/business-config.txt\n";
