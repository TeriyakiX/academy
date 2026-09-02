<?php
$d = new DOMDocument(); libxml_use_internal_errors(true);
$d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents(__DIR__ . '/../sertifikat.html'));
libxml_clear_errors();
$x = new DOMXPath($d);
foreach ($x->query('//section') as $s) {
    $t = trim(preg_replace('/\s+/u',' ', $x->query('.//h2', $s)->item(0)?->textContent ?? ''));
    if (!str_contains(mb_strtolower($t), 'отзыв')) continue;
    $h = preg_replace('/<svg.*?<\/svg>/s', '<svg/>', $d->saveHTML($s));
    $h = preg_replace('/src="data:[^"]*"/', 'src="DATA_URI"', $h);
    echo preg_replace('/>\s*</', ">\n<", $h);
}
