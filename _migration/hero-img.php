<?php
$d = new DOMDocument(); libxml_use_internal_errors(true);
$d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents(__DIR__ . '/../index.html'));
libxml_clear_errors();
$x = new DOMXPath($d);
$s = $x->query("//section[contains(@class,'hero')]")->item(0);
foreach ($x->query('.//img', $s) as $img) {
    $src = $img->getAttribute('src');
    if (str_starts_with($src, 'data:')) $src = '[inline ' . strlen($src) . ' байт]';
    echo str_pad($src, 40), ' | ', mb_substr($img->getAttribute('alt'), 0, 40), "\n";
}
foreach ($x->query('.//source', $s) as $sr) echo 'source: ', $sr->getAttribute('srcset'), "\n";
