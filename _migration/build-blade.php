<?php
$root  = realpath(__DIR__ . '/..');
$lv    = $root . '/laravel';
$pages = json_decode(file_get_contents(__DIR__ . '/pages.json'), true);

function dom(string $file): array {
    $d = new DOMDocument(); libxml_use_internal_errors(true);
    $d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents($file));
    libxml_clear_errors();
    return [$d, new DOMXPath($d)];
}

/** Абсолютные ссылки -> относительные ТОЛЬКО в атрибутах. Текст не трогаем. */
function relinkAttrs(DOMXPath $x, DOMNode $scope): void {
    foreach (['href', 'src'] as $attr) {
        foreach ($x->query(".//@{$attr}", $scope) as $a) {
            $v = $a->value;
            if (str_starts_with($v, 'https://academy-barista.ru')) {
                $a->value = substr($v, strlen('https://academy-barista.ru')) ?: '/';
            }
        }
    }
}

foreach (['partials', 'pages', 'layouts'] as $dir) @mkdir("$lv/resources/views/$dir", 0777, true);

$variants = ['header' => [], 'footer' => []];
$made = [];

foreach ($pages as $p) {
    if (isset($p['skipped'])) continue;
    $file = $root . str_replace('/', DIRECTORY_SEPARATOR, $p['url']);
    if (!is_file($file)) continue;

    [$d, $x] = dom($file);
    $body = $x->query('//body')->item(0);
    if (!$body) continue;

    relinkAttrs($x, $body);

    $uses = [];
    foreach (['header', 'footer'] as $t) {
        $n = $x->query("//body//{$t}")->item(0);
        if (!$n) continue;
        $html = $d->saveHTML($n);
        $key  = md5($html);
        if (!isset($variants[$t][$key])) {
            $variants[$t][$key] = ['name' => $t . '-' . (count($variants[$t]) + 1), 'html' => $html, 'pages' => []];
        }
        $variants[$t][$key]['pages'][] = $p['url'];
        $uses[$t] = $variants[$t][$key]['name'];
        $n->parentNode->replaceChild($d->createTextNode("[[INC:{$t}]]"), $n);
    }
    foreach (['script', 'noscript'] as $t) {
        foreach (iterator_to_array($x->query("//body//{$t}")) as $n) $n->parentNode->removeChild($n);
    }

    $inner = '';
    foreach ($body->childNodes as $c) $inner .= $d->saveHTML($c);
    foreach ($uses as $t => $partial) {
        $inner = str_replace("[[INC:{$t}]]", "@include('partials.{$partial}')", $inner);
    }

    $name = trim(str_replace(['/', '.html'], ['.', ''], $p['url']), '.');
    $path = "$lv/resources/views/pages/" . str_replace('.', '/', $name) . '.blade.php';
    @mkdir(dirname($path), 0777, true);
    file_put_contents($path, "@extends('layouts.app')\n@section('content')\n{$inner}\n@endsection\n");
    $made[$p['url']] = ['view' => $name, 'css' => $p['css'], 'js' => $p['js']];
}

foreach ($variants as $t => $set) {
    foreach ($set as $v) file_put_contents("$lv/resources/views/partials/{$v['name']}.blade.php", $v['html']);
}
file_put_contents(__DIR__ . '/views.json', json_encode($made, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
echo "шаблонов: " . count($made) . " | шапок: " . count($variants['header']) . " | футеров: " . count($variants['footer']) . "\n";
