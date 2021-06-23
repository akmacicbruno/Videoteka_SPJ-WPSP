<?php
//users.php  
include '../connection.php';

$data = json_decode(file_get_contents('php://input'));
$query = $oConnection->prepare("DELETE FROM gledatelj WHERE gledatelj_id=:id");
$query->execute(array(
	"id" => $data->gledatelj_id
	)
);
?>