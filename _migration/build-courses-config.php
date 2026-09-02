<?php
$cat = json_decode(file_get_contents(__DIR__ . '/catalog.json'), true);
$schools = [];
foreach ($cat as $c) {
    $schools[$c['school']][] = [
        'id'       => basename($c['url'], '.html'),
        'title'    => $c['title'],
        'desc'     => $c['desc'],
        'price'    => $c['price'],
        'old'      => $c['old_price'],
        'url'      => $c['url'],
        'duration' => $c['facts']['Продолжительность'] ?? null,
        'format'   => $c['facts']['Формат обучения'] ?? null,
        'schedule' => $c['facts']['Расписание'] ?? null,
    ];
}
$data = [
    // Пороги скидок: от скольки курсов — сколько процентов.
    // Значения предварительные, согласовываются с заказчиком.
    'discounts' => [3 => 10, 4 => 15, 5 => 20],
    'schools'   => $schools,
];
file_put_contents(dirname(__DIR__) . '/laravel/config/courses.php', "<?php\n\nreturn " . var_export($data, true) . ";\n");
echo "школ: " . count($schools) . " | курсов: " . count($cat) . "\n";
