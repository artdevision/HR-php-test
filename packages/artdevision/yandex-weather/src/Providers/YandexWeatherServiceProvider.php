<?php

namespace Artdevision\YandexWeather\Providers;

use Illuminate\Support\ServiceProvider;

class YandexWeatherServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->publishes([
            __DIR__ . '/../config' => base_path('config'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/../resources' => base_path('resources'),
        ], 'lang');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('YandexWeatherClient', function() {
            return new \Artdevision\YandexWeather\Client();
        });
    }
}
