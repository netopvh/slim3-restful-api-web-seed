<?php

use App\Controllers\WebController;

$app->get('/', WebController::class.':indexAction')->setName('index');
