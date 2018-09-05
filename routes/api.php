<?php

use App\Controllers\IndexController;

// ###> Api ###
$app->group('/api', function () {
    // ###> Index ###
    $this->get('/index', IndexController::class.':getAction')->setName('api');
    // ###< Index ###
});
// ###< Api ###
