<?php
//adduser.php
include '../connection.php';

$data = json_decode(file_get_contents('php://input'));
$query = $oConnection->prepare("INSERT INTO gledatelj (gledatelj_id,ime,prezime,kolicina_posudivanja) VALUES (:id,:ime,:prezime,:kolicina_posudivanja)");
$query->execute(array(
    "id" => $data->gledatelj_id, 
    "ime" => $data->ime, 
    "prezime" => $data->prezime, 
    "kolicina_posudivanja" => $data->kolicina_posudivanja
    )
);

?>