<?php
$pages = json_decode(file_get_contents(__DIR__ . '/pages.json'), true);
$views = json_decode(file_get_contents(__DIR__ . '/views.json'), true);
$base  = 'https://academy-barista.ru';

// дубли -> 301 на оригинал, в маршруты не попадают
$dupes = [
    '/glavnaya.html'               => '/',
    '/courses/barista-test.html'   => '/courses/barista-base.html',
];
$noindex = ['/thank-you.html'];

$out = [];
foreach ($pages as $p) {
    if (isset($p['skipped'])) continue;
    $url = $p['url'];
    if (isset($dupes[$url])) continue;

    $route = $url === '/index.html' ? '/' : $url;
    $out[$route] = [
        'view'        => $views[$url]['view'] ?? null,
        'title'       => $p['title'],
        'description' => $p['description'],
        'keywords'    => $p['keywords'] ?: null,
        'og_title'    => $p['og_title'] ?: null,
        'og_image'    => $p['og_image'] ?: null,
        'canonical'   => $base . $route,                     // <- всегда сам на себя
        'robots'      => in_array($url, $noindex, true) ? 'noindex, follow' : null,
        'css'         => $p['css'],
        'js'          => $p['js'],
    ];
}

$export = var_export(['pages' => $out, 'redirects' => $dupes], true);
file_put_contents(dirname(__DIR__) . '/laravel/config/site.php', "<?php\n\nreturn " . $export . ";\n");
echo "маршрутов: " . count($out) . " | редиректов: " . count($dupes) . "\n";
