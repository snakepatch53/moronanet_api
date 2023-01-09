<?php
function getClient($cliente_id)
{

    $client = http_query($_ENV['MIKROWISP_API_URL'] . '/GetClientsDetails', 'POST', array(
        "token" => $_ENV['MIKROWISP_API_TOKEN'],
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
