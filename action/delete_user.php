<?php
//users.php  
include '../connection.php';

$data = json_decode(file_get_contents('php://input'));

$id = $data->gledatelj_id;
//echo $id;

$select_query = $oConnection->prepare("SELECT DISTINCT gledatelj_id FROM filmovi WHERE gledatelj_id IS NOT NULL");
$select_query->execute();
$result = $select_query->fetchAll(PDO::FETCH_BOTH);
$broj = count($result);

$pronaden = 0;

for ($i = 0; $i < $broj; $i++)
{
	if ($id == $result[$i]['gledatelj_id'])
	{  
		echo "Korisnik ima posuđen film!";
		$pronaden = 1;
	}
}

if ($pronaden != 1)
{
	$query = $oConnection->prepare("DELETE FROM gledatelj WHERE gledatelj_id=:id");
	$query->execute(array(
		"id" => $data->gledatelj_id
		)
	);
	
	$query1 = $oConnection->prepare("DELETE FROM zapisi WHERE korisnik_id=:id");
	$query1->execute(array(
		"id" => $data->gledatelj_id
		)
	);
	echo "Uspješno obrisan korisnik!";
}
?>