<?php
//addmovie.php
include '../connection.php';



$data = json_decode(file_get_contents('php://input'));

$query1 = $oConnection->prepare("INSERT INTO zanr (naziv) VALUES (:zanr_naziv)");
$query1->execute(array(
    "zanr_naziv" => $data->zanr_naziv
    )
);

$last_id = $oConnection->lastInsertId();

$query = $oConnection->prepare("INSERT INTO filmovi (sifra,naziv,opis,gledatelj_id,zanr_id,broj_posudivanja) VALUES (:sifra,:naziv,:opis,:gledatelj_id,:zanr_id,:broj_posudivanja)");
$query->execute(array(
    "sifra" => $data->sifra, 
    "naziv" => $data->naziv, 
    "opis" => $data->opis, 
    "gledatelj_id" => $data->gledatelj_id,
    "zanr_id" => $last_id,
    "broj_posudivanja" => $data->broj_posudivanja
    )
);


?>