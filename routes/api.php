<?php

use App\Controllers\ApiController;

$app->group('/api', function () {
    $this->get('', ApiController::class.':getAction')->setName('api');
});
