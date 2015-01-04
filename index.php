<?php

// Sets up external OAuth Library
require 'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;


// Gets Twitter credentials from an external file
require 'credentials.php';


// Sets up ImageMagick objects and pulls in cover template
$im = new Imagick('assets/images/cover.png');
$draw = new ImagickDraw();


// Get number of days between now and target
$now = time();
$your_date = strtotime("2015-03-16");
$datediff = $now - $your_date;
$numberOfDays = floor($datediff/(60*60*24));
$numberOfDays = -$numberOfDays;


// Sets up font for countdown writing
$draw->setFont('assets/fonts/BebasNeue Regular.ttf');
$draw->setFontSize(82);
$draw->setFillColor('#ffcc00');


// Draws number of days on template
$im->annotateImage($draw, 445, 332, 0, $numberOfDays . ' DIAS');


// Encodes image blob to base-64
$blob = $im->getImageBlob();
$encodedBlob = base64_encode($blob);


// Connects to Twitter and uploads the encoded blob
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_token_secret);
$content = $connection->post('account/update_profile_banner', ['banner' => $encodedBlob]);

var_dump($content);