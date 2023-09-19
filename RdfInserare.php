<?php
require 'vendor/autoload.php';

$client = new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/grafexamen/statements");

$datePrimite = json_decode(file_get_contents('php://input'), true);

$interogare = "PREFIX : <http://proiect.ro#> PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#> INSERT DATA { GRAPH :grafexamen {";

foreach ($datePrimite as $index => $element) {
    $trupa = str_replace(' ', '', $element['trupa']);
    $vanzari = $element['vanzari'];

    $interogare .= " :" . $trupa . " :areVanzari " . $vanzari . "; rdfs:label" . ' "' . $element['trupa'] . '".';
}

$interogare .= " } }";
print_r($interogare);
$client->update($interogare);

?>