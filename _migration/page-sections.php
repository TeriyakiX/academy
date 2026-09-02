<?php
$dir = __DIR__ . '/../laravel/resources/views/pages';
$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS));
$map = [];
foreach ($rii as $f) {
    if ($f->getExtension() !== 'php') continue;
    $rel = str_replace([$dir . DIRECTORY_SEPARATOR, '.blade.php', DIRECTORY_SEPARATOR], ['', '', '/'], $f->getPathname());
    if ($rel === 'index' || $rel === 'glavnaya') continue;
    preg_match_all('/<section class="([a-z-]+)/', file_get_contents($f->getPathname()), $m);
    $map[$rel] = $m[1];
}
// какие секции встречаются чаще всего
$freq = [];
foreach ($map as $secs) foreach (array_unique($secs) as $s) $freq[$s] = ($freq[$s] ?? 0) + 1;
arsort($freq);
echo "=== частота секций по страницам ===\n";
foreach ($freq as $s => $n) if ($n > 1) printf("%-26s %d стр.\n", $s, $n);
echo "\n=== состав страниц курсов ===\n";
foreach ($map as $page => $secs) {
    if (!str_contains($page, 'courses/') && !str_contains($page, 'master-class/') && !str_contains($page, 'barnoe-delo/')) continue;
    printf("%-42s %s\n", $page, implode(', ', $secs));
}
