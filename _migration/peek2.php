<?php
$d = new DOMDocument(); libxml_use_internal_errors(true);
$d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents(__DIR__ . '/../index.html'));
libxml_clear_errors();
$x = new DOMXPath($d);
$s = $x->query("//section[contains(@class,'partners')]")->item(0);
$h = $d->saveHTML($s);
$h = preg_replace('/<svg.*?<\/svg>/s', '<svg/>', $h);
echo preg_replace('/>\s*</', ">\n<", $h);
