<?php
$d = new DOMDocument(); libxml_use_internal_errors(true);
$d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents(__DIR__ . '/../index.html'));
libxml_clear_errors();
$x = new DOMXPath($d);
$t = fn($n) => $n ? trim(preg_replace('/\s+/u',' ', $n->textContent)) : null;
foreach (['reasons','directions','business-courses'] as $cls) {
    $s = $x->query("//section[contains(@class,'$cls')]")->item(0);
    if (!$s) continue;
    echo "=== $cls ===\n";
    foreach ($x->query('.//h2|.//h3|.//p|.//li|.//a', $s) as $n) {
        if ($n->nodeName==='a') { echo "  [a] ".$t($n)." -> ".$n->getAttribute('href')."\n"; continue; }
        $v=$t($n); if ($v && mb_strlen($v)>3) echo "  <{$n->nodeName}> ".mb_substr($v,0,90)."\n";
    }
    echo "\n";
}
