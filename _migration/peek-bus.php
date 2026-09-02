<?php
$d = new DOMDocument(); libxml_use_internal_errors(true);
$d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents(__DIR__ . '/../busines.html'));
libxml_clear_errors();
$x = new DOMXPath($d);
$c = $x->query("//*[contains(@class,'courses__card')]")->item(0);
$h = preg_replace('/<svg.*?<\/svg>/s', '', $d->saveHTML($c));
$h = preg_replace('/src="data:[^"]{30,}"/', 'src="DATA"', $h);
echo mb_substr(preg_replace('/>\s*</', ">\n<", $h), 0, 1400);
