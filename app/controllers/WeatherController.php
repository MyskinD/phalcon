<?php

use App\Services\WeatherService;
use App\Services\CityService;
use App\Repositories\OpenWeatherMap;
use App\Validations\WeatherValidation;
use App\Repositories\CityRepository;
use Exception;

class WeatherController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        $inputData = $this->request->getPost();

        try {
            $weatherService = new WeatherService(
                new OpenWeatherMap(),
                new WeatherValidation()
            );
            $weatherResult = $weatherService->getWeather($inputData);
            if ($weatherResult) {
                (new CityService(new CityRepository()))->createCity($weatherResult);
            }

            dd($weatherResult);

        } catch (Exception $exception) {
            echo $exception->getMessage();
            die;
        }

    }
}