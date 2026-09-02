<?php
$d = new DOMDocument(); libxml_use_internal_errors(true);
$d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents(dirname(__DIR__) . '/courses.html'));
libxml_clear_errors();
$x = new DOMXPath($d);
$card = $x->query("//article[contains(@class,'courses__card')]")->item(0);
$h = $d->saveHTML($card);
$h = preg_replace('/<svg.*?<\/svg>/s', '<svg/>', $h);
echo preg_replace('/>\s*</', ">\n<", $h) . "\n";
