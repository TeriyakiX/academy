<?php
$d = new DOMDocument(); libxml_use_internal_errors(true);
$d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents(__DIR__ . '/../index.html'));
libxml_clear_errors();
$x = new DOMXPath($d);
$s = $x->query("//section[contains(@class,'team')]")->item(0);
$h = preg_replace('/<svg.*?<\/svg>/s', '', $d->saveHTML($s));
$h = preg_replace('/src="data:[^"]{40,}"/', 'src="DATA"', $h);
echo preg_replace('/>\s*</', ">\n<", $h);
