<?php

namespace App\Repositories;

interface WeatherInterface
{
    /**
     * @param string $city
     * @return mixed
     */
    public function findByCity(string $city);

    /**
     * @param string $lat
     * @param string $lon
     * @return mixed
     */
    public function findByCoords(string $lat, string $lon);
}