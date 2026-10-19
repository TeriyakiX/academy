<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
 | Каталог оборудования живёт в CRM, а витрине он нужен в своей базе:
 | фильтры, сортировка и страницы работают по ней. Раз в полчаса
 | забираем свежий список, чтобы правка цены в CRM доезжала сама.
 |
 | На сервере должен быть запущен планировщик Laravel:
 | * * * * * php8.4 artisan schedule:run
 */
Schedule::command('site:catalog-sync')
    ->everyThirtyMinutes()
    ->withoutOverlapping()
    ->runInBackground();
