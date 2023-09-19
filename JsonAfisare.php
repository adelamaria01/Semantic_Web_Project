<?php

require "vendor/autoload.php";

$client = new \GuzzleHttp\Client();

$cerere = $client->getAsync("http://localhost:4000/trupe");

$cerere->then("procesareRaspuns")->wait();

function procesareRaspuns($raspuns)
{
    $body = (string) $raspuns->getBody();

    print_r($body);
}
?>