<?php
$root = realpath(__DIR__ . '/..');
$pages = json_decode(file_get_contents(__DIR__ . '/pages.json'), true);
$hdr = []; $ftr = [];
foreach ($pages as $p) {
    if (isset($p['skipped'])) continue;
    $file = $root . str_replace('/', DIRECTORY_SEPARATOR, $p['url']);
    if (!is_file($file)) { echo "MISS {$p['url']}\n"; continue; }
    $d = new DOMDocument(); libxml_use_internal_errors(true);
    $d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents($file));
    libxml_clear_errors();
    $x = new DOMXPath($d);
    foreach ([['header', &$hdr], ['footer', &$ftr]] as [$tag, &$bucket]) {
        $n = $x->query("//{$tag}")->item(0);
        $html = $n ? $d->saveHTML($n) : '';
        $key = md5(preg_replace('/\s+/', ' ', $html));
        $bucket[$key]['pages'][] = $p['url'];
        $bucket[$key]['len'] = strlen($html);
    }
}
foreach (['HEADER' => $hdr, 'FOOTER' => $ftr] as $label => $b) {
    echo "=== $label: " . count($b) . " вариант(ов) ===\n";
    uasort($b, fn($a, $c) => count($c['pages']) <=> count($a['pages']));
    foreach ($b as $k => $v) {
        echo "  " . str_pad(count($v['pages']) . " стр.", 10) . " {$v['len']} байт  ";
        echo implode(', ', array_slice($v['pages'], 0, 3)) . (count($v['pages']) > 3 ? ' ...' : '') . "\n";
    }
}
