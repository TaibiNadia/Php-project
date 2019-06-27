<?php
	$servername = "virement";
	$username = "root";
	$password = "";
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname='.$servername, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
        die('Problème de connexion : '.$e->getMessage());
		
	}
?>