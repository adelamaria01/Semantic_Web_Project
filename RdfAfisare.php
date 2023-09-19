<?php
require 'vendor/autoload.php';

$client = new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/grafexamen");

$interogare = " PREFIX : <http://proiect.ro#> PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
    SELECT ?nume ?vanzari
    WHERE {
        ?s rdfs:label ?nume.
        ?s :areVanzari ?vanzari.
    }";

$rezultate = $client->query($interogare);

$deTrimis = [];
foreach ($rezultate as $elemente) {
    $deTrimis[] = [
        'trupa' => $elemente->nume->getValue(),
        'vanzari' => $elemente->vanzari->getValue()
    ];
}

echo json_encode($deTrimis);
?>