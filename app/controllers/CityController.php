<?php

use Phalcon\Mvc\Controller;
use App\Services\CityService;
use App\Repositories\CityRepository;
use Exception;

class CityController extends Controller
{
    public function indexAction()
    {
        try {
            $cityService = new CityService(new CityRepository());
            $cities = $cityService->getCities();
        } catch (Exception $exception) {
            echo $exception->getMessage();
            die;
        }

        $this->view->setVar('cities', $cities);
    }
}