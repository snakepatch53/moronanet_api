<?php
function get_technical_review_html(
    int $client_id,
    string $client_fecha,
    string $client_nombres,
    string $client_cedula,
    string $client_direccion,
    string $client_parroquia,
    string $client_sector,
    string $client_ciudad,
    string $client_plan,
    string $client_ip,
    string $client_ubicacion,
    float $client_costo,
    string $client_telefono
) {
    $data_head = array(
        'img_route' => './public/img/',
        'dato_codigo' => $client_id, // dato1
        'dato_version' => '01',
        'dato_fecha' => formatDate($client_fecha) //dato2
    );

    $data_header = array(
        "contrato_n" => $client_id, //dato1
        "fecha_inicio" => formatDate($client_fecha), //dato2
        "fecha_final" => formatDate(addYearToDate($client_fecha, 1)),
        "vigencia" => '12 MESES',
    );

    $data_client = array(
        "nombres" => $client_nombres, //dato1
        "cedula" => $client_cedula, //dato2
        "nacionalidad" => "Ecuatoriana",
        "direccion" => $client_direccion, //dato3
        "provincia" => "Morona Santiago",
        "parroquia" => $client_parroquia, //dato7
        "plan" => $client_plan, //dato4
        "ip" => $client_ip, //dato4
        "ubicacion" => $client_ubicacion, //dato4
        "canton" => "Morona",
        "sector" => $client_sector,
        "valor_mensual" => round($client_costo + ($client_costo * 0.12)), //dato5
        "ciudad" => $client_ciudad,
        "telefono" => $client_telefono, //dato6
    );

    $data_business =  array(
        "razon_social" => "JOSE ANDRES CHACHA CHUCAY",
        "nombre_comercial" => "MORONANET",
        "direccion" => "CUENCA ENTRE SOASTI Y AMAZONAS",
        "provincia" => "MORONA SANTIAGO",
        "ciudad" => "MACAS",
        "canton" => "MORONA",
        "parroquia" => "MACAS",
        "telefono" => "0988078711 - 073046355",
        "ruc" => "1400227565001",
        "email" => "admin@moronanet.com",
        "web" => "www.moronanet.com",
    );

    $html = '<html><head><title>' . $data_client['nombres'] . '</title></head><body>';
    $html .= getPage1($data_head, $data_header, $data_business, $data_client);
    $html .= '</body></html>';
    return $html;
}

#region header
function getHeader(array $data)
{
    ob_start();
?>
    <style>
        * {
            font-family: 'Times New Roman', Times, serif;
        }

        @page {
            margin: 0in;
            size: A4;
        }

        body {
            position: relative;
        }

        .page_break {
            page-break-before: always;
        }

        .background {
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            height: 100%;
            width: 100%;
        }

        table {
            border-collapse: collapse;
        }

        .header {
            margin-top: 45px;
            font-size: 13px;
        }

        .header .layout1 {
            width: 100%;
        }

        .header .layout1 td {
            margin: 0;
            padding: 0 5px;
            /* vertical-align: super; */
        }

        .header .layout1 img.logo1 {
            width: 200px;
        }

        .header .layout2 td {
            padding: 3px;
        }
    </style>
    <img src="data:image/png;base64,<?= base64_encode(file_get_contents($data['img_route'] . "background.png")) ?>" class="background" />
    <table>
        <tr>
            <td style="width:300px"></td>
            <td>
                <br><br><br>
                <h3>FICHA DE REVISION TECNICA</h3>
            </td>
        </tr>
    </table>
    <br>
<?php
    return ob_get_clean();
}
#endregion

#region page1
function getPage1(array $data_head, array $data_header, array $data_business, array $data_client)
{

    ob_start();

?>
    <?= getHeader($data_head, '1 de 7') ?>
    <style>
        .page1 {
            padding: 0 100px;
        }

        .page1 p {
            line-height: 25px;
            font-size: 14px;
            text-align: justify;
        }

        .page1 .layout3,
        .page1 .layout2,
        .page1 .layout1 {
            width: 100%;
            margin-top: 20px;
        }

        .page1 .layout3 tr td,
        .page1 .layout2 tr td {
            font-size: 13px;
            line-height: 23px;
        }

        .page1 .layout1 tr td {
            padding: 2px 10px;
            padding-bottom: 15px;
            font-size: 13px;
            vertical-align: super;
        }

        .page1 .layout3 tr td {
            line-height: 17px;
            vertical-align: super;
            padding: 0 5px;
            padding-bottom: 8px;
        }

        .page1 .layout2 tr td {
            padding: 10px;
            line-height: 14px;
        }

        .check {
            display: block;
            width: 15px;
            height: 15px;
            border: 1px solid black;
            margin: 0 auto;
            border-radius: 5px;
        }

        .line {
            display: block;
            width: 100%;
            height: 20px;
            border-bottom: solid 1px black;
            margin: 0 auto;
        }
    </style>
    <div class="page1">
        <br>

        <table class="layout3" border=1>
            <tr>
                <td><b>Fecha: </b></td>
                <td><?= date('d/m/Y H:i') ?></td>
                <td><b>Plan:</b></td>
                <td><?= $data_client['plan'] ?></td>
            </tr>
            <tr>
                <td><b>Nombres:</b></td>
                <td><?= $data_client['nombres'] ?></td>
                <td><b>IP:</b></td>
                <td><?= $data_client['ip'] ?></td>
            </tr>
            <tr>
                <td><b>Celular:</b></td>
                <td><?= $data_client['telefono'] ?></td>
                <td rowspan="3">
                    <center><img style="width:65px; margin-top:8px" src="data:image/png;base64,<?= qrcode_PPPoE($data_client['ubicacion'], "user") ?>" /></center>
                    <center><img style="width:65px; margin-top:8px" src="data:image/png;base64,<?= qrcode_PPPoE($data_client['ubicacion'], "pass") ?>" /></center>
                </td>
                <td rowspan="3">
                    <center><img style="width:140px; margin-top:8px" src="data:image/png;base64,<?= qrcode_location($data_client['ubicacion']) ?>" /></center>
                </td>
            </tr>
            <tr>
                <td><b>Sector: </b></td>
                <td><?= $data_client['sector'] ?></td>
            </tr>
            <tr>
                <td><b>Direccion:</b></td>
                <td><?= $data_client['direccion'] ?></td>
            </tr>
        </table>
        <h4 style="margin-top:25px">Solucion:</h4>
        <table class="layout2" border=1>
            <tr>
                <td><b>Cambio de Router.</b></td>
                <td><span class="check"></span></td>
                <td style="width:100px"></td>
                <td><b>Reautorizacion de ONT.</b></td>
                <td><span class="check"></span></td>
            </tr>
            <tr>
                <td><b>Cambio de ONT.</b></td>
                <td><span class="check"></span></td>
                <td style="width:100px"></td>
                <td><b>Cambio de cable de Fibra Optica.</b></td>
                <td><span class="check"></span></td>
            </tr>
            <tr>
                <td><b>Cambio de clave WiFi.</b></td>
                <td><span class="check"></span></td>
                <td style="width:100px"></td>
                <td><b>Cambio de cable corto UTP.</b></td>
                <td><span class="check"></span></td>
            </tr>
            <tr>
                <td><b>Cambio de conector (casa).</b></td>
                <td><span class="check"></span></td>
                <td style="width:100px"></td>
                <td><b>Configurtacion de dispositivos del cliente.</b></td>
                <td><span class="check"></span></td>
            </tr>
            <tr>
                <td><b>Cambio de conector (caja).</b></td>
                <td><span class="check"></span></td>
                <td style="width:100px"></td>
                <td><b>Ningun problema aparente.</b></td>
                <td><span class="check"></span></td>
            </tr>
            <tr>
                <td><b>Fusion de fibra por ruptura de cable.</b></td>
                <td><span class="check"></span></td>
                <td style="width:100px"></td>
                <td><b>Otro.</b></td>
                <td><span class="check"></span></td>
            </tr>
            <tr>
                <td><b>Cambio de IP.</b></td>
                <td><span class="check"></span></td>
                <td style="width:100px"></td>
                <td>
                    <div class="line"></div>
                </td>
                <td><span class="check"></span></td>
            </tr>
        </table>
        <h4 style="margin-top:25px">Descripcion:</h4>
        <div class="line"></div>
        <br>
        <div class="line"></div>
        <br>
        <div class="line"></div>
        <br><br><br>
        <center>
            <div class="line" style="width:200px"></div>
            <b>Tecnico asignado</b>
        </center>
    </div>
<?php
    return ob_get_clean();
}
#endregion


function addYearToDate($date, $years)
{
    $newDate = date('Y-m-d', strtotime($date . " + $years years"));
    return $newDate;
}
function formatDate($date)
{
    $date_type = date_create($date);
    return date_format($date_type, 'd/m/Y');
}
