<?php
include 'classes.php';
$oConfig = new Configuration();
try
	{
	 $oConnection = new PDO("mysql:host=$oConfig->host; dbname=$oConfig->dbName; charset=utf8", $oConfig->username, $oConfig->password);
	 $oConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 //echo "Connected to $oConfig->dbName at $oConfig->host successfully."."</br>";
	}
catch (PDOException $pe)
	{
		$message = $error->getMessage();
	}
?>