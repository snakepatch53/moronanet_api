<?php

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;


function qrcode_location($text, $type = 'location')
{
    $img_path = "./public/img/location.png";
    $result = Builder::create()
        ->writer(new PngWriter())
        ->writerOptions([])
        ->data("https://www.google.com.ec/maps/place/" . str_replace(' ', '', $text))
        ->encoding(new Encoding('UTF-8'))
        ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
        ->size(300)
        ->margin(0)
        ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
        ->logoResizeToHeight(70)
        ->logoResizeToHeight(70)
        ->logoPath($img_path)
        ->labelText('')
        ->labelFont(new NotoSans(20))
        ->labelAlignment(new LabelAlignmentCenter())
        ->validateResult(false)
        ->build();


    // Directly output the QR code
    // header('Content-Type: ' . $result->getMimeType());
    return base64_encode($result->getString());

    // Save it to a file
    // $result->saveToFile(__DIR__ . '/qrcode.png');

    // Generate a data URI to include image data inline (i.e. inside an <img> tag)
    // $dataUri = $result->getDataUri();
}

function qrcode_PPPoE($text, $type = 'user')
{
    $img_path = "./public/img/" . ($type == "user" ? "user" : "pass") . ".png";
    $result = Builder::create()
        ->writer(new PngWriter())
        ->writerOptions([])
        ->data($text)
        ->encoding(new Encoding('UTF-8'))
        ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
        ->size(300)
        ->margin(0)
        ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
        ->logoResizeToHeight(70)
        ->logoResizeToHeight(70)
        ->logoPath($img_path)
        ->labelText('')
        ->labelFont(new NotoSans(20))
        ->labelAlignment(new LabelAlignmentCenter())
        ->validateResult(false)
        ->build();
    // $label->setText('Este texto aparecerá en la mitad del código QR');
    // $label->setPadding(4);
    // $label->setFont(new NotoSans(20));
    // $label->setAlignment(new LabelAlignmentCenter());
    // $result->setLabel($label);


    // Directly output the QR code
    // header('Content-Type: ' . $result->getMimeType());
    return base64_encode($result->getString());

    // Save it to a file
    // $result->saveToFile(__DIR__ . '/qrcode.png');

    // Generate a data URI to include image data inline (i.e. inside an <img> tag)
    // $dataUri = $result->getDataUri();
}
