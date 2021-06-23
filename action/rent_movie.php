<?php
//index.php  
include '../connection.php';

$data = json_decode(file_get_contents('php://input'));

$query = $oConnection->prepare("UPDATE filmovi SET gledatelj_id=:gledatelj_id WHERE sifra=:sifra");
$query->execute(array(
    "sifra" => $data->sifra, 
    "gledatelj_id" => $data->gledatelj_id
    )
);

$query1 = $oConnection->prepare("INSERT INTO zapisi (sifra_filma, korisnik_id, datum_posudivanja) VALUES (:sifra,:korisnik_id,:datum_posudivanja)");
$query1->execute(array(
    "sifra" => $data->sifra,
    "korisnik_id" => $data->gledatelj_id,
    "datum_posudivanja" => $data->datum_posudivanja
    )
);

$query2 = $oConnection->prepare("UPDATE gledatelj SET kolicina_posudivanja=kolicina_posudivanja+1 WHERE gledatelj_id=:gledatelj_id");
$query2->execute(array(
    "gledatelj_id" => $data->gledatelj_id
    )
);

$query3 = $oConnection->prepare("UPDATE filmovi SET broj_posudivanja=broj_posudivanja+1 WHERE sifra=:sifra");
$query3->execute(array(
    "sifra" => $data->sifra
    )
);
?>