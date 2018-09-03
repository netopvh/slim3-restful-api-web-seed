<?php

use App\Controllers\IndexController;

$container = $app->getContainer();

// ###> Api ###
$app->group('/api', function () {
    // ###> Index ###
    $this->get('/index', IndexController::class.':getAction')->setName('api');
    // ###< Index ###
})->add($container->get('corsMiddleware'));
// ###< Api ###
