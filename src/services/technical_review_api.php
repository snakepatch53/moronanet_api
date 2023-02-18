<?php
require './src/functions/mikrowisp.php';
require './src/functions/get_technical_review_html.php';
include('./src/functions/http_query.php');

use Dompdf\Dompdf;

$client = getClient($cliente_id);
if ($client != false) {
    $address_fields = ["paroquia", "sector", "ciudad"];
    $client_address = $client['direccion_principal'];
    $html = get_technical_review_html(
        $client['id'],
        capitalizeStr($client['servicio']['instalado']),
        capitalizeStr($client['nombre']),
        $client['cedula'],
        capitalizeStr($client_address),
        getField($client_address, $address_fields, "parroquia", "macas"),
        getField($client_address, $address_fields, "sector", "macas"),
        getField($client_address, $address_fields, "ciudad", "macas"),
        capitalizeStr(getPlan($client['servicio']['perfil'])),
        capitalizeStr($client['servicio']['ip']),
        capitalizeStr($client['servicio']['coordenadas']),
        capitalizeStr($client['servicio']['pppuser']),
        capitalizeStr($client['servicio']['ppppass']),
        $client['servicio']['costo'],
        $client['movil']
    );
    $dompdf = new Dompdf();
    $dompdf->setPaper('A4', 'letter');
    $dompdf->loadHtml($html);
    $dompdf->render();
    $dompdf->stream("archivo.pdf", array("Attachment" => false));
} else {
    echo 'No hay registros de ese cliente..';
}
