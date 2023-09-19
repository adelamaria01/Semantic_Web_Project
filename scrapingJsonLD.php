<?php
require "vendor/autoload.php";

$client = new \GuzzleHttp\Client(['verify' => false]);
$antete = [
    "headers" => [
        "User-Agent" => "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36"
    ]
];
$cerere = $client->getAsync("https://www.imdb.com/title/tt1661199/?ref_=nv_sr_srsg_0_tt_8_nm_0_q_cindere", $antete);

$cerere->then("procesareRaspuns")->wait();

function procesareRaspuns($raspuns)
{
    $raspunsHTTP = $raspuns->getBody();
    libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    $doc->loadHTML($raspunsHTTP);
    $docInterogabil = new DOMXPath($doc);
    $rezultat = $docInterogabil->query("//script[@type='application/ld+json']");
    $graf = $rezultat[0]->nodeValue;

    $dateDistilate = json_decode($graf);

    $titlu = $dateDistilate->name;
    $recenzie = $dateDistilate->aggregateRating->ratingValue;
    $gen = $dateDistilate->genre;
    $data_publicarii = $dateDistilate->datePublished;

    $deTrimis = [
        "titlu" => $titlu,
        "recenzie" => $recenzie,
        "gen" => $gen,
        "data_publicarii" => $data_publicarii,
    ];

    echo json_encode($deTrimis);

}
?>