<?php
$file = __DIR__ . '/../laravel/resources/views/pages/index.blade.php';
$html = file_get_contents($file);

// вырезаем секции верхнего уровня (вложенных <section> на главной нет)
preg_match_all('/<section class="([a-z-]+)[^"]*"[^>]*>.*?<\/section>/s', $html, $m, PREG_OFFSET_CAPTURE);
$found = [];
foreach ($m[0] as $i => [$frag, $off]) $found[$m[1][$i][0]] = $frag;
echo "найдено секций: " . count($found) . " (" . implode(', ', array_keys($found)) . ")\n";

// новый порядок: сначала то, за чем человек пришёл, затем доверие, затем детали
$order = [
    'hero',              // кто мы и для кого
    'programs',          // курсы — главная цель визита
    '@constructor-cta',  // не выбрал? собери сам
    '@documents',        // что получишь на выходе — снимает главное возражение
    '@reviews',          // доверие
    'about',
    'team',
    'reasons',
    'directions',
    'business-courses',
    'certificate',
    'events',
    'partners',
    'faq',
    'contact',
];

$out = [];
$missing = [];
foreach ($order as $key) {
    if ($key[0] === '@') {
        $out[] = "@include('partials.blocks." . substr($key, 1) . "')";
        continue;
    }
    if (!isset($found[$key])) { $missing[] = $key; continue; }
    $out[] = $found[$key];
    unset($found[$key]);
}
if ($missing)  echo "НЕ НАЙДЕНЫ: " . implode(', ', $missing) . "\n";
if ($found)    echo "НЕ РАЗМЕЩЕНЫ (добавлены в конец): " . implode(', ', array_keys($found)) . "\n";
foreach ($found as $frag) $out[] = $frag;   // ничего не теряем

// заменяем первую секцию на весь новый набор, остальные вырезаем
$first = true;
$result = preg_replace_callback('/<section class="[a-z-]+[^"]*"[^>]*>.*?<\/section>/s',
    function () use (&$first, $out) {
        if (!$first) return '';
        $first = false;
        return implode("\n\n", $out);
    }, $html);

file_put_contents($file, $result);
echo "готово, блоков в новом порядке: " . count($out) . "\n";
