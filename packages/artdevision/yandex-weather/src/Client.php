<?php

namespace Artdevision\YandexWeather;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

class Client
{
    const BASE_URI = 'https://api.weather.yandex.ru/v1/';

    protected $http;

    protected $headers;

    public function __construct()
    {
        $config = config('weather');

        $this->headers = [
            'X-Yandex-API-Key' => $config['api_key'],
        ];

        $httpConfig = [
            'base_uri'=> self::BASE_URI,
            'timeout' => $config['timeout'],
            RequestOptions::HEADERS => $this->headers
        ];

        if (app()->environment() == 'local') {
//            $httpConfig[RequestOptions::DEBUG] = true;
            $httpConfig['curl'] = [CURLOPT_SSL_VERIFYPEER => false];
        }

        $this->http = new HttpClient($httpConfig);
    }

    public function get($endpoint = 'forecast', $data = []) {
        return $this->getResponse($this->http->request('GET', $endpoint, [RequestOptions::QUERY => $data]));
    }

    protected function getResponse(ResponseInterface $response)
    {
        $code = (int) $response->getStatusCode();
        $body = (string) $response->getBody();
        // 		print_r();
        $data =  json_decode($body, true);
        if ($code == 200) {
            return $data;
        }
        throw new \Exception(property_exists($data, 'error') ? $data->error : "Undefined error", $code);
    }

}