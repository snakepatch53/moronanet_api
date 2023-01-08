<?php
require_once __DIR__ . '/vendor/autoload.php';

$router = new \Bramus\Router\Router();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router->get('/', function () {
    include('./pages/api_info.php');
});

$router->get('/whatsapp/{number}/{message}/{pass}', function ($number, $message, $pass) {
    include('./services/whatsapp_api.php');
});

$router->get('/qrcode/location/{text}/{pass}', function ($text, $pass) {
    include('./services/qrcode_api.location.php');
});

$router->get('/qrcode/{text}/{pass}', function ($text, $pass) {
    include('./services/qrcode_api.php');
});

$router->set404(function () {
    header('HTTP/1.1 404 Not Found');
    echo "Tu estas loco aqui no hay nada";
});

$router->run();
