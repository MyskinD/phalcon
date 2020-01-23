<?php

use App\Services\WeatherService;

class WeatherController extends \Phalcon\Mvc\Controller
{
    public function indexAction()
    {
        $inputData = $this->request->getPost();

        $service = new WeatherService();
        $result = $service->getWeather($inputData);


    }


}