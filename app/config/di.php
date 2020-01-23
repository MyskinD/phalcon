<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View;

/** Create a DI */
$di = new FactoryDefault();

/** Common config */
$di->setShared('config', $config);

/** Database */
$di->set('db',
    function () use ($config) {
        return new DbAdapter([
            'host'     => $config->database->host,
            'username' => $config->database->username,
            'password' => $config->database->password,
            'dbname'   => $config->database->dbname,
        ]);
    }
);

/** Setup the view component */
$di->set('view', function() use ($config) {
    $view = new View();
    $view->setViewsDir($config->application->viewsDir);

    return $view;
});

/** Setup a base URI so that all generated URIs include the "tutorial" folder */
$di->set('url', function() {
    $url = new UrlProvider();
    $url->setBaseUri('/');

    return $url;
});

return $di;