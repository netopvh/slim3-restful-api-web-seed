<?php

require_once __DIR__.'/../vendor/autoload.php';

try {
    $dotenv = new Symfony\Component\Dotenv\Dotenv();
    $dotenv->load(__DIR__.'/../.env');
} catch (Symfony\Component\Dotenv\Exception\PathException $ex) {
    echo $ex->getMessage();
    exit(1);
}

$app = new Slim\App([
    'settings' => [
        'displayErrorDetails' => 'dev' === getenv('APP_ENV'),
        'app' => [
            'name' => getenv('APP_NAME'),
        ],
        'cors' => [
            'origin' => getenv('CORS_ALLOW_ORIGIN'),
            'methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'],
            'headers_allow' => ['X-Requested-With', 'Content-Type', 'Accept', 'Origin', 'Authorization'],
            'headers_expose' => ['Authorization', 'Etag'],
            'credentials' => true,
            'cache' => 0,
        ],
        'db' => [
            'driver' => 'mysql',
            'host' => getenv('DB_HOST'),
            'port' => getenv('DB_PORT'),
            'database' => getenv('DB_DATABASE'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ],
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__.'/../logs/app.log',
            'level' => Monolog\Logger::DEBUG,
        ],
    ],
]);
