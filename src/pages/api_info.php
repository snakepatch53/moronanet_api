<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Moronanet API</title>
</head>

<body class="container d-flex justify-content-center">
    <div>
        <h2 class="text-primary text-center mt-5">GUIA API MORONANET</h2>
        <div class="section mt-5">
            <div class="my-4">
                <h3 class="my-4">GET</h3>
                <div class="px-3">
                    <h4 class="text-success mt-5">Enviar mensajes por whatsapp</h4>
                    <h5>https://api.moronanet.com/whatsapp/<span class="text-secondary">{NUMERO_DE_CELULAR}</span>/<span class="text-secondary">{MENSAJE}</span>/<span class="text-secondary">{TOKEN}</span></h5>
                    <h5 class="text-secondary">PARAMETROS: </h5>
                    <ul>
                        <li><span class="text-secondary">{NUMERO_DE_CELULAR}</span> Numero de celular del receptor.</li>
                        <li><span class="text-secondary">{MENSAJE}</span> Mensaje a enviar.</li>
                        <li><span class="text-secondary">{TOKEN}</span> Clave de autorizacion de la API.</li>
                    </ul>
                </div>
                <div class="px-3">
                    <h4 class="text-success mt-5">Convertir texto a codigo QR</h4>
                    <h5>https://api.moronanet.com/qrcode/<span class="text-secondary">{TEXTO}</span>/<span class="text-secondary">{TOKEN}</span></h5>
                    <h5 class="text-secondary">PARAMETROS: </h5>
                    <ul>
                        <li><span class="text-secondary">{TEXTO}</span> Texto que desea representar en el codigo qr.</li>
                        <li><span class="text-secondary">{TOKEN}</span> Clave de autorizacion de la API.</li>
                    </ul>
                </div>
                <div class="px-3">
                    <h4 class="text-success mt-5">Convertir Ubicacion de google maps a codigo QR</h4>
                    <h5>https://api.moronanet.com/qrcode/location/<span class="text-secondary">{UBICACION}</span>/<span class="text-secondary">{TOKEN}</span></h5>
                    <h5 class="text-secondary">PARAMETROS: </h5>
                    <ul>
                        <li><span class="text-secondary">{UBICACION}</span> Ubicacion que desea convertir en enlace de codigo qr.</li>
                        <li><span class="text-secondary">{TOKEN}</span> Clave de autorizacion de la API.</li>
                    </ul>
                </div>
                <div class="px-3">
                    <h4 class="text-success mt-5">Generar contrato de clientes Moronanet</h4>
                    <h5>https://api.moronanet.com/contract/<span class="text-secondary">{CLIENTE_ID}</span>/<span class="text-secondary">{TOKEN}</span></h5>
                    <h5 class="text-secondary">PARAMETROS: </h5>
                    <ul>
                        <li><span class="text-secondary">{CLIENTE_ID}</span> Identificador unico del cliente en Mikrowisp.</li>
                        <li><span class="text-secondary">{TOKEN}</span> Clave de autorizacion de la API.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>