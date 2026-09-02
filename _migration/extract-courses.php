<?php
$root = realpath(__DIR__ . '/..');
$urls = [
    'Курсы бариста' => ['/courses/barista-base.html','/courses/barista-advanced.html','/courses/barista-professional.html','/courses/barista-technician.html','/courses/upravlyayushchiy-kofeyni.html'],
    'Мастер-классы' => ['/master-class/latte-art.html','/master-class/young-barista.html','/master-class/domashnyaya-kofeynya.html','/master-class/barista-v-take-away.html','/master-class/domashniy-barista.html'],
    'Барное дело'   => ['/barnoe-delo/metod-ctir.html','/barnoe-delo/koktel-metodom-bild.html','/barnoe-delo/vstryakhni-i-poday.html'],
];
$out = [];
foreach ($urls as $school => $list) {
    foreach ($list as $u) {
        $f = $root . str_replace('/', DIRECTORY_SEPARATOR, $u);
        if (!is_file($f)) { echo "MISS $u\n"; continue; }
        $html = file_get_contents($f);
        $d = new DOMDocument(); libxml_use_internal_errors(true);
        $d->loadHTML('<?xml encoding="UTF-8">' . $html); libxml_clear_errors();
        $x = new DOMXPath($d);
        $txt = fn($n) => trim(preg_replace('/\s+/u',' ', $n->textContent));

        $h1 = $x->query('//h1')->item(0);
        // ищем все "N ₽" в теле
        $body = $x->query('//body')->item(0);
        $flat = $txt($body);
        preg_match_all('/([\d\s ]{3,10})\s*₽/u', $flat, $m);
        $prices = array_values(array_unique(array_map(fn($s) => (int)preg_replace('/\D/','',$s), $m[1])));
        $prices = array_values(array_filter($prices, fn($p) => $p >= 500));
        sort($prices);

        // характеристики вида "Продолжительность: 4 часа"
        $facts = [];
        foreach (['Продолжительность','Расписание','Формат обучения','Стоимость','Количество занятий','Группа'] as $k) {
            if (preg_match('/' . preg_quote($k,'/') . '[:\s]*([^:]{2,60}?)(?=(Продолжительность|Расписание|Формат|Стоимость|Количество|Группа|$))/u', $flat, $mm)) {
                $facts[$k] = trim($mm[1]);
            }
        }
        $out[] = [
            'school' => $school,
            'url'    => $u,
            'title'  => $h1 ? $txt($h1) : null,
            'prices' => $prices,
            'facts'  => $facts,
        ];
    }
}
file_put_contents(__DIR__ . '/courses.json', json_encode($out, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
foreach ($out as $c) {
    printf("%-16s %-34s %s\n", $c['school'], mb_substr($c['title'] ?? '—', 0, 32), implode(' / ', $c['prices']) ?: 'цен нет');
}
