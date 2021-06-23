<?php
//index.php  
include '../connection.php';

$data = json_decode(file_get_contents('php://input'));
$query = $oConnection->prepare("DELETE FROM filmovi WHERE sifra=:sifra");
$query->execute(array(
	"sifra" => $data->sifra
	)
);
?>