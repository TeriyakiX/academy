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

// Каталог оборудования
Route::get('/shop.html', [\App\Http\Controllers\ShopController::class, 'index'])->name('shop');
Route::get('/shop/{slug}.html', [\App\Http\Controllers\ShopController::class, 'show'])
    ->where('slug', '[a-z0-9-]+')->name('shop.show');

// Расписание мероприятий отдельной страницей
Route::get('/events.html', fn () => view('pages.events', ['seo' => [
    'title'       => 'Расписание мероприятий — мастер-классы и открытые встречи | Академия Бариста',
    'description' => 'Однодневные мастер-классы и открытые встречи Академии Бариста в Москве. Расписание ближайших мероприятий, стоимость и запись.',
    'canonical'   => 'https://academy-barista.ru/events.html',
    'body_attrs'  => ['class' => 'body'],
    'css'         => [],
    'js'          => [],
]]))->name('events');

// Конструктор курсов
Route::get('/constructor.html', fn () => view('pages.constructor', ['seo' => [
    'title'       => 'Конструктор курсов — соберите свою программу | Академия Бариста',
    'description' => 'Соберите собственный набор курсов и мастер-классов Академии Бариста. Чем больше направлений — тем выше скидка.',
    'canonical'   => 'https://academy-barista.ru/constructor.html',
    'body_attrs'  => ['class' => 'body'],
    'css'         => ['/assets/splide.css', '/assets/masterClass.css'],
]]))->name('constructor');

/*
 | Приём заявок со всех форм сайта.
 |
 | Перед обработкой отсекаем автоматические отправки:
 |  - заполнена скрытая ловушка (человек её не видит);
 |  - форма отправлена быстрее, чем её реально можно заполнить.
 | Боту отвечаем как обычно, чтобы он не подбирал обход.
 */
Route::post('/lead', function (
    \Illuminate\Http\Request $request,
    \App\Services\LeadService $leads
) {
    $data = $request->validate([
        'name'      => ['required', 'string', 'max:120'],
        'phone'     => ['required', 'string', 'max:40'],
        'email'     => ['nullable', 'email', 'max:120'],
        'source'    => ['nullable', 'string', 'max:200'],
        'page'      => ['nullable', 'string', 'max:200'],
        'comment'   => ['nullable', 'string', 'max:1000'],
        'courses'   => ['nullable', 'string', 'max:1000'],
        'website'   => ['nullable', 'string', 'max:200'],
        'loaded_at' => ['nullable', 'string'],
    ]);

    if (\App\Services\LeadService::looksAutomated($data)) {
        \Illuminate\Support\Facades\Log::channel('single')
            ->info('Заявка отброшена как автоматическая', ['page' => $data['page'] ?? null]);

        return redirect('/thank-you.html');
    }

    $leads->handle($data);

    return redirect('/thank-you.html');
})->name('lead.store');

/*
|--------------------------------------------------------------------------
| Файлы для поисковых роботов
|--------------------------------------------------------------------------
| Раньше это были два файла в public. Карту приходилось править руками,
| и она отстала: в ней было 22 адреса из 119, каталога не было вовсе,
| а одна страница уже не существовала. Теперь карта собирается из тех же
| данных, по которым строится сайт, и устареть не может.
*/

Route::get('/sitemap.xml', function () {
    $base = rtrim(config('seo.domain'), '/');

    /* Вес страницы: главная важнее разделов, разделы — карточек товаров. */
    $priority = function (string $uri): string {
        if ($uri === '/') return '1.0';
        if (str_starts_with($uri, '/shop/')) return '0.5';
        if (str_starts_with($uri, '/courses/') || str_starts_with($uri, '/master-class/')) return '0.8';

        return '0.7';
    };

    $skip = ['/thank-you.html', '/blog.html', '/article.html'];

    $urls = collect(array_keys(config('site.pages', [])))
        ->reject(fn ($uri) => in_array($uri, $skip, true));

    // каталог и карточки товаров
    $urls = $urls->merge(
        \App\Models\Product::active()->orderBy('sort')->pluck('slug')
            ->map(fn ($slug) => "/shop/{$slug}.html")
    );

    $xml = $urls->unique()->values()->map(fn ($uri) => sprintf(
        "  <url>\n    <loc>%s</loc>\n    <priority>%s</priority>\n  </url>",
        htmlspecialchars($base . ($uri === '/' ? '/' : $uri), ENT_XML1),
        $priority($uri)
    ))->implode("\n");

    return response(
        "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"
        . "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n{$xml}\n</urlset>\n"
    )->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('sitemap');

Route::get('/robots.txt', function (\Illuminate\Http\Request $request) {
    /*
     | Тестовой копии в поиске быть не должно: одинаковое содержимое
     | на двух доменах поисковик считает дублем и делит позиции.
     */
    if (in_array($request->getHost(), config('seo.noindex_hosts', []), true)) {
        return response("User-agent: *\nDisallow: /\n")
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    $rules = collect(config('seo.disallow', []))
        ->map(fn ($path) => "Disallow: {$path}")
        ->implode("\n");

    return response(
        "User-agent: *\n{$rules}\n\nSitemap: " . rtrim(config('seo.domain'), '/') . "/sitemap.xml\n"
    )->header('Content-Type', 'text/plain; charset=UTF-8');
})->name('robots');
