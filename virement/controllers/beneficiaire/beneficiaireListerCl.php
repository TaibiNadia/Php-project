<?php
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/beneficiaire/BeneficiaireDataAccess.class.php');
 	
	$beneficiaireDA = new BeneficiaireDataAccess();
	
	$result = $beneficiaireDA->findAllBeneficiaire();
	if($result){
	   $_SESSION['beneficiaires']=serialize($result);	
	}else {
	    $_GET['msgErreur']="Aucun Beneficiaire trouve !";	
	}
	
	if(isset($_GET[msgErreur])){
		$msgErreur=$_GET[msgErreur];
		header('location:../../views/beneficiaire/beneficiaireLister.php?msgErreur='.$msgErreur);
	} else {
	     header('location:../../views/beneficiaire/beneficiaireLister.php');
	}
?>