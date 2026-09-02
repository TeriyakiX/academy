<?php
$root = realpath(__DIR__ . '/..');
$skip = ['/admin/', '/.tmb/', '/uploads/', '/.1/', '/_migration/'];
$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS));
$pages = [];
foreach ($rii as $f) {
    if (strtolower($f->getExtension()) !== 'html') continue;
    $rel = str_replace(DIRECTORY_SEPARATOR, '/', substr($f->getPathname(), strlen($root)));
    $rel = '/' . ltrim($rel, '/');
    foreach ($skip as $s) if (str_contains($rel, $s)) continue 2;
    $size = $f->getSize();
    if ($size < 2000) { $pages[] = ['url'=>$rel,'skipped'=>'too small (verification/stub)','bytes'=>$size]; continue; }

    $html = file_get_contents($f->getPathname());
    $d = new DOMDocument();
    libxml_use_internal_errors(true);
    $d->loadHTML('<?xml encoding="UTF-8">' . $html);
    libxml_clear_errors();
    $x = new DOMXPath($d);
    $one = fn($q) => ($n = $x->query($q)->item(0)) ? trim($n->nodeValue ?? '') : null;
    $attr = fn($q,$a) => ($n = $x->query($q)->item(0)) ? trim($n->getAttribute($a)) : null;
    $all = function($q) use ($x) { $r=[]; foreach ($x->query($q) as $n) { $t=trim(preg_replace('/\s+/u',' ',$n->textContent)); if($t!=='') $r[]=$t; } return $r; };

    $pages[] = [
        'url'         => $rel,
        'bytes'       => $size,
        'title'       => $one('//title'),
        'description' => $attr('//meta[@name="description"]', 'content'),
        'keywords'    => $attr('//meta[@name="keywords"]', 'content'),
        'canonical'   => $attr('//link[@rel="canonical"]', 'href'),
        'og_title'    => $attr('//meta[@property="og:title"]', 'content'),
        'og_url'      => $attr('//meta[@property="og:url"]', 'content'),
        'og_image'    => $attr('//meta[@property="og:image"]', 'content'),
        'robots'      => $attr('//meta[@name="robots"]', 'content'),
        'h1'          => $all('//h1'),
        'h2'          => $all('//h2'),
        'h3'          => $all('//h3'),
        'css'         => array_values(array_filter(array_map(fn($n)=>$n->getAttribute('href'), iterator_to_array($x->query('//link[@rel="stylesheet"]'))))),
        'js'          => array_values(array_filter(array_map(fn($n)=>$n->getAttribute('src'), iterator_to_array($x->query('//script[@src]'))))),
        'ld_json'     => count($x->query('//script[@type="application/ld+json"]')),
        'imgs'        => count($x->query('//img')),
        'forms'       => count($x->query('//form')),
    ];
}
usort($pages, fn($a,$b) => strcmp($a['url'], $b['url']));
file_put_contents(__DIR__.'/pages.json', json_encode($pages, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
echo "pages: ".count($pages)."\n";
