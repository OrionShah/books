<?php

error_reporting(E_ALL);

require_once "../vendor/autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$config = ['settings' => [
    'displayErrorDetails' => true,
    'addContentLengthHeader' => false,
]];

$app = new \Slim\App($config);

$container = $app->getContainer();

$container['logger'] = function ($c) {
    $log = new Logger('app');
    $log->pushHandler(new StreamHandler($_SERVER['DOCUMENT_ROOT'] . "/logfile.log", Logger::INFO));
    return $log;
};

$app->get("/", function ($request, $response, $args) {
    return $response->write('Index');
});


//'/users/[{params:.*}]'
// отправляем все запросы в UserController
$app->map(
    ['GET', 'POST', 'DELETE', 'PATCH', 'PUT'],
    '/users[/[{id:[0-9]+}/[{name}/]]]',
    'Controllers\UserController'
);

$app->map(
    ['GET', 'POST', 'DELETE', 'PATCH', 'PUT'],
    '/book[/[{id:[0-9]+}/[{name}/[{page:[0-9]+}/]]]]',
    'Controllers\BookController'
);

$app->run();
