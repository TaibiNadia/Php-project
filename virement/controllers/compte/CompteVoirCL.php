<?php
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/compte/CompteDataAccess.class.php');
	
	$compte = new CompteDataAccess();
	if($compte->findByIdCompte($_GET['id'])){
		$_SESSION['compte']=serialize($compte->findByIdCompte($_GET['id']));
	}
	else{
		$_SESSION['msgError']="Aucun compte trouve !! ";
	}
		
	header('location:../../views/compte/compteVoir.php');
	
?>