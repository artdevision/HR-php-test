@extends('layouts.main')

@section('title', 'Погодка')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Погода в Брянске</h3></div>
                    <div class="panel-body bg-info">
                        <div class="col-md-6">
                            <p>Сейчас: {{ $time }}</p>
                            <img src="//yastatic.net/weather/i/icons/funky/light/{{ $data['fact']['icon'] }}.svg" width="100px" />
                            <span style="font-size: 3em;"><strong>{{ $data['fact']['temp'] }}&deg;</strong></span>
                            <h4>@lang('weather.condition.' . $data['fact']['condition'])</h4>
                            <p>Ощущается как <strong>{{ $data['fact']['feels_like'] }}&deg;</strong></p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <small>Ветер @lang('weather.wind_dir.' . $data['fact']['wind_dir'])</small><br/>
                                <strong style="font-size: 1.2em;">{{ $data['fact']['wind_speed'] }} м/с</strong><br/>

                            </p>
                            <p>
                                <small>Давление</small><br/>
                                <strong style="font-size: 1.2em;">{{ $data['fact']['pressure_mm'] }} мм рт. ст.</strong>
                            </p>
                            <p>
                                <small>Влажность</small><br/>
                                <strong style="font-size: 1.2em;">{{ $data['fact']['humidity'] }}%</strong>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                @if(isset($data['forecasts'][0]))
                    @foreach($data['forecasts'][0]['parts'] as $key => $item)
                        @if(in_array($key, ['night', 'morning', 'day', 'evening']))
                            <div class="col-sm-3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">@lang('weather.parts.' . $key)</div>
                                    <div class="panel-body text-center bg-info">
                                        <img src="//yastatic.net/weather/i/icons/funky/light/{{ $item['icon'] }}.svg" height="40px" /><br/>
                                        <span style="font-size:2em;"><strong>{{ $item['temp_avg'] }}&deg;</strong></span>
                                    </div>
                                </div>

                            </div>
                        @endif
                    @endforeach
                @endif
                </div>
            </div>
        </div>

    </div>
@endsection