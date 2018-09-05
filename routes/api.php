<?php

use App\Controllers\AuthController;
use App\Controllers\IndexController;

// ###> Api ###
$app->group('/api', function () {
    // ###> Auth ###
    $this->group('/auth', function () {
        $this->get('/login', AuthController::class.':postAction');
    });
    // ###< Auth ###

    // ###> Index ###
    $this->get('/index', IndexController::class.':getAction')->setName('api');
    // ###< Index ###
});
// ###< Api ###
