<?php
//index.php  
include '../connection.php';

$data = json_decode(file_get_contents('php://input'));
$query = $oConnection->prepare("UPDATE filmovi SET naziv=:naziv, opis=:opis WHERE sifra=:sifra");
$query->execute(array(
    "sifra" => $data->sifra, 
    "naziv" => $data->naziv, 
    "opis" => $data->opis
    )
);
?>