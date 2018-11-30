<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{
    public function __construct()
    {
        $this->middleware('hits');
    }
    //
    public function index(Request $request)
    {

        // Кэшируется через теребоньку по крону с консоли, но на всякий случай и в мидле проверяется наличие закешированноц погоды
        if(Cache::has('current_weather')) {
            $data = Cache::get('current_weather');
        }
        else {
            abort(404);
        }

        $time = Carbon::now()->timezone((isset($data['info']['tzinfo'])) ? $data['info']['tzinfo']['name'] : env('timezone'))->format('H:i');

        return view('weather', ['data'=> $data, 'time' => $time]);
    }
}
