<?php
$root = realpath(__DIR__ . '/..');
$lv   = $root . '/laravel';
$pages = json_decode(file_get_contents(__DIR__ . '/pages.json'), true);

function dom(string $file): array {
    $d = new DOMDocument(); libxml_use_internal_errors(true);
    $d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents($file));
    libxml_clear_errors();
    return [$d, new DOMXPath($d)];
}
function pretty(string $h): string { return preg_replace('/>\s*</', ">\n<", trim($h)); }

// ---------- 1. Эталонные шапка/футер из index.html ----------
[$d, $x] = dom($root . '/index.html');
$header = pretty($d->saveHTML($x->query('//header')->item(0)));
$footer = pretty($d->saveHTML($x->query('//footer')->item(0)));

@mkdir("$lv/resources/views/partials", 0777, true);
@mkdir("$lv/resources/views/pages", 0777, true);
@mkdir("$lv/resources/views/layouts", 0777, true);

// абсолютные ссылки -> относительные (чтобы работало на любом домене/стенде)
$rel = fn($h) => str_replace(['https://academy-barista.ru/', 'https://academy-barista.ru'], ['/', ''], $h);
file_put_contents("$lv/resources/views/partials/header.blade.php", $rel($header));
file_put_contents("$lv/resources/views/partials/footer.blade.php", $rel($footer));

// ---------- 2. Тело каждой страницы ----------
$made = [];
foreach ($pages as $p) {
    if (isset($p['skipped'])) continue;
    $url  = $p['url'];
    $file = $root . str_replace('/', DIRECTORY_SEPARATOR, $url);
    if (!is_file($file)) continue;

    [$d, $x] = dom($file);
    $body = $x->query('//body')->item(0);
    if (!$body) continue;

    // выкидываем header/footer/script/noscript — они уедут в layout
    foreach (['header', 'footer', 'script', 'noscript'] as $t) {
        foreach (iterator_to_array($x->query("//body//{$t}")) as $n) $n->parentNode->removeChild($n);
    }
    $inner = '';
    foreach ($body->childNodes as $c) $inner .= $d->saveHTML($c);

    $name = trim(str_replace(['/', '.html'], ['.', ''], $url), '.');
    $path = "$lv/resources/views/pages/" . str_replace('.', '/', $name) . '.blade.php';
    @mkdir(dirname($path), 0777, true);

    $tpl  = "@extends('layouts.app')\n\n@section('content')\n" . $rel(pretty($inner)) . "\n@endsection\n";
    file_put_contents($path, $tpl);
    $made[$url] = ['view' => $name, 'bytes' => strlen($tpl), 'css' => $p['css'], 'js' => $p['js']];
}
file_put_contents(__DIR__ . '/views.json', json_encode($made, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
echo "шаблонов: " . count($made) . "\n";
