<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // MariaDB фикс длинны уникального ключа
        Schema::defaultStringLength(191);

        Blade::directive('money', function($amount) {
            return $amount;
            //return number_format((int) $amount/100, 2, ',', ' ');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

    }
}
