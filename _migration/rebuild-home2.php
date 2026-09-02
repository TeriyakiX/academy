<?php
/*
 | Пересобирает порядок блоков главной: старые секции сайта + новые ab-блоки.
 | Идемпотентно: сначала снимает ранее вставленные @include, потом расставляет заново.
 */

$file = __DIR__ . '/../laravel/resources/views/pages/index.blade.php';
$html = file_get_contents($file);

// 1. убираем ранее вставленные include блоков
$html = preg_replace("/@include\('partials\.blocks\.[a-z-]+'\)\s*/", '', $html);

// 2. собираем существующие секции сайта
preg_match_all('/<section class="([a-z-]+)[^"]*"[^>]*>.*?<\/section>/s', $html, $m);
$found = [];
foreach ($m[0] as $i => $frag) $found[$m[1][$i]] = $frag;
echo 'секций сайта: ' . count($found) . ' (' . implode(', ', array_keys($found)) . ")\n";

// 3. новый порядок. @ — новый блок, остальное — существующие секции
$order = [
    '@hero',             // первый экран: направления, оффер, оценки площадок
    '@stats',            // школа в цифрах и оценки площадок
    '@courses-tabs',     // курсы с вкладками направлений
    '@constructor-cta',  // не выбрал — собери сам
    '@schedule',         // когда учиться
    '@steps',            // как проходит обучение
    '@documents',        // что получишь
    '@reviews',          // отзывы
    '@teachers',         // кто учит
    '@about',
    'reasons',
    'directions',
    'business-courses',
    '@certificate',
    'events',
    '@partners',
    '@faq',
    '@lead',             // заявка перед контактами
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
if ($missing) echo 'НЕ НАЙДЕНЫ: ' . implode(', ', $missing) . "\n";
// эти секции заменены новыми блоками — старые версии не переносим
unset(
    $found['team'], $found['programs'], $found['partners'],
    $found['hero'], $found['faq'], $found['about'], $found['certificate']
);
if ($found)   echo 'не размещены, добавлены в конец: ' . implode(', ', array_keys($found)) . "\n";
foreach ($found as $frag) $out[] = $frag;

// 4. первое вхождение секции заменяем на весь набор, прочие вырезаем
$first = true;
$html = preg_replace_callback('/<section class="[a-z-]+[^"]*"[^>]*>.*?<\/section>/s',
    function () use (&$first, $out) {
        if (!$first) return '';
        $first = false;
        return implode("\n\n", $out);
    }, $html);

file_put_contents($file, $html);
echo 'блоков на главной: ' . count($out) . "\n";
