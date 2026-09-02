<?php
/* Переносит вопросы и ответы из секции FAQ старой главной в конфиг. */

$root = realpath(__DIR__ . '/..');
$d = new DOMDocument();
libxml_use_internal_errors(true);
$d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents($root . '/index.html'));
libxml_clear_errors();
$x = new DOMXPath($d);

$t = fn($n) => $n ? trim(preg_replace('/\s+/u', ' ', $n->textContent)) : null;

$items = [];
foreach ($x->query("//*[contains(@class,'faq__accordion-item')]") as $item) {
    $q = $t($x->query(".//*[contains(@class,'faq__accordion-top')]", $item)->item(0));
    $a = $t($x->query(".//*[contains(@class,'faq__accordion-description')]", $item)->item(0))
        ?? $t($x->query(".//*[contains(@class,'faq__accordion-body')]", $item)->item(0));
    if (!$q || !$a) continue;
    $items[] = ['q' => $q, 'a' => $a];
}

echo 'вопросов: ' . count($items) . "\n";
foreach ($items as $i) echo '  — ' . mb_substr($i['q'], 0, 70) . "\n";

file_put_contents(
    __DIR__ . '/faq-config.txt',
    "    'faq' => [\n        'items' => " . var_export($items, true) . ",\n    ],\n"
);
echo "\nфрагмент: _migration/faq-config.txt\n";
