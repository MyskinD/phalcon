<?php

namespace app\repositories;

use App\Repositories\WeatherInterface;
use App\Repositories\WeatherDTO;

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
     * @return \App\Repositories\WeatherDTO
     */
    public function findByCity(string $city): WeatherDTO
    {
        $url = $this->http . 'q=' . $city . $this->appId;

        return $this->getWeather($url);
    }

    /**
     * @param string $lat
     * @param string $lon
     * @return \App\Repositories\WeatherDTO
     */
    public function findByCoords(string $lat, string $lon): WeatherDTO
    {
        $url = $this->http . 'lat=' . $lat . '&lon=' . $lon . $this->appId;

        return $this->getWeather($url);
    }

    /**
     * @param string $url
     * @return \App\Repositories\WeatherDTO
     */
    public function getWeather(string $url): WeatherDTO
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = json_decode(curl_exec($ch), true);
        curl_close($ch);

        $dto = new WeatherDTO();
        $dto->coord = $output['coord'];
        $dto->weather = $output['weather'];
        $dto->base = $output['base'];
        $dto->main = $output['main'];
        $dto->visibility = $output['visibility'];
        $dto->wind = $output['wind'];
        $dto->clouds = $output['clouds'];
        $dto->dt = $output['dt'];
        $dto->sys = $output['sys'];
        $dto->timezone = $output['timezone'];
        $dto->id = $output['id'];
        $dto->name = $output['name'];
        $dto->cod = $output['cod'];

        return $dto;
    }
}