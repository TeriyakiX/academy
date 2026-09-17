<?php

namespace App\Providers;

use App\Services\CrmCatalog;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /* Курсы и цены — из CRM. Делаем это до загрузки маршрутов:
           по списку курсов строятся адреса страниц. В консоли не нужно. */
        if (!$this->app->runningInConsole()) {
            $this->app->make(CrmCatalog::class)->apply();
        }
    }
}
