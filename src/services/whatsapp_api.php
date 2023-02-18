<?php

use Twilio\Rest\Client;

$sid    = $_ENV["TWILIO_ACCOUNT_SID"];
$token  = $_ENV["TWILIO_AUTH_TOKEN"];
$twilio = new Client($sid, $token);

$message = $twilio->messages->create(
    "whatsapp:" . $number, // to 
    array(
        "from" => "whatsapp:" . $_ENV['TWILIO_WHATSAPP_NUMBER'],
        "body" => $message
    )
);

print($message->sid);
