<?php

use Phalcon\Mvc\Router;

$router = new Router();

$router->add('/weather',
    [
        'controller' => 'weather',
        'action' => 'index'
    ],
    [
        'controller' => 'city',
        'action' => 'index'
    ]
);