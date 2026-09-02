<?php
/*
 | Удаляет из шаблонов страниц остатки старого мобильного меню.
 | Оно жило в теле каждой страницы и управлялось старой шапкой.
 | После перехода на единую шапку (partials/site) стало мёртвой разметкой.
 */

$dir = __DIR__ . '/../laravel/resources/views/pages';

/** Вырезает <div class="X"> ... </div> с учётом вложенных div. */
function cutBlock(string $html, string $class): array
{
    $needle = '<div class="' . $class . '"';
    $count = 0;
    while (($start = strpos($html, $needle)) !== false) {
        $open = strpos($html, '>', $start);
        if ($open === false) break;

        $depth = 1;
        $i = $open + 1;
        $len = strlen($html);
        while ($i < $len && $depth > 0) {
            $nextOpen  = strpos($html, '<div', $i);
            $nextClose = strpos($html, '</div>', $i);
            if ($nextClose === false) break;
            if ($nextOpen !== false && $nextOpen < $nextClose) {
                $depth++;
                $i = $nextOpen + 4;
            } else {
                $depth--;
                $i = $nextClose + 6;
            }
        }
        $html = substr($html, 0, $start) . substr($html, $i);
        $count++;
    }
    return [$html, $count];
}

$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS));
$totalFiles = 0;
$totalBlocks = 0;

foreach ($rii as $f) {
    if ($f->getExtension() !== 'php') continue;
    $html = file_get_contents($f->getPathname());
    $before = $html;

    [$html, $a] = cutBlock($html, 'mobile-menu__overlay');
    [$html, $b] = cutBlock($html, 'mobile-menu');

    if ($html !== $before) {
        file_put_contents($f->getPathname(), $html);
        $totalFiles++;
        $totalBlocks += $a + $b;
        printf("%-46s -%d блок(ов), -%d байт\n",
            basename(dirname($f->getPathname())) . '/' . $f->getBasename(),
            $a + $b, strlen($before) - strlen($html));
    }
}
echo "\nфайлов изменено: $totalFiles | блоков удалено: $totalBlocks\n";
