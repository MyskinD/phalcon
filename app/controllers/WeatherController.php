<?php

use Phalcon\Mvc\Controller;
use App\Services\WeatherService;
use App\Services\CityService;
use App\Repositories\OpenWeatherMap;
use App\Repositories\YandexSpeller;
use App\Validations\WeatherValidation;
use App\Repositories\CityRepository;
use Exception;

class WeatherController extends Controller
{
    public function indexAction()
    {
        $inputData = $this->request->getPost();

        try {
            $weatherService = new WeatherService(
                new OpenWeatherMap(
                    $this->config->openWeatherMap->http,
                    $this->config->openWeatherMap->key
                ),
                new WeatherValidation(),
                new YandexSpeller($this->config->yandexSpeller->http)
            );
            $weatherResult = $weatherService->getWeather($inputData);
            (new CityService(new CityRepository()))->createCity($weatherResult);
        } catch (Exception $exception) {
            echo $exception->getMessage();
            die;
        }

        $this->view->setVar('weather', $weatherResult);
    }
}