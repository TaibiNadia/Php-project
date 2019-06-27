<?php
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/compte/CompteDataAccess.class.php');
	//echo $_SERVER['DOCUMENT_ROOT'];
	//	echo "contr  ";
	//echo"Je suis dans le controlleur....";
	$compte = new CompteDataAccess();
	$compteDA = new CompteDataAccess();
	
	if(isset($_POST['valider'])) {
	   $id = $_POST['id'];
	   $idBeneficiaire = $_POST['idBeneficiaire'];
	   $libelle = $_POST['libelle'];
       $iban = $_POST['iban'];	
		$compte = new Compte($id,$idBeneficiaire,$libelle,$iban);
		//var_dump ($compte);
		$res = $compteDA->compteHasOperation($compte);
		
		if($res > 0){
		   $msgErreur = "Supprimer les operations de ce compte avant de le supprimer !!!";   
		   header('location:compteListerCl.php?msgErreur='.$msgErreur.' !!!');
		   unset($msgErreur); 
		}else {
			if($compteDA->deleteCompte($compte)){
				$msgErreur = "Suppression reussie";		
		    }
		    else{
			$msgErreur = "Suppression echouee !";	
		    }
			header('location:../../controllers/compte/compteListerCl.php?msgErreur='.$msgErreur.' !!!');
		}
	}
	else{
		
		if($compte->findByIdCompte($_GET['id'])){
			$_SESSION['compte']=serialize($compte->findByIdCompte($_GET['id']));
		}
		else{
			$_SESSION['msgError']="Aucune compte trouvee !! ";
		}
		header('location:../../views/compte/compteSupprimer.php');
	}
?>