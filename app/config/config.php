<?php

use Phalcon\Config;

return new Config([
    'database' => [
        'adapter'  => 'Mysql',
        'host'     => 'localhost',
        'port'     => 3306,
        'username' => 'myskin',
        'password' => '123',
        'dbname'   => 'phalcon',
        'charset'  => 'utf8'
    ],
    'application' => [
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir' => APP_PATH . '/models/',
        'migrationsDir' => APP_PATH . '/migrations/',
        'servicesDir' => APP_PATH . '/services/',
        'repositoriesDir' => APP_PATH . '/repositories/',
        'viewsDir' => APP_PATH . '/views/',
        'validationsDir' => APP_PATH . '/validations/',
        'baseUri' => '/',
    ],
    'api' => [
        'key' => '1bd9d367265508c055f503da60b63c44'
    ]
]);

