<?php

// Cross-origin Resource Sharing
// -----------------------------------------------------------------------------
$app->add(new Tuupola\Middleware\CorsMiddleware($container->settings['cors']));

//
// -----------------------------------------------------------------------------
//$app->add();
