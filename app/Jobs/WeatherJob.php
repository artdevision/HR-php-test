<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Artdevision\YandexWeather\Client as YandexWeatherClient;
use Illuminate\Support\Facades\Cache;

class WeatherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $client;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(YandexWeatherClient $client)
    {
        //
        $data = $client->get('forecast', [
            'lat'   => 53.243325,
            'lon'   => 34.363731,
            'lang'  => 'ru_RU',
            'limit' => 2,
            'extra' => true,
        ]);
        Cache::put('current_weather', $data, 2);

    }
}
