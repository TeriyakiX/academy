<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Страницы сайта
|--------------------------------------------------------------------------
| URL берутся из config/site.php и полностью повторяют адреса старого
| статического сайта, включая расширение .html — это условие сохранения
| поисковой индексации. Менять их нельзя.
*/

/*
 | 13 страниц курсов имеют одинаковую структуру, поэтому рендерятся
 | общим шаблоном pages/course с данными из config/course-pages.php.
 | Остальные страницы отдаются как есть.
 */
$coursePages = config('course-pages', []);
$catalog = collect(config('courses.schools'))
    ->flatMap(fn ($list, $school) => collect($list)->map(fn ($c) => $c + ['school' => $school]))
    ->keyBy('url');

/*
 | Каталог и страницы-подборки. Показывают карточки курсов вкладками:
 | либо все направления, либо одно.
 */
$catalogPages = [
    '/courses.html' => [
        'h1'     => 'курсы и программы',
        'lead'   => 'Все программы Академии Бариста: от первого дня за кофемашиной до управления кофейней.',
        'school' => null,
    ],
    '/courses/barista-courses.html' => [
        'h1'     => 'курсы бариста',
        'lead'   => 'Профессиональные программы для тех, кто хочет работать в кофейне или расти в профессии.',
        'school' => 'Курсы бариста',
    ],
    '/courses/master-class.html' => [
        'h1'     => 'Мастер Классы',
        'lead'   => 'Короткие практические занятия для любителей кофе и тех, кто хочет попробовать профессию.',
        'school' => 'Мастер-классы',
    ],
    '/courses/barnoe-delo.html' => [
        'h1'     => 'Барное Дело',
        'lead'   => 'Курсы бармена: методы приготовления коктейлей, баланс вкуса и подача.',
        'school' => 'Барное дело',
    ],
];

foreach (config('site.pages') as $uri => $page) {
    $routeName = 'page' . str_replace(['/', '.html', '.'], ['.', '', '_'], rtrim($uri, '/')) ?: 'home';

    if (isset($catalogPages[$uri])) {
        $meta = $catalogPages[$uri];
        $schools = config('courses.schools');
        if ($meta['school']) {
            $schools = array_intersect_key($schools, [$meta['school'] => true]);
        }

        Route::get($uri, fn () => view('pages.catalog', [
            'seo'     => $page,
            'catalog' => $meta + ['schools' => $schools],
        ]))->name($routeName);

        continue;
    }

    if (isset($coursePages[$uri])) {
        $data = $coursePages[$uri];
        $card = $catalog->get($uri, []);

        Route::get($uri, fn () => view('pages.course', [
            'seo'    => $page,
            'course' => $data + [
                'school'    => $card['school']    ?? 'Курсы',
                'price'     => $card['price']     ?? null,
                'old_price' => $card['old']       ?? null,
            ],
        ]))->name($routeName);

        continue;
    }

    Route::get($uri, fn () => view('pages.' . $page['view'], ['seo' => $page]))->name($routeName);
}

// Дубли страниц -> 301 на оригинал
foreach (config('site.redirects') as $from => $to) {
    Route::redirect($from, $to, 301);
}

// Старые адреса с WordPress-версии сайта
foreach ([
    '/barista-bazovyj'          => '/courses/barista-base.html',
    '/barista-v-take-away'      => '/master-class/barista-v-take-away.html',
    '/metod-stir'               => '/barnoe-delo/metod-ctir.html',
    '/latte-art'                => '/master-class/latte-art.html',
    '/upravlyayushhij-kofejni'  => '/courses/upravlyayushchiy-kofeyni.html',
] as $from => $to) {
    Route::redirect($from, $to, 301);
    Route::redirect($from . '/', $to, 301);
}

// Конструктор курсов
Route::get('/constructor.html', fn () => view('pages.constructor', ['seo' => [
    'title'       => 'Конструктор курсов — соберите свою программу | Академия Бариста',
    'description' => 'Соберите собственный набор курсов и мастер-классов Академии Бариста. Чем больше направлений — тем выше скидка.',
    'canonical'   => 'https://academy-barista.ru/constructor.html',
    'body_attrs'  => ['class' => 'body'],
    'css'         => ['/assets/splide.css', '/assets/masterClass.css'],
    'js'          => [['src' => '/assets/pageCommon.js', 'type' => 'module', 'defer' => false, 'async' => false]],
]]))->name('constructor');

/*
 | Приём заявки с главной.
 | Пока только логирование и редирект на «спасибо».
 | Отправку в CRM/Telegram подключим, когда заказчик определится с системой.
 */
Route::post('/lead', function (\Illuminate\Http\Request $request) {
    $data = $request->validate([
        'name'   => ['required', 'string', 'max:120'],
        'phone'  => ['required', 'string', 'max:40'],
        'source' => ['nullable', 'string', 'max:200'],
    ]);

    \Illuminate\Support\Facades\Log::channel('single')->info('Заявка с сайта', $data);

    return redirect('/thank-you.html');
})->name('lead.store');
