<?php
$root = realpath(__DIR__ . '/..');
$out = __DIR__ . '/parts'; @mkdir($out, 0777, true);
$samples = ['/barnoe-delo/metod-ctir.html' => 'A16', '/busines.html' => 'B7', '/oferta.html' => 'C3', '/index.html' => 'D2', '/glavnaya.html' => 'E1'];
foreach ($samples as $url => $tag) {
    $d = new DOMDocument(); libxml_use_internal_errors(true);
    $d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents($root . str_replace('/', DIRECTORY_SEPARATOR, $url)));
    libxml_clear_errors();
    $x = new DOMXPath($d);
    foreach (['header', 'footer'] as $t) {
        $n = $x->query("//{$t}")->item(0);
        if (!$n) continue;
        $html = $d->saveHTML($n);
        $html = preg_replace('/>\s*</', ">\n<", $html);
        file_put_contents("$out/{$t}-{$tag}.html", $html);
    }
}
echo "done\n";
