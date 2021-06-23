<?php
//rented_movies.php  
include '../connection.php';

$data = json_decode(file_get_contents('php://input'));

$query = $oConnection->prepare("UPDATE filmovi SET gledatelj_id=null WHERE sifra=:sifra");
$query->execute(array(
    "sifra" => $data->sifra
    )
);

$query1 = $oConnection->prepare("UPDATE zapisi SET datum_vracanja=:datum_vracanja WHERE sifra_filma=:sifra");
$query1->execute(array(
    "sifra" => $data->sifra,
    "datum_vracanja" =>$data->datum_vracanja
    )
);
?>