<?php
$d = new DOMDocument(); libxml_use_internal_errors(true);
$d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents(__DIR__ . '/../index.html'));
libxml_clear_errors();
$x = new DOMXPath($d);
$wrap = $x->query("//div[contains(@class,'wrapper')]")->item(0) ?: $x->query('//body')->item(0);
$i = 0;
foreach ($wrap->childNodes as $n) {
    if ($n->nodeType !== XML_ELEMENT_NODE) continue;
    $cls = $n->getAttribute('class');
    if (in_array($n->nodeName, ['header','footer']) || str_contains($cls,'mobile-menu')) continue;
    // секции внутри main
    $kids = ($n->nodeName === 'main') ? $n->childNodes : [$n];
    foreach ($kids as $s) {
        if ($s->nodeType !== XML_ELEMENT_NODE) continue;
        $c = $s->getAttribute('class');
        $h = '';
        foreach (['h2','h1','h3'] as $t) {
            $q = $x->query(".//{$t}", $s)->item(0);
            if ($q) { $h = trim(preg_replace('/\s+/u',' ', $q->textContent)); break; }
        }
        printf("%2d. %-34s %s\n", ++$i, mb_substr($c ?: $s->nodeName, 0, 32), mb_substr($h, 0, 48));
    }
}
