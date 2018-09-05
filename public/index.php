<?php

require_once __DIR__ . '/../bootstrap/app.php';
require_once __DIR__ . '/../bootstrap/container.php';
require_once __DIR__ . '/../bootstrap/middleware.php';

foreach (glob(__DIR__.'/../routes/*.php') as $route) {
    require_once $route;
}

$app->run();
