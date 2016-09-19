<?php

require_once "../vendor/autoload.php";

$config = ['settings' => [
    'displayErrorDetails' => true,
    'addContentLengthHeader' => false,
]];

$app = new \Slim\App($config);

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


$app->run();
