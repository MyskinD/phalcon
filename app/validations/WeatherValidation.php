<?php

namespace App\Validations;

use InvalidArgumentException;

class WeatherValidation
{
    /**
     * @param array $data
     * @throws Exception
     */
    public function isNotNullIncomingData(array $data): void
    {
        if (!($data['lon'] && $data['lat']) && !$data['city']) {
            throw new InvalidArgumentException('City name or its coordinates should not be empty');
        }
    }

    /**
     * @param array $data
     * @throws Exception
     */
    public function isCorrectCityName(array $data): void
    {
        $pattern = '/^[A-Za-zА-Яа-яЁё-]+$/ism';
        if ($data['city'] && !preg_match($pattern, $data['city'])) {
            throw new InvalidArgumentException('Enter the correct field `CITY`');
        }
    }

    /**
     * @param array $data
     * @throws Exception
     */
    public function isCorrectCoords(array $data): void
    {
        $pattern = '/^[\d]{2}\.[\d]+$/ism';
        if (!$data['city'] && $data['lon'] && !preg_match($pattern, $data['lon'])) {
            throw new InvalidArgumentException('Enter the correct field `LON`');
        }
        if (!$data['city'] && $data['lat'] && !preg_match($pattern, $data['lat'])) {
            throw new InvalidArgumentException('Enter the correct field `LAT`');
        }
    }
}