<?php

namespace App\Services;

use App\Validations\Validation;

class WeatherService extends \Phalcon\DI\Injectable
{
    /** @var Validation  */
    protected $validation;

    /**
     * WeatherService constructor.
     */
    public function __construct()
    {
        $this->validation = new Validation();
    }

    /**
     * @param array $data
     * @return array
     */
    public function getWeather(array $data): array
    {
        /**TODO there will be validation */

        $apiRequest = 'http://api.openweathermap.org/data/2.5/weather?';
        if ($data['city']) {
            $apiRequest .= 'q=' . $data['city'];
        } else if ($data['lon'] && $data['lat']) {
            $apiRequest .= 'lat=' . $data['lat'] . '&lon=' . $data['lon'];
        }

        $apiRequest .= '&APPID=' . $this->config->api->key;

        $info = file_get_contents($apiRequest);

        dd(json_decode($info, true));

        return $data;
    }
}