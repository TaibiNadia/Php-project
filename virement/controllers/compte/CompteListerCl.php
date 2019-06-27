<?php
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/compte/CompteDataAccess.class.php');
    //echo $_SERVER['DOCUMENT_ROOT'];
	$compteDA = new CompteDataAccess();
	$_SESSION['comptes']=serialize($compteDA->findAllCompte());	
	
	if(isset($_GET['msgErreur'])){
		header('location:../../views/compte/compteLister.php?msgErreur='.$_GET['msgErreur']);
		
	}
	else{
		
		header('location:../../views/compte/compteLister.php');
		
	}
	
	
?>