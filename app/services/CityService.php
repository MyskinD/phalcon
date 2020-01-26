<?php

namespace App\Services;

use App\Repositories\WeatherDTO;
use App\Repositories\CityRepository;

class CityService extends \Phalcon\DI\Injectable
{
    /** @var CityRepository  */
    protected $cityRepository;

    /**
     * CityService constructor.
     * @param CityRepository $cityRepository
     */
    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * @param WeatherDTO $dto
     */
    public function createCity(WeatherDTO $dto)
    {
        $this->cityRepository->add($dto);
    }

    /**
     * @return array
     */
    public function getCities(): array
    {
        return $this->cityRepository->all();
    }
}