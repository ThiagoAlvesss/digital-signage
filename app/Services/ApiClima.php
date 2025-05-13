<?php

namespace App\Services;

use GuzzleHttp\Client;

class ApiClima
{
    protected $client;
    protected $apiKey;
    protected $city;

    public function __construct()
    {
        $this->apiKey = config('services.openweather.key');
        $this->city = config('services.openweather.city');
        $this->client = new Client([
            'base_uri' => 'https://api.openweathermap.org/data/2.5/',
            'timeout' => 5.0,
        ]);
    }

    public function obterClima()
    {
        $response = $this->client->get('weather', [
            'query' => [
                'q' => $this->city,
                'appid' => $this->apiKey,
                'units' => 'metric',
                'lang' => 'pt',
            ],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        return $data;
    }
}
