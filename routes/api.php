<?php

use App\Controllers\IndexController;

// ###> Api ###
$app->group('/api', function () {
    // ###> Index ###
    $this->get('/index', IndexController::class.':getAction')->setName('api');
    // ###< Index ###
})->add(new Tuupola\Middleware\CorsMiddleware($container->settings['cors']));
// ###< Api ###
