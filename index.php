<?php
require_once __DIR__ . '/vendor/autoload.php';

$router = new \Bramus\Router\Router();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router->get('/', function () {
    include('./src/pages/api_info.php');
});

$router->get('/whatsapp/{number}/{message}/{pass}', function ($number, $message, $pass) {
    include('./src/services/whatsapp_api.php');
});

$router->get('/qrcode/location/{text}/{pass}', function ($text, $pass) {
    include('./src/services/qrcode_api.location.php');
    // echo ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://") . $_SERVER['SERVER_NAME'] . "/qrcode/location/";
});

$router->get('/qrcode/{text}/{pass}', function ($text, $pass) {
    include('./src/services/qrcode_api.php');
});


$router->get('/contract/{cliente_id}/{pass}', function ($cliente_id, $pass) {
    // echo "<img src='/qrcode/location/-0.106930,20-78.470934/z2phE7KCXLC2YLgt' />";
    echo __DIR__;
    // include('./src/services/contract_api.php');
});

$router->set404(function () {
    header('HTTP/1.1 404 Not Found');
    echo "Pagina no encontrada!";
});

$router->run();
