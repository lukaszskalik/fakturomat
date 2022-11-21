<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function getKrakow()
    {
        $response = Http::get('https://api.openweathermap.org/data/2.5/weather?q=krakow&appid=&units=metric');

        if ($response->status() == 200)
        {
            $content = json_decode($response->getBody());
            return $content;
        }

    }
}
