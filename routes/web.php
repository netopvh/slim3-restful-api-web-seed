<?php

use App\Controllers\IndexController;

// ###> Index ###
$app->get('/', IndexController::class.':indexView')->setName('index');
// ###< Index ###
