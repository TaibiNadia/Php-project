<?php
	session_start();	
	echo "jesuis dans controller creer ";
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/compte/CompteDataAccess.class.php');	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/beneficiaire/BeneficiaireDataAccess.class.php');
	$beneficiaireDA = new BeneficiaireDataAccess();
	
	if(isset($_POST['valider'])){
		if(!empty($_POST['libelle'])&& !empty($_POST['idBeneficiaire'])&& !empty($_POST['iban'])){
			
			//$id = trim(htmlspecialchars($_POST['id']));
			$id='';
			$idBeneficiaire = trim(htmlspecialchars($_POST['idBeneficiaire']));
			$libelle = trim(htmlspecialchars($_POST['libelle']));
			$iban = trim(htmlspecialchars($_POST['iban']));

			if(strlen($libelle)>4 && strlen($libelle)<31 && strlen($iban)>14 && strlen($iban)<34 && strlen($idBeneficiaire)==3){
				$compte = new Compte($id,$idBeneficiaire,$libelle,$iban);
				$compteDA = new CompteDataAccess();
				$retour = $compteDA->insertCompte($compte);
				if($retour == true){
					
					header('location:compteListerCl.php?msgErreur=Creation reussie!!!');
				}	
					
				if($retour == false){
					header('location:../../views/compte/compteCreer.php?msgErreur=Creation echouee !!!');
				}	
				
			}
			else{
				header('location:../../views/compte/compteCreer.php?msgErreur="Respectez la taille  des champs  !!!');
			}
		}
		else{
			header('location:../../views/compte/compteCreer.php?msgErreur="Remplissez tous les champs !!!');
		}
	}
	else{
		$result=$beneficiaireDA->findAllBeneficiaire();
		//var_dump($result);
		if($result){
		   $_SESSION['beneficiaires']=serialize($result);
		   
		  }else {
			$_GET['msgErreur']='Aucun Beneficiaire trouve!!!';
		}
		header('location:../../views/compte/compteCreer.php');
	}	
	
	
?>