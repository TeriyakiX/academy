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
