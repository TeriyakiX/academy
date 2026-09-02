<?php
$d = new DOMDocument(); libxml_use_internal_errors(true);
$d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents(__DIR__ . '/../index.html'));
libxml_clear_errors();
$x = new DOMXPath($d);
$s = $x->query("//section[contains(@class,'events')]")->item(0);
$t = fn($n) => $n ? trim(preg_replace('/\s+/u',' ', $n->textContent)) : null;
foreach ($x->query(".//*[contains(@class,'events__card')]", $s) as $c) {
    $cls = $c->getAttribute('class');
    if (!str_contains($cls, 'events__card ')) continue;
    echo "— " . $t($x->query(".//*[contains(@class,'events__card-title')]", $c)->item(0)) . "\n";
    foreach ($x->query(".//*[contains(@class,'events__card-info-')]", $c) as $i) echo "   " . $t($i) . "\n";
}
echo "\nвкладки: ";
foreach ($x->query(".//*[contains(@class,'events__filters-button')]", $s) as $b) echo $t($b) . ' | ';
echo "\n";
