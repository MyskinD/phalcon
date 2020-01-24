<?php

namespace app\repositories;

use App\Repositories\WeatherInterface;

class OpenWeatherMap extends \Phalcon\DI\Injectable implements WeatherInterface
{
    /** @var string  */
    protected $http;

    /** @var string  */
    protected $appId;

    /**
     * OpenWeatherMap constructor.
     */
    public function __construct()
    {
        $this->http = 'http://api.openweathermap.org/data/2.5/weather?';
        $this->appId = '&APPID=' . $this->config->api->key;
    }

    /**
     * @param string $city
     * @return bool|mixed|string
     */
    public function findByCity(string $city)
    {
        $url = $this->http . 'q=' . $city . $this->appId;

        return $this->getWeather($url);
    }

    /**
     * @param string $lat
     * @param string $lon
     * @return bool|mixed|string
     */
    public function findByCoords(string $lat, string $lon)
    {
        $url = $this->http . 'lat=' . $lat . '&lon=' . $lon . $this->appId;

        return $this->getWeather($url);
    }

    /**
     * @param string $url
     * @return bool|string
     */
    public function getWeather(string $url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }
}