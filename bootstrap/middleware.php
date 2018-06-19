<?php

$container = $app->getContainer();

// Cross-Origin Resource Sharing
// -----------------------------------------------------------------------------
$app->add($container->get('corsMiddleware'));

//
// -----------------------------------------------------------------------------
//$app->add();
