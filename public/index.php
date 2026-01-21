<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../view/header.php';

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

//config();

//Routes:
$router = new RouteCollector();
$router->get('/', function () {
    headerHTML("Counter");
});
$router->get('/stats/{begin}-{end}', function ($begin, $end) {});

$dispatcher = new Dispatcher($router->getData());

$response = $dispatcher->dispatch(
        $_SERVER['REQUEST_METHOD'],
        parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

echo $response;
?>