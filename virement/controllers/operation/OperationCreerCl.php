<?php
	session_start();
	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/operation/OperationDataAccess.class.php');	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/categorie/CategorieDataAccess.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/beneficiaire/BeneficiaireDataAccess.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/remise/RemiseDataAccess.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/compte/CompteDataAccess.class.php');
	
	if(isset($_POST['valider'])){
		
		if(!empty($_POST['beneficiaire']) &&  !empty($_POST['compte']) && !empty($_POST['libelle']) && !empty($_POST['date']) && !empty($_POST['montant'])){
			
			$id = "1";
			$compte = trim(htmlspecialchars($_POST['compte']));
			$libelle = trim(htmlspecialchars($_POST['libelle']));
			$date = trim(htmlspecialchars($_POST['date']));
			$montant = trim(htmlspecialchars($_POST['montant']));
			$remise = trim(htmlspecialchars($_POST['remise']));
						
			if(strlen($libelle)>3 && strlen($libelle)<31){
				if(is_numeric($montant)){
					
					$operation = new Operation($id,$libelle,$date,$montant,$compte);
					$operation->set_remiseId($remise);
					$operationDA = new OperationDataAccess();
					$retour = $operationDA->insertOperation($operation);
				
					if($retour == true){
						header('location:operationListerCl.php?msgErreur= Creation Reussie !');
					}	
						
					if($retour == false){
						header('location:../../views/operation/operationCreer.php?msgErreur= Creation Echouee!');
					}	
					
				}		
				else {
					header('location:../../views/operation/operationCreer.php?msgErreur=le champ montant doit etre numerique!');
				}				
			}
			else{
				header('location:../../views/operation/operationCreer.php?msgErreur="Respectez la taille  des champs!!!');
			}
		}
		else{
			header('location:../../views/operation/operationCreer.php?msgErreur= Tous les champs avec * sont obligatoires !');
		}
	}
	else{
		if(isset($_POST['filtre'])){
			
			$beneficiaire = new BeneficiaireDataAccess();
			$result = $beneficiaire->findByCat($_POST['categorie']);
			 if($result){
				$_SESSION['beneficiaires']=serialize($result);
				$_SESSION['categSelected']=$_POST['categorie'];
			}
			else{
				$_GET['msgErreur']="Aucune Categorie trouvee !";
			}
			if(isset($_GET['msgErreur'])){
				$msgErreur=$_GET['msgErreur'];
				header('location:../../views/operation/operationCreer.php?msgErreur='.$msgErreur. ' !!!');
			}
			else{
				header('location:../../views/operation/operationCreer.php');
			}
		}
		else
		{
			if(isset($_POST['compte']))
			{				
				$compte = new CompteDataAccess();
				//echo "ooooooooooooooooooooooooooooooooooooooooo".$_POST['beneficiaire'];
		
				$result = $compte->findByBeneficiaire($_POST['beneficiaire']);
				 if($result){
					$_SESSION['comptes']=serialize($result);
					$_SESSION['categSelected']=$_POST['categorie'];
					$_SESSION['benefSelected']=$_POST['beneficiaire'];
				}
				else{
					$_GET['msgErreur']="Aucune compte trouvee !";
				}
				if(isset($_GET['msgErreur'])){
					$msgErreur=$_GET['msgErreur'];
					header('location:../../views/operation/operationCreer.php?msgErreur='.$msgErreur. ' !!!');
				}
				else{
					header('location:../../views/operation/operationCreer.php');
				}
			}
			else{
				if(isset($_SESSION['categSelected'])){
					unset($_SESSION['categSelected']);
				}
				if(isset($_SESSION['beneficiaires'])){
					unset($_SESSION['beneficiaires']);
				}
				if(isset($_SESSION['benefSelected'])){
					unset($_SESSION['benefSelected']);
				}
				
				$categories = new CategorieDataAccess();
				$remises = new RemiseDataAccess();
				
				$resultRemise = $remises->findAllRemiseNonValid();
				if($resultRemise){
					$_SESSION['remises']=serialize($resultRemise);
				}
				else{
					$_GET['msgErreur']="Aucune Remise trouvee !";
				}			
				
				$result = $categories->findAllCategorie();
				if($result){
					$_SESSION['categories']=serialize($result);
				}
				else{
					$_GET['msgErreur']=$_GET['msgErreur']." Aucune Categorie trouvee !";
				}
				
				if(isset($_GET['msgErreur'])){
					$msgErreur=$_GET['msgErreur'];
					header('location:../../views/operation/operationCreer.php?msgErreur='.$msgErreur. ' !!!');
				}
				else{
					header('location:../../views/operation/operationCreer.php');
				}
			}
		}
	}	
	
	
?>