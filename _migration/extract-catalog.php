<?php
$root = realpath(__DIR__ . '/..');
$d = new DOMDocument(); libxml_use_internal_errors(true);
$d->loadHTML('<?xml encoding="UTF-8">' . file_get_contents($root . '/courses.html'));
libxml_clear_errors();
$x = new DOMXPath($d);
$txt = fn($n) => $n ? trim(preg_replace('/\s+/u', ' ', $n->textContent)) : null;
$num = fn($s) => $s ? (int) preg_replace('/\D/', '', $s) : null;

$school = function (string $url): string {
    if (str_starts_with($url, '/master-class/')) return 'Мастер-классы';
    if (str_starts_with($url, '/barnoe-delo/'))  return 'Барное дело';
    return 'Курсы бариста';
};

$out = [];
foreach ($x->query("//article[contains(@class,'courses__card')]") as $card) {
    $link = $x->query(".//a[contains(@class,'courses__card-button')]", $card)->item(0);
    if (!$link) continue;
    $url = str_replace('https://academy-barista.ru', '', $link->getAttribute('href'));
    if (isset($out[$url])) continue;

    $facts = [];
    foreach ($x->query(".//div[contains(@class,'courses__card-information')]", $card) as $inf) {
        $l = $txt($x->query(".//span[contains(@class,'courses__card-information-label')]", $inf)->item(0));
        $v = $txt($x->query(".//span[contains(@class,'courses__card-information-text')]", $inf)->item(0));
        if ($l && $v) $facts[rtrim($l, ':')] = $v;
    }

    $out[$url] = [
        'url'        => $url,
        'school'     => $school($url),
        'title'      => $txt($x->query(".//h3[contains(@class,'courses__card-name')]", $card)->item(0)),
        'desc'       => $txt($x->query(".//p[contains(@class,'courses__card-description')]", $card)->item(0)),
        'price'      => $num($txt($x->query(".//span[contains(@class,'courses__card-sum')][not(contains(@class,'old'))]", $card)->item(0))),
        'old_price'  => $num($txt($x->query(".//span[contains(@class,'courses__card-sum-old')]", $card)->item(0))),
        'price_note' => $txt($x->query(".//span[contains(@class,'courses__card-label')]", $card)->item(0)),
        'facts'      => $facts,
    ];
}
$out = array_values($out);
file_put_contents(__DIR__ . '/catalog.json', json_encode($out, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

echo "курсов: " . count($out) . "\n\n";
foreach ($out as $c) {
    printf("%-15s %-24s %6d  %-18s %s\n", $c['school'], mb_substr($c['title'], 0, 22), $c['price'],
        mb_substr($c['facts']['Продолжительность'] ?? '—', 0, 16), $c['facts']['Формат обучения'] ?? '');
}
