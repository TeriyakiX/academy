<?php
$root = realpath(__DIR__ . '/..');
$t = fn($n) => $n ? trim(preg_replace('/\s+/u', ' ', $n->textContent)) : null;
foreach (['contact', 'sertifikat', 'busines', 'blog'] as $name) {
    $d = new DOMDocument(); libxml_use_internal_errors(true);
    $d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents("$root/$name.html"));
    libxml_clear_errors();
    $x = new DOMXPath($d);
    echo "=== $name ===\n";
    $hero = $x->query("//section[contains(@class,'hero')]")->item(0) ?: $x->query('//main')->item(0);
    if ($hero) {
        foreach ($x->query('.//h1|.//h2|.//h3|.//p|.//li', $hero) as $n) {
            $v = $t($n);
            if ($v && mb_strlen($v) > 3) echo '  <' . $n->nodeName . '> ' . mb_substr($v, 0, 95) . "\n";
        }
    }
    if ($name === 'blog') {
        echo '  статей: ' . $x->query("//*[contains(@class,'blog__card') or contains(@class,'article-card') or contains(@class,'blog__item')]")->length . "\n";
        foreach ($x->query("//*[contains(@class,'blog')]") as $b) { $c = $b->getAttribute('class'); if ($c) echo "  cls: $c\n"; }
    }
    echo "\n";
}
