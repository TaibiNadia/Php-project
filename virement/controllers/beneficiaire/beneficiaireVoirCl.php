<?php
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/beneficiaire/BeneficiaireDataAccess.class.php');
    	
	$beneficiaireDA = new BeneficiaireDataAccess();
	$_SESSION['beneficiaire']=serialize($beneficiaireDA->findByIdBeneficiaire($_GET['id']));	
	//echo $_SESSION['beneficiaire'];
	header('location:../../views/beneficiaire/beneficiaireVoir.php');
	
?>