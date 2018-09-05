<?php

// Auth
// -----------------------------------------------------------------------------
$container['auth'] = function ($container) {
    $settings = $container->settings['jwt'];

    $authProvider = new App\Providers\AuthProvider();
    $claimsFactory = new Anddye\Auth\ClaimsFactory([
        'exp' => $settings['expiry'],
    ]);
    $jwtProvider = new Anddye\Providers\FirebaseProvider([
        'algorithm' => '',
        'secret' => $settings['secret'],
    ]);
    $factory = new Anddye\Auth\Factory($claimsFactory, $jwtProvider);
    $parser = new Anddye\Auth\Parser($jwtProvider);

    return new Anddye\Auth\JwtAuth($authProvider, $factory, $parser);
};

// Database
// -----------------------------------------------------------------------------
$container['db'] = function ($container) {
    $capsule = new Illuminate\Database\Capsule\Manager();
    $capsule->addConnection($container->settings['db']);
    $capsule->setAsGlobal();

    return $capsule;
};
$container->db->bootEloquent();

// Logger
// -----------------------------------------------------------------------------
$container['logger'] = function ($container) {
    $settings = $container->settings['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $formatter = new Monolog\Formatter\LineFormatter('[%datetime%] [%level_name%]: %message% %context%'."\n", null, true, true);
    $rotating = new Monolog\Handler\RotatingFileHandler($settings['path'], 0, $settings['level']);
    $rotating->setFormatter($formatter);
    $logger->pushHandler($rotating);

    return $logger;
};

// View
// -----------------------------------------------------------------------------
$container['view'] = function ($container) {
    $twig = new Slim\Views\Twig(__DIR__.'/../views', []);
    $basePath = rtrim(str_ireplace('index.php', '', $container->request->getUri()->getBasePath()), '/');
    $twig->addExtension(new Slim\Views\TwigExtension($container->router, $basePath));

    return $twig;
};

//
// -----------------------------------------------------------------------------
//$container[''] = function ($container) {};
