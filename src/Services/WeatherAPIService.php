<?php


namespace App\Services;


use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherAPIService
{

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getCurrentWeatherForWro()
    {
        try {
            $url = 'http://api.weatherapi.com/v1/current.json?key=' . $_ENV['API_WEATHER_KEY'] . '&q=Wroclaw';

            $response = $this->client->request(
                'GET',
                $url
            );

            $content = $response->getContent();
            $decode = json_decode($content);
        } catch (\Exception $exception) {
            throw new \HttpException(502, "Can not took info from API");
        }

        return $decode;
    }
}