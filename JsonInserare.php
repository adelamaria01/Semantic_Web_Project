<?php

require "vendor/autoload.php";
$client = new \GuzzleHttp\Client();

$dateDecodate = json_decode(file_get_contents("php://input"), true);

$cerere = $client->postAsync("http://localhost:4000/trupe", [
    "json" => $dateDecodate,
    "headers" => ["Content-type" => "application/json"]
]);

$cerere->then("procesareRaspuns")->wait();

function procesareRaspuns($raspuns)
{
    print $raspuns->getBody();
}
?>