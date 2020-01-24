<?php

namespace App\Services;

use App\Validations\WeatherValidation;
use App\Repositories\WeatherInterface;
use App\Repositories\WeatherDTO;
use Exception;

class WeatherService extends \Phalcon\DI\Injectable
{
    /** @var WeatherValidation  */
    protected $validation;

    /** @var WeatherInterface  */
    protected $weather;

    /**
     * WeatherService constructor.
     * @param WeatherInterface $weather
     * @param WeatherValidation $validation
     */
    public function __construct(
        WeatherInterface $weather,
        WeatherValidation $validation
    ) {
        $this->validation = $validation;
        $this->weather = $weather;
    }

    /**
     * @param array $data
     * @return WeatherDTO
     * @throws Exception
     */
    public function getWeather(array $data): WeatherDTO
    {
        $this->validation->isNotNullIncomingData($data);
        $this->validation->isCorrectCityName($data);
        $this->validation->isCorrectCoords($data);

        $output = null;
        if ($data['city']) {
            $output = $this->weather->findByCity($data['city']);
        } else {
            $output = $this->weather->findByCoords($data['lat'], $data['lon']);
        }

        return $output;
    }
}