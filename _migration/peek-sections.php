<?php
$d = new DOMDocument(); libxml_use_internal_errors(true);
$d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents(__DIR__ . '/../index.html'));
libxml_clear_errors();
$x = new DOMXPath($d);
foreach (['about', 'certificate'] as $cls) {
    $s = $x->query("//section[contains(@class,'{$cls}')]")->item(0);
    if (!$s) continue;
    echo "=== $cls ===\n";
    foreach ($x->query('.//h2|.//h3|.//h4|.//p|.//li|.//a|.//img', $s) as $n) {
        if ($n->nodeName === 'img') { echo "  [img] " . $n->getAttribute('src') . "\n"; continue; }
        if ($n->nodeName === 'a')   { echo "  [a]   " . trim($n->textContent) . ' -> ' . $n->getAttribute('href') . "\n"; continue; }
        $t = trim(preg_replace('/\s+/u', ' ', $n->textContent));
        if ($t !== '') echo "  <{$n->nodeName}> " . mb_substr($t, 0, 110) . "\n";
    }
    echo "\n";
}
