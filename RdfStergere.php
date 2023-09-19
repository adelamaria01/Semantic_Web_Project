<?php
require 'vendor/autoload.php';

$data = json_decode(file_get_contents('php://input'), true);
$trupa = $data['trupa'];

$client = new EasyRdf\Sparql\Client("http://localhost:8080/rdf4j-server/repositories/grafexamen/statements");

$interogare = "PREFIX : <http://proiect.ro#> DELETE WHERE {GRAPH :grafexamen {:${trupa} ?p ?o}}";

print_r($interogare);

$client->update($interogare);
?>