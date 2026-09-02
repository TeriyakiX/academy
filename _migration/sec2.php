<?php
$d = new DOMDocument(); libxml_use_internal_errors(true);
$d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents(__DIR__ . '/../index.html'));
libxml_clear_errors();
$x = new DOMXPath($d);
$i = 0;
foreach ($x->query('//section') as $s) {
    $cls = $s->getAttribute('class');
    $h = '';
    foreach (['h2','h3'] as $t) {
        $q = $x->query(".//{$t}", $s)->item(0);
        if ($q) { $h = trim(preg_replace('/\s+/u',' ', $q->textContent)); break; }
    }
    $len = mb_strlen(trim(preg_replace('/\s+/u',' ', $s->textContent)));
    printf("%2d. %-24s %-42s %5d симв.\n", ++$i, mb_substr($cls,0,22), mb_substr($h,0,40), $len);
}
