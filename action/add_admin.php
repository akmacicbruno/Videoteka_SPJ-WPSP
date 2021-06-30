<?php
//login.php
include '../connection.php';

$data = json_decode(file_get_contents('php://input'));

$query = $oConnection->prepare("INSERT INTO admins (username, password) VALUES (:username, :pass1)");
$query->execute(array(
    "username" => $data->username,
    "pass1" => $data->pass1
    )
);

?>