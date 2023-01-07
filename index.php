<?php
require_once 'vendor/autoload.php';

$router = new \Bramus\Router\Router();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router->get('/whatsapp_api/{number}/{message}/{pass}', function ($number, $message, $pass) {
    include('./services/whatsapp_api.php');
});

$router->set404(function () {
    header('HTTP/1.1 404 Not Found');
    echo "Tu estas loco aqui no hay nada";
});

$router->run();
