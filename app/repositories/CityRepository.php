<?php

namespace app\repositories;

use App\Repositories\WeatherDTO;

class CityRepository
{
    /**
     * @param \App\Repositories\WeatherDTO $dto
     */
    public function add(WeatherDTO $dto): void
    {
        $city = new \Cities();
        $city->name = $dto->name;
        $city->lat = $dto->coord['lat'];
        $city->lon = $dto->coord['lon'];
        $city->date = date('Y-m-d H:i:s', $dto->dt);
        $city->save();
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return \Cities::find();
    }
}