<?php

namespace App\Http\Middleware;

use Closure;
use Artdevision\YandexWeather\Client as YandexWeatherClient;
use Illuminate\Support\Facades\Cache;

class HitsMiddleware
{
    private $client;

    // Тут по красоте Dependency Injection
    public function __construct(YandexWeatherClient $client)
    {
        $this->client = $client;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Cache::has('current_weather')) {
            Cache::put('current_weather', $this->client->get('forecast', [
                'lat'   => 53.243325,
                'lon'   => 34.363731,
                'lang'  => 'ru_RU',
                'limit' => 2,
                'extra' => true,
            ]), 2);
        }
        return $next($request);
    }
}
