<?php

use App\Services\WeatherService;
use App\Repositories\OpenWeatherMap;
use App\Validations\Validation;
use Exception;

class WeatherController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        $inputData = $this->request->getPost();

        try {
            $weatherService = new WeatherService(new OpenWeatherMap(), new Validation());
            $result = $weatherService->getWeather($inputData);

            dd($result);

        } catch (Exception $exception) {
            echo $exception->getMessage();
            die;
        }

    }
}