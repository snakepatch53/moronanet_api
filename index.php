<?php
//show errors
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

date_default_timezone_set('America/Guayaquil');
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/functions/qrcode_location.php';

$router = new \Bramus\Router\Router();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router->get('/', function () {
    include('./src/pages/api_info.php');
});

$router->get('/whatsapp/{number}/{message}/{pass}', function ($number, $message, $pass) {
    include('./src/functions/middleware_auth.php'); //auth
    include('./src/services/whatsapp_api.php');
});

$router->get('/qrcode/location/{text}/{pass}', function ($text, $pass) {
    include('./src/functions/middleware_auth.php'); //auth
    include('./src/services/qrcode_api.location.php');
});

$router->get('/qrcode/{text}/{pass}', function ($text, $pass) {
    include('./src/functions/middleware_auth.php'); //auth
    include('./src/services/qrcode_api.php');
});

$router->get('/contract/{cliente_id}/{pass}', function ($cliente_id, $pass) {
    include('./src/functions/middleware_auth.php'); //auth
    include('./src/services/contract_api.php');
});

$router->get('/technical_review/{cliente_id}/{pass}', function ($cliente_id, $pass) {
    include('./src/functions/middleware_auth.php'); //auth
    include('./src/services/technical_review_api.php');
});

$router->set404(function () {
    header('HTTP/1.1 404 Not Found');
    echo "Pagina no encontrada!";
});

$router->run();
