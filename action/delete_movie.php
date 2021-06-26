<?php
//index.php  
include '../connection.php';

$data = json_decode(file_get_contents('php://input'));
$query = $oConnection->prepare("DELETE FROM filmovi WHERE sifra=:sifra");
$query->execute(array(
	"sifra" => $data->sifra
	)
);
$query1 = $oConnection->prepare("DELETE FROM zapisi WHERE sifra_filma=:sifra");
$query1->execute(array(
	"sifra" => $data->sifra
	)
);
?>