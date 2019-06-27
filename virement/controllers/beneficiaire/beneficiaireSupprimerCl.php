<?php
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/beneficiaire/BeneficiaireDataAccess.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/categorie/categorieDataAccess.class.php');
    //echo $_SERVER['DOCUMENT_ROOT'];
	//	echo "contr  ";
	echo"Je suis dans le controlleur....";
	$beneficiaireDA = new BeneficiaireDataAccess();
	
	if(!isset($_POST['valider'])) {
		if($beneficiaireDA->findByIdBeneficiaire($_GET['id'])){
			$_SESSION['beneficiaire']=serialize($beneficiaireDA->findByIdBeneficiaire($_GET['id']));
			$categorieDA =new CategorieDataAccess();
			$result=$categorieDA->findAllCategorie();
			if($result){
	          $_SESSION['categories']=serialize($result);	
	        }else {
	            $_GET['msgErreur']="Aucune categorie trouvee !";	
	        }

		}
		else{
			$_SESSION['msgError']="Aucun beneficiaire trouve !! ";
		}
		header('location:../../views/beneficiaire/beneficiaireSupprimer.php');	
	
	} else {
		$res=$beneficiaireDA->beneficiaireHasCompte($_POST['id']);
		if ($beneficiaireDA->beneficiaireHasCompte($_POST['id']) > 0){
			$msgErreur = "Supprimer les comptes de ce beneficiaire avant de le supprimer !!!";
			echo $msgErreur;
			header('location:../../controllers/beneficiaire/beneficiaireListerCl.php?msgErreur='.$msgErreur.' !!!');	
            unset($msgErreur);			
	    } 
	    else{
			echo"aucun compte!!!!!!";
			if($beneficiaireDA->deleteBeneficiaire($_POST['id'])){
		    header('location:../../controllers/beneficiaire/beneficiaireListerCl.php?msgErreur=Suppression reussie');
	     	}
		    else{
			   header('location:../../controllers/beneficiaire/beneficiaireListerCl.php?msgErreur=Suppression echouee !');
		    }
			
		}
	
	}
?>