<?php

namespace App\Services;

use app\repositories\SpellerInterface;
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

    /** @var SpellerInterface  */
    protected $speller;

    /**
     * WeatherService constructor.
     * @param WeatherInterface $weather
     * @param WeatherValidation $validation
     * @param SpellerInterface $speller
     */
    public function __construct(
        WeatherInterface $weather,
        WeatherValidation $validation,
        SpellerInterface $speller
    ) {
        $this->validation = $validation;
        $this->weather = $weather;
        $this->speller = $speller;
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

        if ($data['city']) {
            $cityName = $this->speller->spellByCity($data['city']);
            $weatherInfo = $this->weather->findByCity($cityName);
        } else {
            $weatherInfo = $this->weather->findByCoords($data['lat'], $data['lon']);
        }

        return $weatherInfo;
    }
}