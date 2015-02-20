<?php


// Sets timezone to São Paulo, Brazil
date_default_timezone_set('America/Sao_Paulo');


// Sets up external OAuth Library
require 'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;


//Gets Twitter credentials
require '.credentials.php';

$value = mt_rand(0, 1000) / 7;

$stringValue = number_format((float)$value, 2, ',', '');

$string = '@cambioedesligo '.$stringValue;

// Connects to Twitter and uploads the encoded blob
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token, $access_token_secret);
$content = $connection->post('statuses/update', ['status' => $string]);

var_dump($string);
