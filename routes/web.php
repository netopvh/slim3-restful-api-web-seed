<?php

use App\Controllers\IndexController;

$container = $app->getContainer();

// ###> Index ###
$app->get('/', IndexController::class.':indexView')->setName('index');
// ###< Index ###
