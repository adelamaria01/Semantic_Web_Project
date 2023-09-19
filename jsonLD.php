<?php
require 'vendor/autoload.php';

$client = new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/grafexamen");


$interogare = "PREFIX : <http://proiect.ro#> PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#> CONSTRUCT WHERE {?s rdfs:label ?label; :areVanzari ?vanzari.}";

$subgraf = $client->query($interogare);

echo $subgraf->serialise("jsonld");
?>