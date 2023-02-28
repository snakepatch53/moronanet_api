<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');



if (isset($_POST['name'], $_FILES['img'])) {

    $path = "./public/cloud_img";
    $img = $_FILES['img'];
    $name = $_POST['name'];
    // $link = $_ENV["MIKROWISP_API_URL"];
    $link = 'http://localhost/moronanet_api/public/cloud_img/';

    if ($img['tmp_name'] != "" or $img['tmp_name'] != null) {
        if (!file_exists($path)) {
            mkdir($path, 0700);
        }

        $desde = $img['tmp_name'];
        $hasta = $path . "/" . $name . ".png";
        copy($desde, $hasta);

        echo json_encode($link . $name . ".png");
    } else {
        echo json_encode(false);
    }
} else {
    echo json_encode(false);
}
