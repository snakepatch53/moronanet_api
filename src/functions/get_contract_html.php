<?php
date_default_timezone_set('America/Guayaquil');
function get_contract_html(
    int $client_id,
    string $client_fecha,
    string $client_nombres,
    string $client_cedula,
    string $client_direccion,
    string $client_parroquia,
    string $client_sector,
    string $client_ciudad,
    string $client_plan,
    string $client_ubicacion,
    string $client_pppuser,
    string $client_ppppass,
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
        "ubicacion" => $client_ubicacion, //dato4
        "pppuser" => $client_pppuser, //dato4
        "ppppass" => $client_ppppass, //dato4
        "canton" => "Morona",
        "sector" => $client_sector,
        "valor_mensual" => $client_costo, //dato5
        "ciudad" => $client_ciudad,
        "telefono" => $client_telefono, //dato6
        "ip" => "",
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
    $html .= getpage2($data_head);
    $html .= getpage3($data_head, array(
        "plan" => $data_client['plan'],
        "pago_directo" => "si",
        "pago_debito" => "si",
        "pago_locales" => "no",
        "pago_credito" => "no",
        "pago_transferencia" => "si",
    ));
    $html .= getpage4($data_head);
    $html .= getpage5($data_head);
    $html .= getpage6($data_head);
    $html .= getpage7($data_head, $data_business, $data_client);
    $html .= '</body></html>';
    return $html;
}

#region header
function getHeader(array $data, string $dato_hoja_num)
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
    <div class="header">
        <table class="layout1">
            <tr>
                <td width="360"></td>
                <td>
                    <table border=1 class="layout2" width="110">
                        <tr>
                            <td><b>Codigo: </b><?= $data['dato_codigo'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Version: </b><?= $data['dato_version'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Fecha: </b><?= $data['dato_fecha'] ?></td> <!-- Dato -->
                        </tr>
                        <tr>
                            <td><b>Hoja: </b><?= $dato_hoja_num ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
<?php
    return ob_get_clean();
}
#endregion

#region page1
function getPage1(array $data_head, array $data_header, array $data_business, array $data_client)
{
    ob_start();
    // get day from date
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
    </style>
    <div class="page1">
        <br>
        <table class="layout1" border=1>
            <tr>
                <td><b>CONTRATO N??: </b></td>
                <td><?= $data_header['contrato_n'] ?></td>
                <td><b>FECHA DE INICIO: </b><br><?= $data_header['fecha_inicio'] ?></td>
                <td><b>FECHA DE TERMINACION: </b><br><?= $data_header['fecha_final'] ?></td>
                <td><b>VIGENCIA: </b><br><?= $data_header['vigencia'] ?></td>
            </tr>
        </table>
        <h5 style="text-align: center;">CONTRATO DE PRESTACI??N DE SERVICIOS</h5>
        <h5 style="margin:0">CLAUSULA PRIMERA. - DATOS DE LOS COMPARECIENTES:</h5>
        <p style="margin:0;">En la ciudad de Macas a los <?= getParamDate($data_head['dato_fecha']) ?> d??as del mes de <?= getMonthName(getParamDate($data_head['dato_fecha'], 'm')) ?> del a??o <?= getParamDate($data_head['dato_fecha'], 'y') ?> celebran el presente Contrato de Adhesi??n de prestaci??n de Servicios de Acceso a Internet; por una parte, el Se??or Jos?? Andr??s Chacha Chuca, a quien mediante resoluci??n del ARCOTEL expedida por la Agencia de Regulaci??n y Control de las Telecomunicaciones otorg?? el permiso para la prestaci??n del servicio de acceso a internet, permiso suscrito el 07 de noviembre del 2019 e inscrito en el tomo a fojas 139-13997, del registro p??blico de telecomunicaciones, los datos de detallan a continuaci??n:</p>
        <table class="layout2">
            <tr>
                <td colspan="3"><b>NOMBRE/ RAZ??N SOCIAL: </b><?= $data_business['razon_social'] ?></td>
            </tr>
            <tr>
                <td colspan="3"><b>NOMBRE COMERCIAL: </b><?= $data_business['nombre_comercial'] ?></td>
            </tr>
            <tr>
                <td colspan="3"><b>DIRECCI??N: </b><?= $data_business['direccion'] ?></td>
            </tr>
            <tr>
                <td><b>PROVINCIA: </b><?= $data_business['provincia'] ?></td>
                <td><b>CIUDAD: </b><?= $data_business['ciudad'] ?></td>
                <td><b>CANT??N: </b><?= $data_business['canton'] ?></td>
            </tr>
            <tr>
                <td><b>PARROQUIA: </b><?= $data_business['parroquia'] ?></td>
                <td colspan="2"><b>N?? DE TEL??FONO: </b><?= $data_business['telefono'] ?></td>
            </tr>
            <tr>
                <td><b>RUC: </b><?= $data_business['ruc'] ?></td>
                <td colspan="2"><b>CORREO ELECTR??NICO: </b><?= $data_business['email'] ?></td>
            </tr>
            <tr>
                <td colspan="3"><b>WEB: </b><?= $data_business['web'] ?></td>
            </tr>
        </table>
        <br>
        <h5 style="padding-left:70px">DATOS DEL ABONADO / SUSCRIPTOR</h5>
        <table class="layout3" border=1>
            <tr>
                <td><b>Nombres Completos: </b></td>
                <td><?= $data_client['nombres'] ?></td>
                <td><b>Cedula: </b></td>
                <td><?= $data_client['cedula'] ?></td>
                <td><b>Nacionalidad</b></td>
                <td><?= $data_client['nacionalidad'] ?></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="2">??El abonado es de la tercera edad o discapacitado? (En caso afirmativo,aplica tarifa preferencial de acuerdo al plan del prestador):</td>
                <td><b>SI: </b></td>
                <td rowspan="3" style="text-align:center">
                    <img style="width:65px; margin-top:4px" src="data:image/png;base64,<?= qrcode_PPPoE($data_client['pppuser'], "user") ?>" />
                    <img style="width:65px; margin-top:4px" src="data:image/png;base64,<?= qrcode_PPPoE($data_client['ppppass'], "pass") ?>" />
                </td>
                <td rowspan="3" style="text-align:center">
                    <img style="width:140px; margin-top:4px" src="data:image/png;base64,<?= qrcode_location($data_client['ubicacion']) ?>" />
                </td>
            </tr>
            <tr>
                <td><b>NO: </b></td>
            </tr>
            <tr>
                <td><b>Direccion: </b></td>
                <td colspan="3"><?= $data_client['direccion'] ?></td>
            </tr>
            <tr>
                <td><b>Provincia: </b></td>
                <td><?= $data_client['provincia'] ?></td>
                <td><b>Parroquia: </b></td>
                <td><?= $data_client['parroquia'] ?></td>
                <td><b>Plan Contratado: </b></td>
                <td><?= $data_client['plan'] ?></td>
            </tr>
            <tr>
                <td><b>Canton: </b></td>
                <td><?= $data_client['canton'] ?></td>
                <td><b>Sector: </b></td>
                <td><?= $data_client['sector'] ?></td>
                <td><b>Valor Mensual: </b></td>
                <td>$<?= $data_client['valor_mensual'] ?></td>
            </tr>
            <tr>
                <td><b>Ciudad: </b></td>
                <td><?= $data_client['ciudad'] ?></td>
                <td><b>Telefono: </b></td>
                <td><?= $data_client['telefono'] ?></td>
                <td><b>IP: </b></td>
                <td><?= $data_client['ip'] ?></td>
            </tr>
        </table>
    </div>
    <div class="page_break"></div>
<?php
    return ob_get_clean();
}
#endregion

#region page2
function getPage2($data_head)
{
    ob_start();
?>
    <?= getHeader($data_head, '2 de 7') ?>
    <style>
        .page2 {
            padding: 0 100px;
            padding-top: 50px;
        }

        .page2 ol {
            text-align: justify;
        }

        .page2 li {
            font-size: 13px;
        }
    </style>
    <div class="page2">
        <h5>CONDICIONES COMERCIALES Y TECNICAS</h5>
        <ol>
            <li>LA EMPRESA entrega a EL ABONADO en calidad de ARRENDAMIENTO, los equipos que se describen en el acta de entrega, la cual hace parte integral de este contrato.</li>
            <li>EL ABONADO una vez recibido el servicio y los equipos a satisfacci??n, se obliga respecto de los mismos de conformidad con las normas legales vigentes.</li>
            <li>LA EMPRESA, no se hace responsable por los da??os imputables al ABONADO por manipulaci??n de los equipos o las configuraciones que LA EMPRESA estableci?? en las instalaciones de EL ABONADO para brindar el servicio de Internet.</li>
            <li>En el caso de no entrega de los equipos en el tiempo y las condiciones establecidas, salvo el deterioro ordinario de los mismos, LA EMPRESA facturar?? a EL ABONADO el valor total de los equipos.</li>
            <li>Las aver??as en los equipos ser??n reparadas por LA EMPRESA a solicitud de EL ABONADO. LA EMPRESA facturar?? al EL ABONADO el valor de las reparaciones de los equipos, salvo cuando el da??o provenga de defectos de fabricaci??n en los cuales LA EMPRESA responder?? por los equipos que se encuentren en arrendamiento hasta por la garant??a m??nima presunta que otorgue o tenga su fabricante y por lo tanto estos s??lo ser??n reemplazados por fallas o defectos imputables a la misma.</li>
            <li>En caso de da??o irreparable del equipo que no provenga de defectos de fabricaci??n, causa natural como tormentas el??ctricas u otros, de deterioro no imputable a un vicio oculto, hurto debidamente denunciado ante los organismos competentes, EL ABONADO pagar?? a la EMPRESA el valor de reposici??n vigente del equipo a la fecha de cobro, de conformidad con la certificaci??n que al respecto expida el ??rea financiera de LA EMPRESA, para lo cual tendr?? en cuenta el dem??rito por uso. En cualquier caso, EL ABONADO debe informar a LA EMPRESA por escrito dentro del t??rmino de 8 d??as la ocurrencia de cualquiera de los eventos mencionados, a falta de lo cual no podr?? exonerarse de su responsabilidad.</li>
            <li>El equipo ser?? instalado, trasladado o retirado por personal autorizado por LA EMPRESA.</li>
            <li>LA EMPRESA se reserva la facultad de cambiar la plataforma tecnol??gica del sistema caso en el cual proceder?? a sustituir los equipos entregados en arrendamiento.</li>
            <li>La EMPRESA atender?? los reportes de da??os a trav??s de la l??nea de Servicio al Cliente, y realizar?? el mantenimiento en el menor tiempo posible.</li>
            <li>EL ABONADO se obliga a mantener los equipos en la direcci??n establecida en el contrato de servicios del acceso a Internet. La EMPRESA solo atender?? la solicitud de mantenimiento o reparaci??n en dicha direcci??n o en aquella que corresponda a un traslado reportado con anterioridad en forma escrita por EL ABONADO a LA EMPRESA.</li>
            <li>EL ABONADO entiende que no podr?? requerir IP??s p??blicas est??ticas en planes Residenciales, sin embargo, acepta que la direcci??n IP asignada podr?? ser modificada por traslados, cambios de plan, mejoras tecnol??gicas o actualizaciones t??cnicas.</li>
            <li>Los planes de servicios de internet ofertados por LA EMPRESA, no incluyen cuentas de correo electr??nico.</li>
            <li>El equipo terminal provisto por LA EMPRESA, dispone de puertos al??mbricos que permiten la utilizaci??n ??ptima de la velocidad ofertada en el plan contratado, adem??s cuenta con conexi??n inal??mbrica WIFI que dispone de una cobertura variable seg??n la cantidad de paredes, estructuras del sitio de instalaci??n del servicio, obst??culos e interferencias que se encuentren en el entorno. EL ABONADO conoce y acepta que la tecnolog??a WIFI pierde potencia a medida que aumenta la distancia y por lo tanto se reducir?? la velocidad efectiva a mayor distancia de conexi??n del equipo. Se establece una velocidad m??xima WIFI de hasta 15 metros en condiciones normales.</li>
            <li>EL ABONADO garantizar?? que el personal designado por LA EMPRESA, pueda ingresar a los sitios donde se encuentren instalados los equipos, para efectos de revisi??n, reparaci??n, mantenimiento o cuando la empresa as?? lo requiera. El incumplimiento de estas condiciones ser?? causal de terminaci??n unilateral del contrato.</li>
            <li>En se??al de aceptaci??n y constancia de entrega y recibo de los equipos y servicio, se firma POR AMBAS PARTES AL FINAL DE ESTE CONTRATO EN LA SECCI??N DE LAS FIRMAS.</li>

        </ol>
    </div>
    <div class="page_break"></div>
<?php
    return ob_get_clean();
}
#endregion

#region page3
function getPage3(array $data_head, array $data)
{
    ob_start();
?>
    <?= getHeader($data_head, '3 de 7') ?>
    <style>
        .page3 {
            padding: 0 100px;
            padding-top: 10px;
        }

        .page3 .title {
            font-size: 13px;
        }

        .page3 p {
            font-size: 13px;
            text-align: justify;
        }

        .page3 .layout4,
        .page3 .layout1 {
            margin: auto;
        }

        .page3 .layout2 {
            margin-right: 50px;
        }

        .page3 .layout4 tr td,
        .page3 .layout1 tr td {
            padding: 7px 10px;
            font-size: 13px;
        }

        .page3 .layout3 tr td {
            width: 30px;
        }
    </style>
    <div class="page3">
        <p><b class="title">CL??USULA SEGUNDA. - OBJETO, CARACTERISTICAS. - </b> El presente contrato tiene por objeto que LA EMPRESA proporcione a EL ABONADO el acceso a la red de internet conforme a las caracter??sticas pactadas, que debidamente firmados por las partes, son integrantes de este instrumento.</p>
        <p>Las partes aceptan que este instrumento constituya un contrato marco general, y que, en adelante los servicios, cambios en los servicios, y cualquier otra modificaci??n que se implemente; se realizar?? en los anexos correspondientes, que debidamente firmados por las partes, ser??n integrantes de este Contrato, y se seguir??n las condiciones generales de este instrumento con las especificaciones establecidas.</p>
        <p><b class="title">CL??USULA TERCERA. - PRECIO Y FORMA DE PAGO. - </b>El precio acordado por la instalaci??n y puesta en funcionamiento por el Servicio de Acceso a Internet y que es firmado por las partes, es integrante del presente contrato.</p>
        <table class="layout1">
            <tr>
                <td>
                    <table class="layout2" border=1>
                        <tr>
                            <td><b>PLAN</b></td>
                            <td><b>MEGAS</b></td>
                            <td><b>COSTO</b></td>
                        </tr>
                        <tr>
                            <td>PLAN BASICO</td>
                            <td>20 MB</td>
                            <td>$20.00</td>
                        </tr>
                        <tr>
                            <td>PLAN AVANZADO</td>
                            <td>40 MB</td>
                            <td>$25.00</td>
                        </tr>
                        <tr>
                            <td>PLAN PLUS</td>
                            <td>60 MB</td>
                            <td>$30.00</td>
                        </tr>
                        <tr>
                            <td>PLAN ULTRA VELOCIDAD</td>
                            <td>100 MB</td>
                            <td>$45.00</td>
                        </tr>
                        <tr>
                            <td>PLAN ULTRA VELOCIDAD 4k</td>
                            <td>200 MB</td>
                            <td>$65.00</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="layout3" border=1>
                        <tr>
                            <td><b style="color:transparent">X</b></td>
                        </tr>
                        <tr>
                            <td><b style="color:transparent">X</b><?= strtolower($data['plan']) == '20 megas' ? 'X' : '' ?></td>
                        </tr>
                        <tr>
                            <td><b style="color:transparent">X</b><?= strtolower($data['plan']) == '40 megas' ? 'X' : '' ?></td>
                        </tr>
                        <tr>
                            <td><b style="color:transparent">X</b><?= strtolower($data['plan']) == '60 megas' ? 'X' : '' ?></td>
                        </tr>
                        <tr>
                            <td><b style="color:transparent">X</b><?= strtolower($data['plan']) == '100 megas' ? 'X' : '' ?></td>
                        </tr>
                        <tr>
                            <td><b style="color:transparent">X</b><?= strtolower($data['plan']) == '200 megas' ? 'X' : '' ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <p>El precio mensual acordado por la prestaci??n del Servicio de Acceso a Internet, es el que corresponde al Plan contratado, y cuyo valor mensual y descripci??n consta en la tabla anterior, que debidamente firmado por las partes, es integrante del presente contrato.</p>
        <p>El Plan contratado se pagar?? en mensualidades, pagaderas por el EL ABONADO a LA EMPRESA por mes consumido, dentro de los 5 primeros d??as de cada mes calendario; previo la entrega de la factura por el servicio contratado. En caso de que, EL ABONADO no cancele los valores hasta el sexto d??a dentro del mes calendario que se encuentre en curso, LA EMPRESA tiene la facultad de suspender la prestaci??n del servicio en cualquier momento, de no producirse el pago del plan dentro del plazo antes se??alado, sin que implique terminaci??n de contrato. <br>EL ABONADO, se compromete con la EMPRESA del servicio a pagar las tarifas o valores mensuales por cada uno de los servicios contratados, y el pago se realizar?? de la siguiente forma:</p>
        <table class="layout4" border=1>
            <tr>
                <td><b>FORMA DE PAGO</b></td>
                <td><b>SI</b></td>
                <td><b>NO</b></td>
            </tr>
            <tr>
                <td>Pago directo en cajas del prestador del servicio</td>
                <td><?= strtolower($data['pago_directo']) == "si" ? "X" : "" ?></td>
                <td><?= strtolower($data['pago_directo']) != "si" ? "X" : "" ?></td>
            </tr>

            <tr>
                <td>D??bito autom??tico cuenta de ahorro o corriente</td>
                <td><?= strtolower($data['pago_debito']) == "si" ? "X" : "" ?></td>
                <td><?= strtolower($data['pago_debito']) != "si" ? "X" : "" ?></td>
            </tr>
            <tr>
                <td>Pago en ventanilla de locales autorizados</td>
                <td><?= strtolower($data['pago_locales']) == "si" ? "X" : "" ?></td>
                <td><?= strtolower($data['pago_locales']) != "si" ? "X" : "" ?></td>
            </tr>
            <tr>
                <td>D??bito con tarjeta de cr??dito</td>
                <td><?= strtolower($data['pago_credito']) == "si" ? "X" : "" ?></td>
                <td><?= strtolower($data['pago_credito']) != "si" ? "X" : "" ?></td>
            </tr>
            <tr>
                <td>Transferencia v??a medios electr??nicos</td>
                <td><?= strtolower($data['pago_transferencia']) == "si" ? "X" : "" ?></td>
                <td><?= strtolower($data['pago_transferencia']) != "si" ? "X" : "" ?></td>
            </tr>
        </table>
        <p>En caso de que el abonado o suscritor desee cambiar su modalidad de pago a otra de las disponibles, deber?? comunicar a LA EMPRESA del servicio con quince (15) d??as de anticipaci??n. El prestador del servicio, luego de haber sido comunicado, instrumentar?? la nueva forma de pago.</p>
        <p><b>CL??USULA CUARTA. - COMPRA, ARRENDAMIENTO DE EQUIPOS Y SERVICIOS. - </b>LA EMPRESA pondr?? a disposici??n de EL ABONADO en Comodato precario, el(los) equipo(s) que consten en el acta </p>
    </div>
    <div class="page_break"></div>
<?php
    return ob_get_clean();
}
#endregion

#region page4
function getPage4(array $data_head)
{
    ob_start();
?>
    <?= getHeader($data_head, '4 de 7') ?>
    <style>
        .page4 {
            padding: 0 100px;
            padding-top: 10px;
        }

        .page4 p {
            font-size: 13.5px;
            text-align: justify;
        }
    </style>
    <div class="page4">
        <p>entrega recepci??n de servicios y equipos. <br> EL ABONADO velar?? por la buena custodia, cuidado y uso de los equipos entregados en comodato. Si los equipos entregados por el prestador de servicios en comodato sufren robo, hurto, perdida y/o da??os por incorrecta manipulaci??n del EL ABONADO, dicho robo, hurto o perdida y/o da??o ser?? responsabilidad exclusiva del abonado, quien asumir?? el costo total de un nuevo equipo.<br>En caso de terminaci??n del contrato por cualquier causa, el abonado entregar?? en las oficinas del prestador de servicios, el o los equipos entregados en comodato precario, en plazo m??ximo de 15 d??as posteriores a la terminaci??n del contrato. En caso de no devoluci??n del o los equipos dentro del t??rmino indicado, el abonado asumir?? el precio del o los equipos.<br>Para el caso de servicios FTTH son equipos ONT con wifi incluido. El costo es de USD$30(m??s IVA) del equipo ONT, los cu??les deben incluir sus respectivas fuentes. En caso de p??rdida de las fuentes, tienen un costo de USD$10,00 cada una.<br>Para el caso de servicios INALAMBRICOS son equipos antena WiFi y CPE del abonado. Los costos son de USD$30 (m??s IVA) de la antena WiFi y USD$ 30 (m??s IVA) del equipo CPE del abonado, los cu??les deben incluir sus respectivas fuentes. En caso de p??rdida de las fuentes, tienen un costo de USD$10,00 cada una.<br>La instalaci??n del servicio incluye un punto de acometida donde se colocar??n los quipos que ser??n administrados exclusivamente por LA EMPRESA. No se podr??n retirar, resetear, desinstalar o sustituir los equipos proporcionados por LA EMPRESA o modificar la configuraci??n de los mismos.</p>
        <p><b>CL??USULA QUINTA.- USO DE INFORMACI??N PERSONAL: </b>LA EMPRESA garantizar?? la privacidad y protecci??n de los datos que EL ABONADO ha detallado en el presente contrato, por lo que EL ABONADO conoce y Si No autoriza que LA EMPRESA pueda proporcionar a terceros datos necesarios para poder realizar la entrega de estado de cuenta, facturaci??n, recordatorios de fechas de pago o montos de pago, fidelizaci??n, informaci??n de nuevos servicios, informaci??n de promociones especiales, entre otros; as?? mismo tambi??n autoriza a hacer uso de esta informaci??n para fines comerciales o de brindar beneficios al EL ABONADO a trav??s de alianzas desarrolladas. Adicionalmente EL ABONADO Si No acepta expresamente que LA EMPRESA puede utilizar medios electr??nicos y llamadas para: 1.- Notificar cambios relacionados con los t??rminos y condiciones del presente CONTRATO, 2.- Realizar gestiones de cobranzas y dem??s promociones aplicables de acuerdo a la normativa vigente. Sin embargo, de lo anterior, LA EMPRESA podr?? entregar los datos de EL ABONADO en caso de requerimientos realizados por autoridad competente conforme al ordenamiento jur??dico vigente y particularmente de la Agencia de Regulaci??n y Control de las Telecomunicaciones para el cumplimiento de sus funciones. 3.- Comunicaciones relacionadas a soporte y notificaciones de car??cter t??cnico.</p>
        <p><b>CL??USULA SEXTA. - RECLAMOS Y SOPORTE T??CNICO: </b>En caso de reclamos y soporte t??cnico, el tiempo m??ximo de respuesta es de 7 d??as despu??s de recibida la notificaci??n por parte de EL ABONADO en los canales de atenci??n de LA EMPRESA y de ser necesaria se generar?? una visita t??cnica o telem??tica al domicilio, cuyo costo se incluir?? en el estado de cuenta del usuario, siempre y cuando la falla no sea imputable a la EMPRESA. Los canales de atenci??n al cliente de LA EMPRESA son: 1) P??gina web 2) Contactos telef??nicos 3) Redes sociales 4) Centros de Atenci??n al cliente de LA EMPRESA. </p>
        <p>De acuerdo con la norma de calidad para la prestaci??n de servicios de internet, para reclamos de velocidad de acceso el abonado deber?? realizar las siguientes pruebas: 1) Realizar 2 o 3 pruebas de velocidad en canal vac??o, en el veloc??metro provisto por LA EMPRESA proveedora del servicio y guardarlas en un archivo gr??fico. 2) Contactarse por los canales de atenci??n al cliente de LA EMPRESA y enviar los resultados de las pruebas de lunes a viernes en horarios de 08h00 am hasta las 17h00 pm y los d??as s??bados en horario de 08h00 a 14h00. El soporte presencial es en d??as y horas laborables. En caso de tener reclamos debidamente reportados, registrados y no resueltos por LA EMPRESA, puede comunicarse al ARCOTEL por cualquiera de los siguientes canales de atenci??n:</p>
        <p><b>CL??USULA S??PTIMA. - NORMATIVA APLICABLE: </b>En la prestaci??n del servicio, se entienden incluidos todos los derechos y obligaciones de los abonados/suscriptores, as?? como tambi??n los derechos y obligaciones de los prestadores de servicios de telecomunicaciones dispuestos en la normativa ecuatoriana.</p>
    </div>
    <div class="page_break"></div>
<?php
    return ob_get_clean();
}
#endregion

#region page5
function getPage5(array $data_head)
{
    ob_start();
?>
    <?= getHeader($data_head, '5 de 7') ?>
    <style>
        .page5 {
            padding: 0 100px;
            padding-top: 10px;
        }

        .page5 p {
            font-size: 13.5px;
            text-align: justify;
        }
    </style>
    <div class="page5">
        <p><b>CL??USULA OCTAVA. - DERECHOS DEL ABONADO. - </b>Son derechos de EL ABONADO:</p>
        <p>A recibir el servicio de acuerdo a los t??rminos estipulados en el presente contrato. <br> A que no se var??e el precio estipulado en el contrato, mientras dure la vigencia del mismo o no se cambien las condiciones de la prestaci??n a trav??s de la suscripci??n de nuevos.<br> A reclamar de manera integral por los problemas de calidad tanto del Acceso a la Red Internet, as?? como por las deficiencias en el enlace provisto para brindar el servicio.<br> LA EMPRESA reconoce a sus abonados todos los derechos que se encuentran determinados en la Ley Org??nica de Defensa del Consumidor y su Reglamento; el Reglamento para la prestaci??n del Servicios de Valor Agregado y la Resoluci??n No. 216-09-CONATEL-2009.</p>
        <p><b>CL??USULA NOVENA: PLAZO DE VIGENCIA. - </b>El presente contrato, tendr?? un plazo de vigencia de 12 meses, contados a partir de la fecha de suscripci??n del mismo.<br> Las partes se comprometen a respetar el plazo de vigencia pactado, en caso de retiro sin justificaci??n<br> alguna el cliente pagara un valor por retiro anticipado de 80,00.<br> El abonado acepta la renovaci??n autom??tica sucesiva del contrato en las mismas condiciones, independientemente de su derecho a terminar la relaci??n contractual conforme la legislaci??n aplicable, solicitar cualquier tiempo, con hasta quince (15) d??as de antelaci??n a la fecha de renovaci??n, su decisi??n de no renovaci??n:<br> SI NO
        <p><b>CL??SULA D??CIMA: CALIDAD DEL SERVICIO. - </b>LA EMPRESA cumplir?? los est??ndares de calidad emitidos y verificados por los organismos regulatorios y de control de las telecomunicaciones en el Ecuador, no obstante, detalla que prestar?? sus servicios al ABONADO con los niveles de calidad especificados por LA EMPRESA. As?? como declara que el SERVICIO DE INTERNET DEDICADO tendr??: Disponibilidad 98% mensual calculada sobre la base de 720 horas al mes. Para el c??lculo de no disponibilidad del servicio no se considerar?? el tiempo durante el cual no se lo haya podido prestar debido a circunstancias de caso fortuito o fuerza mayor o completamente ajenas al proveedor.</p>
        <p>LA EMPRESA realizar?? el seguimiento de los requerimientos en un plazo m??ximo de 24 horas contadas desde que se notifique y se registre el problema en los canales de atenci??n al cliente de LA EMPRESA, y el cumplimiento de la correcci??n del mismo en caso de reclamos y de requerir soporte t??cnico el tiempo m??ximo de respuesta es de 7 d??as despu??s recibida la notificaci??n por parte de EL ABONADO de acuerdo a la cl??usula sexta de este contrato. Las caracter??sticas t??cnicas y de calidad de servicio constan en el Anexo T??cnico Comercial que debidamente firmado por las partes es integrante del presente contrato y cumple con lo exigido en la Resoluci??n 216-09CONATEL-2009.</p>
        <p><b>CL??SULA D??CIMA PRIMERA. - MANTENIMIENTO PREVENTIVO Y CORRECTIVO Y UTILIZACI??N DE LA INFRAESTRUCTURA: </b>El mantenimiento preventivo y correctivo, ordinario y extraordinario corren por cuenta de LA EMPRESA; mientras que EL ABONADO ser?? responsable del manejo, mantenimiento, reparaci??n y/o adecuaci??n de los equipos que son parte de la red interna de EL ABONADO. EL ABONADO, es responsable de que las instalaciones el??ctricas dentro de su infraestructura cuenten con energ??a el??ctrica aterrizada y estabilizada; adicionalmente, el(los) equipo(s) que LA EMPRESA instale en la ubicaci??n contratada por EL ABONADO debe(n) ser conectados a una toma de UPS provista por EL ABONADO.</p>
        <p><b>CL??USLA D??CIMA SEGUNDA. -TERMINACION: </b>El presente contrato terminar?? por las siguientes causas:<br> Por mutuo acuerdo de las partes<br> Por incumplimiento de las obligaciones descritas en el presente contrato.<br> Por vencimiento del plazo de vigencia previa comunicaci??n de alguna de las partes;<br> Por causas de fuerza mayor o caso fortuito debidamente comprobado;<br> Por falta de pago de 2 mensualidades seguidas por parte de EL ABONADO.<br> El Abonado podr?? dar por terminado unilateralmente el contrato en cualquier tiempo, previa notificaci??n por escrito con al menos quince d??as de anticipaci??n a la finalizaci??n del per??odo en curso, no obstante, el abonado tendr?? la obligaci??n de cancelar los saldos pendientes ??nicamente por los servicios prestados hasta</p>
        </p>
    </div>
    <div class="page_break"></div>
<?php
    return ob_get_clean();
}
#endregion

#region page6
function getPage6(array $data_head)
{
    ob_start();
?>
    <?= getHeader($data_head, '6 de 7') ?>
    <style>
        .page6 {
            padding: 0 100px;
            padding-top: 10px;
        }

        .page6 p {
            font-size: 13.5px;
            text-align: justify;
        }
    </style>
    <div class="page6">
        <p>la fecha de la terminaci??n unilateral del contrato, as?? como los valores adeudados por los equipos no devueltos conforme a lo estipulado en la presente.<br> Si el ABONADO utiliza los servicios contratados para fines distintos a los convenidos, o si los utiliza en pr??cticas contrarias a la ley, las buenas costumbres, la moral o cualquier forma que perjudique a LA EMPRESA.</p>
        <p><b>CL??SULA D??CIMA TERCERA. - OBLIGACIONES DE LAS PARTES: </b>LA EMPRESA se obliga a lo siguiente: Proporcionar el mantenimiento preventivo y correctivo, del servicio y la configuraci??n respectiva. Las determinadas en la Resoluci??n 216-09CONATEL-2009, o las que emitiere el ??rgano regulador. Garantizar??n la privacidad y confidencialidad de las telecomunicaciones en el servicio prestado al ABONADO. Las que constan en el Reglamento para la Prestaci??n de Servicios de Valor Agregado y sus modificaciones.</p>
        <p><b>EL ABONADO se obliga a lo siguiente: </b><br> Manejo, mantenimiento, reparaci??n y/o adecuaci??n de los equipos que son parte de su red; que las instalaciones el??ctricas dentro de su infraestructura cuenten con energ??a el??ctrica aterrizada y estabilizada; que el (los) equipo(s) sean conectado (s) a una toma de energ??a regulada provista por este ??ltimo. Pago oportuno e ??ntegro de los valores pactados en el presente contrato y a la devoluci??n de equipos conforme lo estipulado en el presente contrato. Obtener la debida autorizaci??n y/o licencia del propietario de programas o informaci??n en caso de que su transferencia a trav??s de Internet, as?? lo requiera. Obtener y salvaguardar el uso de la clave de acceso cuando la misma se requiera para la transferencia de informaci??n a trav??s de las redes de Internet. Respetar y someterse en todo a la Ley Org??nica de Telecomunicaciones, Ley de Propiedad Intelectual, y en general a todas las leyes que regulan la materia en el Ecuador. Informarse adecuadamente de las condiciones de cada uno de los servicios que brinda LA EMPRESA, los cuales se rigen por el presente Contrato y las leyes aplicables vigentes, no pudiendo alegar desconocimiento de dichas condiciones contractuales. Mantener actualizada la informaci??n de contacto, correo, tel??fono fijo, tel??fono m??vil con LA EMPRESA, para garantizar la recepci??n de la informaci??n que genera la relaci??n contractual.</p>
        <p><b>CL??USULA DECIMA CUARTA. - CAMBIOS EN EL CONTRATO. - </b>Si por alguna raz??n se reformara el Reglamento o la Ley que regula la prestaci??n de los servicios de valor agregado e internet, el presente contrato podr?? ser modificado en funci??n de los cambios que se dieren previa aprobaci??n y registro de la ARCOTEL.</p>
        <p><b>CL??USULA D??CIMA QUINTA. - CONTROVERSIAS: </b>Independientemente del juzgamiento de infracciones conforme a Ley Org??nica de Defensa del Consumidor, las partes acuerdan que podr??n solucionar sus controversias a trav??s de la mediaci??n, en el Centro de Mediaci??n y Arbitraje de la C??mara de Comercio de Morona Santiago.</p>
        <p><b>CL??USULA D??CIMA SEXTA. - ANEXOS: </b>Es parte integrante del presente contrato el Anexo T??CNICO - COMERCIAL que contiene las "Condiciones particulares del Servicio", as?? como los dem??s anexos y documentos que se incorporen de conformidad con el ordenamiento jur??dico.</p>
        <p><b>CLAUSULA D??CIMA SEPTIMA. - NOTIFICACIONES Y DOMICILIO: </b>Toda y cualquier notificaci??n que requiera realizarse en relaci??n con el presente Contrato, se har?? por escrito a los n??meros o correos electr??nicos de cada una de las partes. Cualquier cambio de domicilio debe ser comunicado por escrito a la otra parte en un plazo de 10 d??as, a partir del d??a siguiente en que el cambio se efect??e.</p>
        <p><b>CLAUSULA D??CIMA SEPTIMA. - NOTIFICACIONES Y DOMICILIO: </b>Autorizo(amos) expresa e irrevocablemente a MORONA NET o a quien sea en el futuro el cesionario, beneficiario o acreedor del cr??dito solicitado o del documento o t??tulo cambiario que lo respalde, para que obtenga cuantas veces sean necesarias, de cualquier fuente de informaci??n, incluidos los bur??s de cr??dito, mi informaci??n de riesgos crediticios, de igual forma, MORONA NET o a quien sea en el futuro el cesionario, beneficiario o acreedor del cr??dito solicitado o del documento o t??tulo cambiario que lo respalde, queda expresamente autorizado para que pueda transferir o entregar dicha informaci??n a los bur??s de cr??dito y/o a la Central de Riesgos si fuere pertinente.</p>
    </div>
    <div class="page_break"></div>
<?php
    return ob_get_clean();
}
#endregion

#region page7
function getPage7(array $data_head, array $data_business, array $data_client)
{
    ob_start();
?>
    <?= getHeader($data_head, '7 de 7') ?>
    <style>
        .page7 {
            padding: 0 100px;
            padding-top: 10px;
        }

        .page7 p {
            font-size: 13.5px;
            text-align: justify;
        }

        .page7 .layout1 {
            width: 100%;
        }

        .page7 .layout1 tr td {
            font-size: 13.5px;
            padding: 3px 5px;
            vertical-align: middle;
        }

        .page7 .layout1 thead tr td {
            text-align: center;
        }

        .page7 .firma {
            width: 220px;
        }

        .page7 .layout2 {
            width: 100%;
        }

        .page7 .layout2 tr td {
            font-size: 13px;
        }

        .page7 .layout3 {
            width: 100%;
        }

        .page7 .layout3 .circle {
            border-radius: 30px;
            border: solid 1px #000000;
            padding: 0 35px;
            padding-top: 5px;
            width: 200px;
        }

        .page7 .layout3 .space {
            color: transparent;
            padding: 40px 0;
        }

        .page7 .layout3 tr td {
            width: 100px;
            padding: 20px;
        }

        .t-left {
            text-align: left;
        }
    </style>
    <div class="page7">
        <p><b style="padding-left:20px">1.<b style="color:transparent">__</b>ACTA DE ENTREGA DE LOS EQUIPOS A T??TULO DE ARRENDAMIENTO</b><br>Recuerde que los equipos que se describen incluidos en el ANEXO T??CNICO - COMERCIAL, son entregados a t??tulo de arrendamiento, como figura en la cl??usula cuarta del contrato, Compra, Arrendamiento de Equipos (para acceso a Internet Banda Ancha O Dedicado). Se entiende que el Abonado es salvaguarda de los equipos que se le instalan en calidad de arrendamiento.</p>
        <h5 style="padding-left:60px">DESCRIPCION DE EQUIPOS:</h5>
        <table class="layout1" border=1>
            <thead>
                <tr>
                    <td rowspan="2"><b>CANT.</b></td>
                    <td rowspan="2"><b>DETALLE</b></td>
                    <td rowspan="2"><b>SERIE</b></td>
                    <td colspan="3"><b>ESTADO</b></td>
                </tr>
                <tr>
                    <td><b>Bueno</b></td>
                    <td><b>Malo</b></td>
                    <td><b>Regular</b></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td>Metros de Fibra Optica</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>ONT</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Conectores mecanicos de Fibra Optica</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><b style="color:transparent">X</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table class="layout2">
        <br><br>
        <!-- <table>
            <tr>
                <td>
                    <img src="data:image/png;base64,<?= base64_encode(file_get_contents($data_head['img_route'] . "firma.png")) ?>" class="firma" />
                </td>
                <td>
                    <p><b>En este formato se describe todos los equipos que instalan o desmontan, por lo tanto, hace parte integral del contrato de prestaci??n de servicios.</b></p>
                    <p><b>Acepto conocer y estar de acuerdo con los puntos aqu?? descritos para el plan elegido</b></p>
                </td>
            </tr>
        </table>
        <br><br>

        <table class="layout3">
            <tr>
                <td>
                    <div class="circle">
                        <div class="space">__</div>
                        <hr>
                        <p class="t-left">Sr. <?= $data_business['razon_social'] ?><br><b>GERENTE- PROPIETARIO</b><br> R.U.C. <?= $data_business['ruc'] ?><br> <?= $data_business['telefono'] ?></p>
                    </div>
                </td>
                <td>
                    <div class="circle">
                        <div class="space">__</div>
                        <hr>
                        <p class="t-left">Sr(a) <?= $data_client['nombres'] ?><br> <b>CLIENTE</b><br> C.I. <?= $data_client['cedula'] ?><br> Tel??fono: <?= $data_client['telefono'] ?></p>
                    </div>
                </td>
            </tr>
        </table> -->
        <p><b>En este formato se describe todos los equipos que instalan o desmontan, por lo tanto, hace parte integral del contrato de prestaci??n de servicios.</b></p>
        <p><b>Acepto conocer y estar de acuerdo con los puntos aqu?? descritos para el plan elegido</b></p>
        <br>
        <table class="layout3">
            <tr>
                <td>
                    <div class="circle">
                        <img src="data:image/png;base64,<?= base64_encode(file_get_contents($data_head['img_route'] . "firma.png")) ?>" class="firma" />
                        <hr>
                        <p class="t-left">Sr. <?= $data_business['razon_social'] ?><br><b>GERENTE- PROPIETARIO</b><br> <b>R.U.C. </b><?= $data_business['ruc'] ?><br> <?= $data_business['telefono'] ?></p>
                    </div>
                </td>
                <td>
                    <div class="circle">
                        <div class="space">__</div>
                        <hr>
                        <p class="t-left">Sr(a) <?= $data_client['nombres'] ?><br> <b>CLIENTE</b><br> C.I. <?= $data_client['cedula'] ?><br> Tel??fono: <?= $data_client['telefono'] ?></p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <!-- <div class="page_break"></div> -->
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

//get day from string date in date zone America/Guayaquil
function getParamDate($date, $param = 'd')
{
    $separator = strpos($date, "-") ? "-" : "/";
    $date = explode($separator, $date);
    $day = $date[0];
    $month = $date[1];
    $year = $date[2];
    switch ($param) {
        case 'd':
            return $day;
            break;
        case 'm':
            return $month;
            break;
        case 'y':
            return $year;
            break;
        default:
            return $day;
            break;
    }
}



// convertir mes a letras
function getMonthName($month)
{
    $month = (int) $month;
    $months = [
        1 => "Enero",
        2 => "Febrero",
        3 => "Marzo",
        4 => "Abril",
        5 => "Mayo",
        6 => "Junio",
        7 => "Julio",
        8 => "Agosto",
        9 => "Septiembre",
        10 => "Octubre",
        11 => "Noviembre",
        12 => "Diciembre",
    ];
    return strtolower($months[$month]);
}

/*
const w1 = "Cuenca y soasti Parroquia Sevilla Sector Palmeras Ciudad sevillas";
const w2 = "Jimbitono Sector 9 de octubre Ciudad Macas";
const w3 = "Jimbitono Parroquia Sevilla Ciudad sevillas";

console.log("w1: ");

console.log(getField(w1, "parroquia"));
console.log(getField(w1, "sector"));
console.log(getField(w1, "ciudad"));

console.log("w2: ");

console.log(getField(w2, "parroquia"));
console.log(getField(w2, "sector"));
console.log(getField(w2, "ciudad"));

console.log("w3: ");

console.log(getField(w3, "parroquia"));
console.log(getField(w3, "sector"));
console.log(getField(w3, "ciudad"));

console.log(getField(w1, ["parroquia", "sector"]));

function getField(w, field) {
  w = w.toLowerCase();
  if (Array.isArray(field)) {
    let str = "";
    field.forEach((el) => {
      el = el.toLowerCase();
      const tmp = w.split(el);
      str = w.replace(el, tmp[1]);
      
      str = w.replace(el, "");
    });

    return str;
  }

  field = field.toLowerCase();
  let str = w.split(field)[1];
  if (!str) return false;
  str = str.split("sector")[0];
  str = str.split("ciudad")[0];
  return getCapitalize(str);
}

function getCapitalize(str) {
  const arr = str.split(" ");
  for (var i = 0; i < arr.length; i++) {
    arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1);
  }
  const str2 = arr.join(" ");
  return str2;
}

*/