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

foreach (config('site.pages') as $uri => $page) {
    Route::get($uri, fn () => view('pages.' . $page['view'], ['seo' => $page]))
        ->name('page' . str_replace(['/', '.html', '.'], ['.', '', '_'], rtrim($uri, '/')) ?: 'home');
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
