<?php

use Phalcon\Loader;

//Register an autoloader
$loader = new Loader();

$loader->registerDirs([
    $config->application->controllersDir,
    $config->application->modelsDir,
    $config->application->migrationsDir,
]);

$loader->registerNamespaces([
    'App\Services' => $config->application->servicesDir,
    'App\Repositories' => $config->application->repositoriesDir,
    'App\Validations' => $config->application->validationsDir,
]);

$loader->register();