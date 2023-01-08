<?php
if ($_ENV['SERVICE_AUTH_TOKEN'] != $pass) {
    echo "No autorized";
    exit;
}


require './src/functions/get_contract_html.php';
include('./src/functions/http_query.php');

use Dompdf\Dompdf;

$client = getClient($cliente_id);
if ($client != false) {
    $address_fields = ["paroquia", "sector", "ciudad"];
    $client_address = $client['direccion_principal'];
    $html = get_contract_html(
        $client['id'],
        capitalizeStr($client['servicio']['instalado']),
        capitalizeStr($client['nombre']),
        $client['cedula'],
        capitalizeStr($client_address),
        getField($client_address, $address_fields, "parroquia", "macas"),
        getField($client_address, $address_fields, "sector", "macas"),
        getField($client_address, $address_fields, "ciudad", "macas"),
        capitalizeStr(getPlan($client['servicio']['perfil'])),
        capitalizeStr($client['servicio']['coordenadas']),
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




function getClient($cliente_id)
{

    $client = http_query('http://167.71.189.123/api/v1/GetClientsDetails', 'POST', array(
        "token" => "MzBnNDBqa2NCTE53ZXBjVTZUMFljdz09",
        "idcliente" => $cliente_id
    ));
    $client = json_decode($client, true);
    if (isset($client['datos'][0]['nombre'])) {
        $client = $client['datos'][0];
        $client['servicio'] = $client['servicios'][0];
        unset($client['servicios']);
        unset($client['facturacion']);
        return $client;
    } else {
        return false;
    }
}

function getPlan(string $str_name)
{
    $planes = array(
        array("num" => "20", "name" => "20 MEGAS"),
        array("num" => "40", "name" => "40 MEGAS"),
        array("num" => "60", "name" => "60 MEGAS"),
        array("num" => "100", "name" => "100 MEGAS"),
        array("num" => "200", "name" => "200 MEGAS"),
    );
    foreach ($planes as $key => $value) {
        if (str_contains($str_name, $value['num'])) return $value['name'];
    }
}

function getField(string $w, array $fields, string $field, $default_field)
{
    $w = strtolower($w);
    $field = strtolower($field);
    if ($field != false) {
        $w = explode($field, $w);
        if (count($w) <= 1) return capitalizeStr($default_field);
        return capitalizeStr(dropText($w[1], $fields));
    }
    return capitalizeStr(dropText($w, $fields));
}

function dropText($w, $fields)
{
    foreach ($fields as $index => $el) {
        $el = strtolower($el);
        if (stripos($w, $el) !== false) {
            $tmp = explode($el, $w);
            $w = str_replace($tmp[1], "", $w);
            $w = str_replace($el, "", $w);
        }
    }
    return $w;
}

function capitalizeStr($str)
{
    return ucwords(strtolower($str));
}


/*
'id' => int 218
'userid' => int 0
'fecha_ingreso' => string '2022-11-10' (length=10)
'fecha_salida' => string '0000-00-00' (length=10)
'idtecnico' => int 0
'direccion' => string 'BARRIO KIRUBA' (length=13)
'telefono' => string '' (length=0)
'movil' => string '0992633643' (length=10)
'idnodo' => int 0
'email' => string '' (length=0)
'cedula' => string '1401194400' (length=10)
'estate' => string 'PENDIENTE' (length=9)
'cliente' => string 'JONATHAN CAMILO TSENKUSH ANKUASH' (length=32)
'notas' => string 'PLAN BASICO 20 MEGAS ' (length=21)
'fecha_instalacion' => string '2022-11-14 09:40:00' (length=19)
'zona' => int 0
'idvendedor' => int 1
'tipo_estrato' => int 1
*/