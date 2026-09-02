<?php
$root = realpath(__DIR__ . '/..');
foreach (['contact', 'thank-you', 'sertifikat', 'busines', 'blog', 'article'] as $name) {
    $file = "$root/$name.html";
    if (!is_file($file)) { echo "MISS $name\n"; continue; }
    $d = new DOMDocument(); libxml_use_internal_errors(true);
    $d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents($file));
    libxml_clear_errors();
    $x = new DOMXPath($d);
    echo "=== $name ===\n";
    foreach ($x->query('//section') as $s) {
        $cls = explode(' ', $s->getAttribute('class'))[0];
        $h = trim(preg_replace('/\s+/u',' ', $x->query('.//h1|.//h2', $s)->item(0)?->textContent ?? ''));
        printf("  %-22s %s\n", $cls, mb_substr($h, 0, 60));
    }
    echo "\n";
}
