<?php
$root  = realpath(__DIR__ . '/..');
$pages = json_decode(file_get_contents(__DIR__ . '/pages.json'), true);
$skipUrls = ['/glavnaya.html', '/courses/barista-test.html'];

function textOf(string $html): string {
    $d = new DOMDocument(); libxml_use_internal_errors(true);
    $d->loadHTML('<?xml encoding="UTF-8">' . $html);
    libxml_clear_errors();
    $x = new DOMXPath($d);
    foreach (iterator_to_array($x->query('//script|//style|//noscript')) as $n) $n->parentNode->removeChild($n);
    $b = $x->query('//body')->item(0);
    return trim(preg_replace('/\s+/u', ' ', $b ? $b->textContent : ''));
}

$bad = 0; $ok = 0;
foreach ($pages as $p) {
    if (isset($p['skipped']) || in_array($p['url'], $skipUrls, true)) continue;
    $route = $p['url'] === '/index.html' ? '/' : $p['url'];
    $orig = textOf(file_get_contents($root . str_replace('/', DIRECTORY_SEPARATOR, $p['url'])));
    $new  = textOf(file_get_contents('http://127.0.0.1:8899' . $route));

    if ($orig === $new) { $ok++; continue; }
    $bad++;
    $lo = mb_strlen($orig); $ln = mb_strlen($new);
    printf("%-42s оригинал %6d / новый %6d  (%+d)\n", $route, $lo, $ln, $ln - $lo);
    // покажем первое расхождение
    $i = 0; $max = min($lo, $ln);
    while ($i < $max && mb_substr($orig, $i, 1) === mb_substr($new, $i, 1)) $i++;
    echo "      ориг: ..." . mb_substr($orig, max(0, $i - 30), 90) . "\n";
    echo "      новый: ..." . mb_substr($new, max(0, $i - 30), 90) . "\n";
}
echo "\nсовпало: $ok | расходится: $bad\n";
