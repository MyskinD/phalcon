<?php

namespace app\repositories;

use App\Repositories\WeatherInterface;
use App\Repositories\WeatherDTO;
use InvalidArgumentException;

class OpenWeatherMap implements WeatherInterface
{
    /** @var string  */
    protected $http;

    /** @var string  */
    protected $appId;

    /**
     * OpenWeatherMap constructor.
     * @param $http
     * @param $key
     */
    public function __construct(string $http, string $key)
    {
        $this->http = $http;
        $this->appId = '&APPID=' . $key;
    }

    /**
     * @param string $city
     * @return \App\Repositories\WeatherDTO
     */
    public function findByCity(string $city): WeatherDTO
    {
        $format = '%sq=%s%s';
        $url = sprintf($format, $this->http, $city, $this->appId);

        return $this->getWeather($url);
    }

    /**
     * @param string $lat
     * @param string $lon
     * @return \App\Repositories\WeatherDTO
     */
    public function findByCoords(string $lat, string $lon): WeatherDTO
    {
        $format = '%slat=%s&lon=%s%s';
        $url = sprintf($format, $this->http, $lat, $lon, $this->appId);

        return $this->getWeather($url);
    }

    /**
     * @param string $url
     * @return \App\Repositories\WeatherDTO
     */
    protected function getWeather(string $url): WeatherDTO
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = json_decode(curl_exec($ch), true);
        curl_close($ch);

        if ($output['cod'] === '404') {
            throw new InvalidArgumentException($output['message']);
        }

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