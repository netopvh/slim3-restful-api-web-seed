<?php

$container = $app->getContainer();

// Cross-Origin Resource Sharing
// -----------------------------------------------------------------------------
$container['corsMiddleware'] = function ($container) {
    $settings = $container->get('settings')['cors'];

    return new \Tuupola\Middleware\CorsMiddleware([
        'logger' => $container->get('logger'),
        'origin' => $settings['origin'],
        'methods' => $settings['methods'],
        'headers.allow' => $settings['headers_allow'],
        'headers.expose' => $settings['headers_expose'],
        'credentials' => $settings['credentials'],
        'cache' => $settings['cache'],
    ]);
};

// Database
// -----------------------------------------------------------------------------
$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager();
    $capsule->addConnection($container->get('settings')['db']);
    $capsule->setAsGlobal();

    return $capsule;
};
$container->get('db')->bootEloquent();

// Logger
// -----------------------------------------------------------------------------
$container['logger'] = function ($container) {
    $settings = $container->get('settings')['logger'];
    $logger = new \Monolog\Logger($settings['name']);
    $formatter = new \Monolog\Formatter\LineFormatter('[%datetime%] [%level_name%]: %message% %context%'."\n", null, true, true);
    $rotating = new \Monolog\Handler\RotatingFileHandler($settings['path'], 0, $settings['level']);
    $rotating->setFormatter($formatter);
    $logger->pushHandler($rotating);

    return $logger;
};

// View
// -----------------------------------------------------------------------------
$container['view'] = function ($container) {
    $twig = new \Slim\Views\Twig(__DIR__.'/../resources/views', []);
    $basePath = rtrim(str_ireplace('index.php', '', $container->get('request')->getUri()->getBasePath()), '/');
    $twig->addExtension(new \Slim\Views\TwigExtension($container->get('router'), $basePath));

    return $twig;
};

//
// -----------------------------------------------------------------------------
//$container[""] = function ($container) {};
