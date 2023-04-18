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
    string $client_nodo,
    string $servidor_name,
    string $client_ip,
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
        "servidor_name" => $servidor_name,
        "pppuser" => $client_pppuser, //dato4
        "ppppass" => $client_ppppass, //dato4
        "canton" => "Morona",
        "sector" => $client_sector,
        "valor_mensual" => $client_costo, //dato5
        "ciudad" => $client_ciudad,
        "telefono" => $client_telefono, //dato6
        "ip" => $client_ip,
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
    $html .= getPage1($data_head, $data_header, $data_business, $data_client, $servidor_name);
    $html .= getpage2($data_head);
    $html .= getpage3($data_head, array(
        "plan" => $data_client['plan'],
        "valor_mensual" => $client_costo,
        "pago_directo" => "si",
        "pago_debito" => "si",
        "pago_locales" => "no",
        "pago_credito" => "no",
        "pago_transferencia" => "si",
        "servidor_name" => $servidor_name
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
function getPage1(array $data_head, array $data_header, array $data_business, array $data_client, string $servidor_name)
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
                <td><b>CONTRATO Nº: </b></td>
                <td><?= $data_header['contrato_n'] ?></td>
                <td><b>FECHA DE INICIO: </b><br><?= $data_header['fecha_inicio'] ?></td>
                <td><b>FECHA DE TERMINACION: </b><br><?= $data_header['fecha_final'] ?></td>
                <td><b>VIGENCIA: </b><br><?= $data_header['vigencia'] ?></td>
            </tr>
        </table>
        <h5 style="text-align: center;">CONTRATO DE PRESTACIÓN DE SERVICIOS</h5>
        <h5 style="margin:0">CLAUSULA PRIMERA. - DATOS DE LOS COMPARECIENTES:</h5>
        <p style="margin:0;">En la ciudad de Macas a los <?= getParamDate($data_head['dato_fecha']) ?> días del mes de <?= getMonthName(getParamDate($data_head['dato_fecha'], 'm')) ?> del año <?= getParamDate($data_head['dato_fecha'], 'y') ?> celebran el presente Contrato de Adhesión de prestación de Servicios de Acceso a Internet; por una parte, el Señor José Andrés Chacha Chuca, a quien mediante resolución del ARCOTEL expedida por la Agencia de Regulación y Control de las Telecomunicaciones otorgó el permiso para la prestación del servicio de acceso a internet, permiso suscrito el 07 de noviembre del 2019 e inscrito en el tomo a fojas 139-13997, del registro público de telecomunicaciones, los datos de detallan a continuación:</p>
        <table class="layout2">
            <tr>
                <td colspan="3"><b>NOMBRE/ RAZÓN SOCIAL: </b><?= $data_business['razon_social'] ?></td>
            </tr>
            <tr>
                <td colspan="3"><b>NOMBRE COMERCIAL: </b><?= $data_business['nombre_comercial'] ?></td>
            </tr>
            <tr>
                <td colspan="3"><b>DIRECCIÓN: </b><?= $data_business['direccion'] ?></td>
            </tr>
            <tr>
                <td><b>PROVINCIA: </b><?= $data_business['provincia'] ?></td>
                <td><b>CIUDAD: </b><?= $data_business['ciudad'] ?></td>
                <td><b>CANTÓN: </b><?= $data_business['canton'] ?></td>
            </tr>
            <tr>
                <td><b>PARROQUIA: </b><?= $data_business['parroquia'] ?></td>
                <td colspan="2"><b>N° DE TELÉFONO: </b><?= $data_business['telefono'] ?></td>
            </tr>
            <tr>
                <td><b>RUC: </b><?= $data_business['ruc'] ?></td>
                <td colspan="2"><b>CORREO ELECTRÓNICO: </b><?= $data_business['email'] ?></td>
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
                <td colspan="3" rowspan="2">¿El abonado es de la tercera edad o discapacitado? (En caso afirmativo,aplica tarifa preferencial de acuerdo al plan del prestador):</td>
                <td><b>SI: </b></td>

                <?php if (!str_contains(strtolower($servidor_name), "inalambrico")) { ?>
                    <td rowspan="3" style="text-align:center">
                        <img style="width:65px; margin-top:4px" src="data:image/png;base64,<?= qrcode_PPPoE($data_client['pppuser'], "user") ?>" />
                        <img style="width:65px; margin-top:4px" src="data:image/png;base64,<?= qrcode_PPPoE($data_client['ppppass'], "pass") ?>" />
                    </td>
                <?php } ?>

                <td rowspan="3" <?= str_contains(strtolower($servidor_name), "inalambrico") ? "colspan='2'" : "" ?> style="text-align:center">
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
                <td <?= !str_contains(strtolower($servidor_name), "inalambrico") ? "colspan='3'" : "" ?>><?= $data_client['telefono'] ?></td>
                <?php if (str_contains(strtolower($servidor_name), "inalambrico")) { ?>
                    <td><b>IP: </b></td>
                    <td><?= $data_client['ip'] ?></td>
                <?php } ?>
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
            <li>EL ABONADO una vez recibido el servicio y los equipos a satisfacción, se obliga respecto de los mismos de conformidad con las normas legales vigentes.</li>
            <li>LA EMPRESA, no se hace responsable por los daños imputables al ABONADO por manipulación de los equipos o las configuraciones que LA EMPRESA estableció en las instalaciones de EL ABONADO para brindar el servicio de Internet.</li>
            <li>En el caso de no entrega de los equipos en el tiempo y las condiciones establecidas, salvo el deterioro ordinario de los mismos, LA EMPRESA facturará a EL ABONADO el valor total de los equipos.</li>
            <li>Las averías en los equipos serán reparadas por LA EMPRESA a solicitud de EL ABONADO. LA EMPRESA facturará al EL ABONADO el valor de las reparaciones de los equipos, salvo cuando el daño provenga de defectos de fabricación en los cuales LA EMPRESA responderá por los equipos que se encuentren en arrendamiento hasta por la garantía mínima presunta que otorgue o tenga su fabricante y por lo tanto estos sólo serán reemplazados por fallas o defectos imputables a la misma.</li>
            <li>En caso de daño irreparable del equipo que no provenga de defectos de fabricación, causa natural como tormentas eléctricas u otros, de deterioro no imputable a un vicio oculto, hurto debidamente denunciado ante los organismos competentes, EL ABONADO pagará a la EMPRESA el valor de reposición vigente del equipo a la fecha de cobro, de conformidad con la certificación que al respecto expida el área financiera de LA EMPRESA, para lo cual tendrá en cuenta el demérito por uso. En cualquier caso, EL ABONADO debe informar a LA EMPRESA por escrito dentro del término de 8 días la ocurrencia de cualquiera de los eventos mencionados, a falta de lo cual no podrá exonerarse de su responsabilidad.</li>
            <li>El equipo será instalado, trasladado o retirado por personal autorizado por LA EMPRESA.</li>
            <li>LA EMPRESA se reserva la facultad de cambiar la plataforma tecnológica del sistema caso en el cual procederá a sustituir los equipos entregados en arrendamiento.</li>
            <li>La EMPRESA atenderá los reportes de daños a través de la línea de Servicio al Cliente, y realizará el mantenimiento en el menor tiempo posible.</li>
            <li>EL ABONADO se obliga a mantener los equipos en la dirección establecida en el contrato de servicios del acceso a Internet. La EMPRESA solo atenderá la solicitud de mantenimiento o reparación en dicha dirección o en aquella que corresponda a un traslado reportado con anterioridad en forma escrita por EL ABONADO a LA EMPRESA.</li>
            <li>EL ABONADO entiende que no podrá requerir IP´s públicas estáticas en planes Residenciales, sin embargo, acepta que la dirección IP asignada podrá ser modificada por traslados, cambios de plan, mejoras tecnológicas o actualizaciones técnicas.</li>
            <li>Los planes de servicios de internet ofertados por LA EMPRESA, no incluyen cuentas de correo electrónico.</li>
            <li>El equipo terminal provisto por LA EMPRESA, dispone de puertos alámbricos que permiten la utilización óptima de la velocidad ofertada en el plan contratado, además cuenta con conexión inalámbrica WIFI que dispone de una cobertura variable según la cantidad de paredes, estructuras del sitio de instalación del servicio, obstáculos e interferencias que se encuentren en el entorno. EL ABONADO conoce y acepta que la tecnología WIFI pierde potencia a medida que aumenta la distancia y por lo tanto se reducirá la velocidad efectiva a mayor distancia de conexión del equipo. Se establece una velocidad máxima WIFI de hasta 15 metros en condiciones normales.</li>
            <li>EL ABONADO garantizará que el personal designado por LA EMPRESA, pueda ingresar a los sitios donde se encuentren instalados los equipos, para efectos de revisión, reparación, mantenimiento o cuando la empresa así lo requiera. El incumplimiento de estas condiciones será causal de terminación unilateral del contrato.</li>
            <li>En señal de aceptación y constancia de entrega y recibo de los equipos y servicio, se firma POR AMBAS PARTES AL FINAL DE ESTE CONTRATO EN LA SECCIÓN DE LAS FIRMAS.</li>

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
        <p><b class="title">CLÁUSULA SEGUNDA. - OBJETO, CARACTERISTICAS. - </b> El presente contrato tiene por objeto que LA EMPRESA proporcione a EL ABONADO el acceso a la red de internet conforme a las características pactadas, que debidamente firmados por las partes, son integrantes de este instrumento.</p>
        <p>Las partes aceptan que este instrumento constituya un contrato marco general, y que, en adelante los servicios, cambios en los servicios, y cualquier otra modificación que se implemente; se realizará en los anexos correspondientes, que debidamente firmados por las partes, serán integrantes de este Contrato, y se seguirán las condiciones generales de este instrumento con las especificaciones establecidas.</p>
        <p><b class="title">CLÁUSULA TERCERA. - PRECIO Y FORMA DE PAGO. - </b>El precio acordado por la instalación y puesta en funcionamiento por el Servicio de Acceso a Internet y que es firmado por las partes, es integrante del presente contrato.</p>
        <?= getPlansByServer($data) ?>
        <p>El precio mensual acordado por la prestación del Servicio de Acceso a Internet, es el que corresponde al Plan contratado, y cuyo valor mensual y descripción consta en la tabla anterior, que debidamente firmado por las partes, es integrante del presente contrato.</p>
        <p>El Plan contratado se pagará en mensualidades, pagaderas por el EL ABONADO a LA EMPRESA por mes consumido, dentro de los 5 primeros días de cada mes calendario; previo la entrega de la factura por el servicio contratado. En caso de que, EL ABONADO no cancele los valores hasta el sexto día dentro del mes calendario que se encuentre en curso, LA EMPRESA tiene la facultad de suspender la prestación del servicio en cualquier momento, de no producirse el pago del plan dentro del plazo antes señalado, sin que implique terminación de contrato. <br>EL ABONADO, se compromete con la EMPRESA del servicio a pagar las tarifas o valores mensuales por cada uno de los servicios contratados, y el pago se realizará de la siguiente forma:</p>
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
                <td>Débito automático cuenta de ahorro o corriente</td>
                <td><?= strtolower($data['pago_debito']) == "si" ? "X" : "" ?></td>
                <td><?= strtolower($data['pago_debito']) != "si" ? "X" : "" ?></td>
            </tr>
            <tr>
                <td>Pago en ventanilla de locales autorizados</td>
                <td><?= strtolower($data['pago_locales']) == "si" ? "X" : "" ?></td>
                <td><?= strtolower($data['pago_locales']) != "si" ? "X" : "" ?></td>
            </tr>
            <tr>
                <td>Débito con tarjeta de crédito</td>
                <td><?= strtolower($data['pago_credito']) == "si" ? "X" : "" ?></td>
                <td><?= strtolower($data['pago_credito']) != "si" ? "X" : "" ?></td>
            </tr>
            <tr>
                <td>Transferencia vía medios electrónicos</td>
                <td><?= strtolower($data['pago_transferencia']) == "si" ? "X" : "" ?></td>
                <td><?= strtolower($data['pago_transferencia']) != "si" ? "X" : "" ?></td>
            </tr>
        </table>
        <p>En caso de que el abonado o suscritor desee cambiar su modalidad de pago a otra de las disponibles, deberá comunicar a LA EMPRESA del servicio con quince (15) días de anticipación. El prestador del servicio, luego de haber sido comunicado, instrumentará la nueva forma de pago.</p>
        <p><b>CLÁUSULA CUARTA. - COMPRA, ARRENDAMIENTO DE EQUIPOS Y SERVICIOS. - </b>LA EMPRESA pondrá a disposición de EL ABONADO en Comodato precario, el(los) equipo(s) que consten en el acta </p>
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
        <p>entrega recepción de servicios y equipos. <br> EL ABONADO velará por la buena custodia, cuidado y uso de los equipos entregados en comodato. Si los equipos entregados por el prestador de servicios en comodato sufren robo, hurto, perdida y/o daños por incorrecta manipulación del EL ABONADO, dicho robo, hurto o perdida y/o daño será responsabilidad exclusiva del abonado, quien asumirá el costo total de un nuevo equipo.<br>En caso de terminación del contrato por cualquier causa, el abonado entregará en las oficinas del prestador de servicios, el o los equipos entregados en comodato precario, en plazo máximo de 15 días posteriores a la terminación del contrato. En caso de no devolución del o los equipos dentro del término indicado, el abonado asumirá el precio del o los equipos.<br>Para el caso de servicios FTTH son equipos ONT con wifi incluido. El costo es de USD$30(más IVA) del equipo ONT, los cuáles deben incluir sus respectivas fuentes. En caso de pérdida de las fuentes, tienen un costo de USD$10,00 cada una.<br>Para el caso de servicios INALAMBRICOS son equipos antena WiFi y CPE del abonado. Los costos son de USD$30 (más IVA) de la antena WiFi y USD$ 30 (más IVA) del equipo CPE del abonado, los cuáles deben incluir sus respectivas fuentes. En caso de pérdida de las fuentes, tienen un costo de USD$10,00 cada una.<br>La instalación del servicio incluye un punto de acometida donde se colocarán los quipos que serán administrados exclusivamente por LA EMPRESA. No se podrán retirar, resetear, desinstalar o sustituir los equipos proporcionados por LA EMPRESA o modificar la configuración de los mismos.</p>
        <p><b>CLÁUSULA QUINTA.- USO DE INFORMACIÓN PERSONAL: </b>LA EMPRESA garantizará la privacidad y protección de los datos que EL ABONADO ha detallado en el presente contrato, por lo que EL ABONADO conoce y Si No autoriza que LA EMPRESA pueda proporcionar a terceros datos necesarios para poder realizar la entrega de estado de cuenta, facturación, recordatorios de fechas de pago o montos de pago, fidelización, información de nuevos servicios, información de promociones especiales, entre otros; así mismo también autoriza a hacer uso de esta información para fines comerciales o de brindar beneficios al EL ABONADO a través de alianzas desarrolladas. Adicionalmente EL ABONADO Si No acepta expresamente que LA EMPRESA puede utilizar medios electrónicos y llamadas para: 1.- Notificar cambios relacionados con los términos y condiciones del presente CONTRATO, 2.- Realizar gestiones de cobranzas y demás promociones aplicables de acuerdo a la normativa vigente. Sin embargo, de lo anterior, LA EMPRESA podrá entregar los datos de EL ABONADO en caso de requerimientos realizados por autoridad competente conforme al ordenamiento jurídico vigente y particularmente de la Agencia de Regulación y Control de las Telecomunicaciones para el cumplimiento de sus funciones. 3.- Comunicaciones relacionadas a soporte y notificaciones de carácter técnico.</p>
        <p><b>CLÁUSULA SEXTA. - RECLAMOS Y SOPORTE TÉCNICO: </b>En caso de reclamos y soporte técnico, el tiempo máximo de respuesta es de 7 días después de recibida la notificación por parte de EL ABONADO en los canales de atención de LA EMPRESA y de ser necesaria se generará una visita técnica o telemática al domicilio, cuyo costo se incluirá en el estado de cuenta del usuario, siempre y cuando la falla no sea imputable a la EMPRESA. Los canales de atención al cliente de LA EMPRESA son: 1) Página web 2) Contactos telefónicos 3) Redes sociales 4) Centros de Atención al cliente de LA EMPRESA. </p>
        <p>De acuerdo con la norma de calidad para la prestación de servicios de internet, para reclamos de velocidad de acceso el abonado deberá realizar las siguientes pruebas: 1) Realizar 2 o 3 pruebas de velocidad en canal vacío, en el velocímetro provisto por LA EMPRESA proveedora del servicio y guardarlas en un archivo gráfico. 2) Contactarse por los canales de atención al cliente de LA EMPRESA y enviar los resultados de las pruebas de lunes a viernes en horarios de 08h00 am hasta las 17h00 pm y los días sábados en horario de 08h00 a 14h00. El soporte presencial es en días y horas laborables. En caso de tener reclamos debidamente reportados, registrados y no resueltos por LA EMPRESA, puede comunicarse al ARCOTEL por cualquiera de los siguientes canales de atención:</p>
        <p><b>CLÁUSULA SÉPTIMA. - NORMATIVA APLICABLE: </b>En la prestación del servicio, se entienden incluidos todos los derechos y obligaciones de los abonados/suscriptores, así como también los derechos y obligaciones de los prestadores de servicios de telecomunicaciones dispuestos en la normativa ecuatoriana.</p>
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
        <p><b>CLÁUSULA OCTAVA. - DERECHOS DEL ABONADO. - </b>Son derechos de EL ABONADO:</p>
        <p>A recibir el servicio de acuerdo a los términos estipulados en el presente contrato. <br> A que no se varíe el precio estipulado en el contrato, mientras dure la vigencia del mismo o no se cambien las condiciones de la prestación a través de la suscripción de nuevos.<br> A reclamar de manera integral por los problemas de calidad tanto del Acceso a la Red Internet, así como por las deficiencias en el enlace provisto para brindar el servicio.<br> LA EMPRESA reconoce a sus abonados todos los derechos que se encuentran determinados en la Ley Orgánica de Defensa del Consumidor y su Reglamento; el Reglamento para la prestación del Servicios de Valor Agregado y la Resolución No. 216-09-CONATEL-2009.</p>
        <p><b>CLÁUSULA NOVENA: PLAZO DE VIGENCIA. - </b>El presente contrato, tendrá un plazo de vigencia de 12 meses, contados a partir de la fecha de suscripción del mismo.<br> Las partes se comprometen a respetar el plazo de vigencia pactado, en caso de retiro sin justificación<br> alguna el cliente pagara un valor por retiro anticipado de 80,00.<br> El abonado acepta la renovación automática sucesiva del contrato en las mismas condiciones, independientemente de su derecho a terminar la relación contractual conforme la legislación aplicable, solicitar cualquier tiempo, con hasta quince (15) días de antelación a la fecha de renovación, su decisión de no renovación:<br> SI NO
        <p><b>CLÁSULA DÉCIMA: CALIDAD DEL SERVICIO. - </b>LA EMPRESA cumplirá los estándares de calidad emitidos y verificados por los organismos regulatorios y de control de las telecomunicaciones en el Ecuador, no obstante, detalla que prestará sus servicios al ABONADO con los niveles de calidad especificados por LA EMPRESA. Así como declara que el SERVICIO DE INTERNET DEDICADO tendrá: Disponibilidad 98% mensual calculada sobre la base de 720 horas al mes. Para el cálculo de no disponibilidad del servicio no se considerará el tiempo durante el cual no se lo haya podido prestar debido a circunstancias de caso fortuito o fuerza mayor o completamente ajenas al proveedor.</p>
        <p>LA EMPRESA realizará el seguimiento de los requerimientos en un plazo máximo de 24 horas contadas desde que se notifique y se registre el problema en los canales de atención al cliente de LA EMPRESA, y el cumplimiento de la corrección del mismo en caso de reclamos y de requerir soporte técnico el tiempo máximo de respuesta es de 7 días después recibida la notificación por parte de EL ABONADO de acuerdo a la cláusula sexta de este contrato. Las características técnicas y de calidad de servicio constan en el Anexo Técnico Comercial que debidamente firmado por las partes es integrante del presente contrato y cumple con lo exigido en la Resolución 216-09CONATEL-2009.</p>
        <p><b>CLÁSULA DÉCIMA PRIMERA. - MANTENIMIENTO PREVENTIVO Y CORRECTIVO Y UTILIZACIÓN DE LA INFRAESTRUCTURA: </b>El mantenimiento preventivo y correctivo, ordinario y extraordinario corren por cuenta de LA EMPRESA; mientras que EL ABONADO será responsable del manejo, mantenimiento, reparación y/o adecuación de los equipos que son parte de la red interna de EL ABONADO. EL ABONADO, es responsable de que las instalaciones eléctricas dentro de su infraestructura cuenten con energía eléctrica aterrizada y estabilizada; adicionalmente, el(los) equipo(s) que LA EMPRESA instale en la ubicación contratada por EL ABONADO debe(n) ser conectados a una toma de UPS provista por EL ABONADO.</p>
        <p><b>CLÁUSLA DÉCIMA SEGUNDA. -TERMINACION: </b>El presente contrato terminará por las siguientes causas:<br> Por mutuo acuerdo de las partes<br> Por incumplimiento de las obligaciones descritas en el presente contrato.<br> Por vencimiento del plazo de vigencia previa comunicación de alguna de las partes;<br> Por causas de fuerza mayor o caso fortuito debidamente comprobado;<br> Por falta de pago de 2 mensualidades seguidas por parte de EL ABONADO.<br> El Abonado podrá dar por terminado unilateralmente el contrato en cualquier tiempo, previa notificación por escrito con al menos quince días de anticipación a la finalización del período en curso, no obstante, el abonado tendrá la obligación de cancelar los saldos pendientes únicamente por los servicios prestados hasta</p>
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
        <p>la fecha de la terminación unilateral del contrato, así como los valores adeudados por los equipos no devueltos conforme a lo estipulado en la presente.<br> Si el ABONADO utiliza los servicios contratados para fines distintos a los convenidos, o si los utiliza en prácticas contrarias a la ley, las buenas costumbres, la moral o cualquier forma que perjudique a LA EMPRESA.</p>
        <p><b>CLÁSULA DÉCIMA TERCERA. - OBLIGACIONES DE LAS PARTES: </b>LA EMPRESA se obliga a lo siguiente: Proporcionar el mantenimiento preventivo y correctivo, del servicio y la configuración respectiva. Las determinadas en la Resolución 216-09CONATEL-2009, o las que emitiere el órgano regulador. Garantizarán la privacidad y confidencialidad de las telecomunicaciones en el servicio prestado al ABONADO. Las que constan en el Reglamento para la Prestación de Servicios de Valor Agregado y sus modificaciones.</p>
        <p><b>EL ABONADO se obliga a lo siguiente: </b><br> Manejo, mantenimiento, reparación y/o adecuación de los equipos que son parte de su red; que las instalaciones eléctricas dentro de su infraestructura cuenten con energía eléctrica aterrizada y estabilizada; que el (los) equipo(s) sean conectado (s) a una toma de energía regulada provista por este último. Pago oportuno e íntegro de los valores pactados en el presente contrato y a la devolución de equipos conforme lo estipulado en el presente contrato. Obtener la debida autorización y/o licencia del propietario de programas o información en caso de que su transferencia a través de Internet, así lo requiera. Obtener y salvaguardar el uso de la clave de acceso cuando la misma se requiera para la transferencia de información a través de las redes de Internet. Respetar y someterse en todo a la Ley Orgánica de Telecomunicaciones, Ley de Propiedad Intelectual, y en general a todas las leyes que regulan la materia en el Ecuador. Informarse adecuadamente de las condiciones de cada uno de los servicios que brinda LA EMPRESA, los cuales se rigen por el presente Contrato y las leyes aplicables vigentes, no pudiendo alegar desconocimiento de dichas condiciones contractuales. Mantener actualizada la información de contacto, correo, teléfono fijo, teléfono móvil con LA EMPRESA, para garantizar la recepción de la información que genera la relación contractual.</p>
        <p><b>CLÁUSULA DECIMA CUARTA. - CAMBIOS EN EL CONTRATO. - </b>Si por alguna razón se reformara el Reglamento o la Ley que regula la prestación de los servicios de valor agregado e internet, el presente contrato podrá ser modificado en función de los cambios que se dieren previa aprobación y registro de la ARCOTEL.</p>
        <p><b>CLÁUSULA DÉCIMA QUINTA. - CONTROVERSIAS: </b>Independientemente del juzgamiento de infracciones conforme a Ley Orgánica de Defensa del Consumidor, las partes acuerdan que podrán solucionar sus controversias a través de la mediación, en el Centro de Mediación y Arbitraje de la Cámara de Comercio de Morona Santiago.</p>
        <p><b>CLÁUSULA DÉCIMA SEXTA. - ANEXOS: </b>Es parte integrante del presente contrato el Anexo TÉCNICO - COMERCIAL que contiene las "Condiciones particulares del Servicio", así como los demás anexos y documentos que se incorporen de conformidad con el ordenamiento jurídico.</p>
        <p><b>CLAUSULA DÉCIMA SEPTIMA. - NOTIFICACIONES Y DOMICILIO: </b>Toda y cualquier notificación que requiera realizarse en relación con el presente Contrato, se hará por escrito a los números o correos electrónicos de cada una de las partes. Cualquier cambio de domicilio debe ser comunicado por escrito a la otra parte en un plazo de 10 días, a partir del día siguiente en que el cambio se efectúe.</p>
        <p><b>CLAUSULA DÉCIMA SEPTIMA. - NOTIFICACIONES Y DOMICILIO: </b>Autorizo(amos) expresa e irrevocablemente a MORONA NET o a quien sea en el futuro el cesionario, beneficiario o acreedor del crédito solicitado o del documento o título cambiario que lo respalde, para que obtenga cuantas veces sean necesarias, de cualquier fuente de información, incluidos los burós de crédito, mi información de riesgos crediticios, de igual forma, MORONA NET o a quien sea en el futuro el cesionario, beneficiario o acreedor del crédito solicitado o del documento o título cambiario que lo respalde, queda expresamente autorizado para que pueda transferir o entregar dicha información a los burós de crédito y/o a la Central de Riesgos si fuere pertinente.</p>
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
        <p><b style="padding-left:20px">1.<b style="color:transparent">__</b>ACTA DE ENTREGA DE LOS EQUIPOS A TÍTULO DE ARRENDAMIENTO</b><br>Recuerde que los equipos que se describen incluidos en el ANEXO TÉCNICO - COMERCIAL, son entregados a título de arrendamiento, como figura en la cláusula cuarta del contrato, Compra, Arrendamiento de Equipos (para acceso a Internet Banda Ancha O Dedicado). Se entiende que el Abonado es salvaguarda de los equipos que se le instalan en calidad de arrendamiento.</p>
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
                    <td>Metros de <?= str_contains(strtolower($data_client['servidor_name']), "inalambrico") ? "Cable UTP" : "Fibra Óptica" ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><?= str_contains(strtolower($data_client['servidor_name']), "inalambrico") ? "Router" : "ONT" ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><?= str_contains(strtolower($data_client['servidor_name']), "inalambrico") ? "Conectores RJ45" : "Conectores mecanicos de Fibra Optica" ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><?= str_contains(strtolower($data_client['servidor_name']), "inalambrico") ? "Antena radioenlace " : "<b style='color:transparent'>X</b>" ?></td>
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
                    <p><b>En este formato se describe todos los equipos que instalan o desmontan, por lo tanto, hace parte integral del contrato de prestación de servicios.</b></p>
                    <p><b>Acepto conocer y estar de acuerdo con los puntos aquí descritos para el plan elegido</b></p>
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
                        <p class="t-left">Sr(a) <?= $data_client['nombres'] ?><br> <b>CLIENTE</b><br> C.I. <?= $data_client['cedula'] ?><br> Teléfono: <?= $data_client['telefono'] ?></p>
                    </div>
                </td>
            </tr>
        </table> -->
        <p><b>En este formato se describe todos los equipos que instalan o desmontan, por lo tanto, hace parte integral del contrato de prestación de servicios.</b></p>
        <p><b>Acepto conocer y estar de acuerdo con los puntos aquí descritos para el plan elegido</b></p>
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
                        <p class="t-left">Sr(a) <?= $data_client['nombres'] ?><br> <b>CLIENTE</b><br> C.I. <?= $data_client['cedula'] ?><br> Teléfono: <?= $data_client['telefono'] ?></p>
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

#region getPlans
function getPlansByServer($data)
{
    $server_name = $data['servidor_name'];

    $planes = [
        ["name" => "PLAN BASICO", "megas" => "40 MB", "cost" => "$20.00", "checked" => str_contains(strtolower($data['plan']), '40')],
        ["name" => "PLAN AVANZADO", "megas" => "60 MB", "cost" => "$25.00", "checked" => str_contains(strtolower($data['plan']), '60')],
        ["name" => "PLAN PLUS", "megas" => "80 MB", "cost" => "$30.00", "checked" => str_contains(strtolower($data['plan']), '80')],
        ["name" => "PLAN ULTRA VELOCIDAD", "megas" => "150 MB", "cost" => "$45.00", "checked" => str_contains(strtolower($data['plan']), '150')],
        ["name" => "PLAN ULTRA VELOCIDAD 4k", "megas" => "300 MB", "cost" => "$65.00", "checked" => str_contains(strtolower($data['plan']), '300')],
    ];

    if (str_contains(strtolower($server_name), 'inalambrico')) {
        $planes = [
            ["name" => "PLAN BASICO", "megas" => "6 MB", "cost" => "$20.00", "checked" => str_contains(strtolower($data['plan']), '6')],
            ["name" => "PLAN MEDIO", "megas" => "7 MB", "cost" => "$25.00", "checked" => str_contains(strtolower($data['plan']), '7')],
            ["name" => "PLAN AVANZADO", "megas" => "10 MB", "cost" => "$30.00", "checked" => str_contains(strtolower($data['plan']), '10')],
            ["name" => "PLAN AVANZADO +", "megas" => "15 MB", "cost" => "$40.00", "checked" => str_contains(strtolower($data['plan']), '15')],
        ];
    }

    if (str_contains(strtolower($server_name), 'alshi')) {
        $planes = [
            ["name" => "PLAN BASICO", "megas" => "20 MB", "cost" => "$20.00", "checked" => str_contains(strtolower($data['plan']), '20')],
            ["name" => "PLAN AVANZADO", "megas" => "40 MB", "cost" => "$25.00", "checked" => str_contains(strtolower($data['plan']), '40')],
            ["name" => "PLAN PLUS", "megas" => "60 MB", "cost" => "$30.00", "checked" => str_contains(strtolower($data['plan']), '60')],
            ["name" => "PLAN ULTRA VELOCIDAD", "megas" => "80 MB", "cost" => "$45.00", "checked" => str_contains(strtolower($data['plan']), '80')],
            ["name" => "PLAN ULTRA VELOCIDAD 4k", "megas" => "100 MB", "cost" => "$50.00", "checked" => str_contains(strtolower($data['plan']), '100')],
        ];
    }


    ob_start();
?>
    <table class="layout1">
        <tr>
            <td>
                <table class="layout2" border=1>
                    <tr>
                        <td><b>PLAN</b></td>
                        <td><b>MEGAS</b></td>
                        <td><b>COSTO</b></td>
                    </tr>
                    <?php foreach ($planes as $key => $value) { ?>
                        <tr>
                            <td><?= $value['name'] ?></td>
                            <td><?= $value['megas'] ?></td>
                            <td><?= $value['cost'] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </td>
            <td>
                <table class="layout3" border=1>
                    <tr>
                        <td><b style="color:transparent">X</b></td>
                    </tr>
                    <?php foreach ($planes as $key => $value) { ?>
                        <tr>
                            <td><b style="color:transparent">X</b><?= $value['checked'] ? 'X' : '' ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </td>
        </tr>
    </table>
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