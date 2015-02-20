<?php


// Sets timezone to São Paulo, Brazil
date_default_timezone_set('America/Sao_Paulo');


// Sets up external OAuth Library
require 'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;


//Gets Twitter credentials
require '.credentials.php';

// Sets up path
$pathToAssets = 'assets';


// Sets up ImageMagick objects and pulls in cover template
$im = new Imagick($pathToAssets . '/images/cover.png');
$draw = new ImagickDraw();


// Get number of days between now and target
$now = time();
$your_date = strtotime("2015-02-26");
$datediff = $your_date - $now;
$numberOfDays = floor($datediff/(60*60*24));
$string = $numberOfDays . ' DIAS';


// Sets up font for countdown writing
$draw->setFont($pathToAssets . '/fonts/BebasNeue Regular.ttf');
$draw->setFontSize(82);
$draw->setFillColor('#ffcc00');


// Draws number of days on template
$im->annotateImage($draw, 445, 332, 0, $string);


// Encodes image blob to base-64
$blob = $im->getImageBlob();
$encodedBlob = base64_encode($blob);


// Connects to Twitter and uploads the encoded blob
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_token_secret);
$content = $connection->post('account/update_profile_banner', ['banner' => $encodedBlob]);

var_dump($string);
