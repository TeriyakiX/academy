<?php
$d = new DOMDocument(); libxml_use_internal_errors(true);
$d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents(__DIR__ . '/../courses/barista-base.html'));
libxml_clear_errors();
$x = new DOMXPath($d);
$cc = $x->query("//section[contains(@class,'course-composition')]")->item(0);
$h = preg_replace('/<svg.*?<\/svg>/s', '', $d->saveHTML($cc));
$h = preg_replace('/>\s*</', ">\n<", $h);
echo mb_substr($h, 0, 1600);
