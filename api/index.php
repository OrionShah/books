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


$app->group('/users[/[{id:[0-9]+}/[{name}/]]]', function () {
    // отправляем все запросы в UserController
    $this->map(['GET', 'POST', 'DELETE', 'PATCH', 'PUT'], '', 'Controllers\UserController');
});


$app->run();
