<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../view/CounterView.php';
require_once __DIR__ . '/../view/statistics.php';
require_once __DIR__ . '/../src/config.php';
require_once __DIR__ . '/../src/controller/CounterController.php';

use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

//If the application is in first access we configure it:
if (!isset($GLOBALS['setup']) || !$GLOBALS["setup"]) config();

//Init counter:
$counterView = new CounterView();
$counter = new CounterController();

//Routes:
$router = new RouteCollector();
$router->get('/', function () use ($counter, $counterView) {
    $counterView->render($counter);
});
$router->post('/store', function () use ($counter) {
    $counter->store($_POST['amount']);
});
$router->get('/stats/', function () use ($counter) {
    statsView(null, null, $counter);
});
$router->post('/stats/', function () {
    $beginUnix = strtotime($_POST['begin']);
    $endUnix = strtotime($_POST['end']);
    header("location: /stats/".$beginUnix."-".$endUnix);
});
$router->get('/stats/{begin}-{end}', function ($begin, $end) use ($counter) {
    statsView($begin, $end, $counter);
});
$router->post('/stats/download', function () use ($counter) {
    $counter->download(strtotime($_POST['begin']), strtotime($_POST['end']));
});

$dispatcher = new Dispatcher($router->getData());

$response = $dispatcher->dispatch(
        $_SERVER['REQUEST_METHOD'],
        parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);
?>
</html>
