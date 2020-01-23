<?php

use Phalcon\Mvc\Application;

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {

    /** Loading global functions */
    require __DIR__ . '/../app/config/functions.php';

    /**
     * Loading Configs
     * @var $config
     */
    $config = require(__DIR__ . '/../app/config/config.php');

    /** Autoloading classes */
    require __DIR__ . '/../app/config/loader.php';

    /**
     * Initializing DI container
     * @var \Phalcon\DI\FactoryDefault $di
     */
    $di = require __DIR__ . '/../app/config/di.php';

    /**
     * Handle the request
     * @var $application
     */
    $application = new Application($di);

    /** Initializing routes */
    require __DIR__ . '/../app/config/routes.php';

    $response = $application->handle();
    $response->send();

} catch (\Phalcon\Exception $exception) {
    echo "PhalconException: ", $e->getMessage();
}