<?php
$d = new DOMDocument(); libxml_use_internal_errors(true);
$d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents(__DIR__ . '/../index.html'));
libxml_clear_errors();
$x = new DOMXPath($d);
$s = $x->query("//section[contains(@class,'hero')]")->item(0);
$t = fn($n) => $n ? trim(preg_replace('/\s+/u', ' ', $n->textContent)) : null;
foreach ($x->query(".//*[contains(@class,'hero__splide-card') or contains(@class,'hero__card')]", $s) as $card) {
    $title = $t($x->query(".//*[contains(@class,'title')]", $card)->item(0));
    $desc  = $t($x->query(".//*[contains(@class,'description') or contains(@class,'text')]", $card)->item(0));
    $img   = $x->query('.//img', $card)->item(0)?->getAttribute('src');
    $href  = $x->query('.//a', $card)->item(0)?->getAttribute('href');
    if (!$title) continue;
    echo "— $title\n  img:  $img\n  href: $href\n  txt:  " . mb_substr($desc ?? '', 0, 150) . "\n\n";
}
