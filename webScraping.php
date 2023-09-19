<?php

require "vendor/autoload.php";
$client = new \GuzzleHttp\Client(['verify' => false]);
$cerere = $client->getAsync("https://en.wikipedia.org/wiki/List_of_highest-certified_music_artists_in_the_United_States");
$cerere->then("procesareRaspuns")->wait();

function procesareRaspuns($raspuns)
{
    $raspunsHTTP = $raspuns->getBody();
    libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    $doc->loadHTML($raspunsHTTP);
    $docInterogabil = new DOMXPath($doc);
    $elemente = $docInterogabil->query('//tbody/tr');

    $i = 0;
    $deTrimis = array();

    foreach ($elemente as $element) {

        if ($i > 3) {
            break;
        }
        $date_tabel = $element->getElementsByTagName('td');
        $numeTrupa = trim($date_tabel[2]->nodeValue ?? '');
        $vanzari = trim($date_tabel[1]->nodeValue ?? '');

        if (!empty($numeTrupa) && !empty($vanzari)) {
            $deTrimis[] = array(
                'trupa' => $numeTrupa,
                'vanzari' => $vanzari
            );
        }
        $i++;
    }
    echo json_encode($deTrimis);

}


?>