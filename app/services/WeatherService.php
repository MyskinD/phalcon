<?php

namespace App\Services;

use App\Validations\Validation;
use App\Repositories\WeatherInterface;
use Exception;

class WeatherService extends \Phalcon\DI\Injectable
{
    /** @var Validation  */
    protected $validation;

    /** @var WeatherInterface  */
    protected $weather;

    /**
     * WeatherService constructor.
     * @param WeatherInterface $weather
     * @param Validation $validation
     */
    public function __construct(
        WeatherInterface $weather,
        Validation $validation
    ) {
        $this->validation = $validation;
        $this->weather = $weather;
    }

    /**
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function getWeather(array $data): array
    {
        $this->validation->isNotNullIncomingData($data);
        $this->validation->isCorrectCityName($data);
        $this->validation->isCorrectCoords($data);

        $output = null;
        if ($data['city']) {
            $output = $this->weather->findByCity($data['city']);
        } else if ($data['lat'] && $data['lon']) {
            $output = $this->weather->findByCoords($data['lat'], $data['lon']);
        }
        $output = json_decode($output, true);

        return $output;
    }
}