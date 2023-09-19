<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

// Get the scraped data from trupe.html
$scrapedData = file_get_contents('trupe.html');

// Get the form data
$numeTrupa = $_POST['numeTrupa'];
$vanzari = $_POST['vanzari'];

// Create a new Guzzle client
$client = new Client();

// Set the endpoint URL and JSON data
$url = 'http://localhost/trupe.json';
$data = [
    'numeTrupa' => $numeTrupa,
    'vanzari' => $vanzari,
    'scrapedData' => $scrapedData
];

// Make a POST request with the JSON data
$response = $client->post($url, [
    'json' => $data
]);

// Print the response status code and body
echo 'Status code: ' . $response->getStatusCode() . '<br>';
echo 'Body: ' . $response->getBody();
?>
