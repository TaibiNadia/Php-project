<?php
	session_start();
	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/operation/OperationDataAccess.class.php');	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/categorie/CategorieDataAccess.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/beneficiaire/BeneficiaireDataAccess.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/remise/RemiseDataAccess.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/compte/CompteDataAccess.class.php');
	
	if(isset($_GET['id'])){
		
		$remiseDA = new RemiseDataAccess();
		$operationDA = new OperationDataAccess();
			
		$operation = $operationDA-> findByIdOperation($_GET['id']);
		$valid = 0; // pour voir si la remisse est validée
		
		if(!empty($operation->get_remiseID())){
					
			$remise = $remiseDA->findByIdRemise($operation->get_remiseID());
			$valid = $remise->get_valid();
		}
	}
	if($valid == 1){
		
		header('location:operationListerCl.php?msgErreur= Modification Impossible : operation liee a une remise VALIDEE !');
		exit;
	}
	else
	{	
		$operationDA = new OperationDataAccess();
		$resultOperation = $operationDA->findByIdOperation($_GET['id']);	
		
		if($resultOperation){
			
			$compte = new CompteDataAccess();
			$result = $compte->findByIdCompte($resultOperation->get_compteId());					
			$beneficiaire = new BeneficiaireDataAccess();
			$result = $beneficiaire->findByIDBeneficiaire($result->get_idBeneficiaire());					
			$_SESSION['beneficiaire']=$result->get_nom();
			$_SESSION['resultOperation']=serialize($resultOperation);
		}
		else{
			$_GET['msgErreur']="Aucune operation trouvee !";
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
			header('location:../../views/operation/operationModifier.php?msgErreur='.$msgErreur. ' !!!');
		}
		else{
			header('location:../../views/operation/operationModifier.php');
		
		}
			
	}
	if(isset($_POST['valider']))
		{
			if(!empty($_POST['libelle']) && !empty($_POST['date']) && !empty($_POST['montant'])){
				
				$id = $_POST['id'];			
				$libelle = trim(htmlspecialchars($_POST['libelle']));
				$date = trim(htmlspecialchars($_POST['date']));
				$montant = trim(htmlspecialchars($_POST['montant']));
				$remise = trim(htmlspecialchars($_POST['remise']));
				$compte = trim(htmlspecialchars($_POST['compte']));
					
				if(strlen($libelle)>3 && strlen($libelle)<31){
					if(is_numeric($montant)){
						
						$operation = new Operation($id,$libelle,$date,$montant,$compte);
						$operation->set_remiseId($remise);
						$operationDA = new OperationDataAccess();					
						$retour = $operationDA->updateOperation($operation);
					
						if($retour == true){
							header('location:operationListerCl.php?msgErreur= Modification Reussie !');
						}	
							
						if($retour == false){
							header('location:../../views/operation/OperationModifier.php?msgErreur= Modification Echouee!');
						}	
						
					}		
					else {
						header('location:../../views/operation/OperationModifier.php?msgErreur=le champ montant doit etre numerique!');
					}				
				}
				else{
					header('location:../../views/operation/OperationModifier.php?msgErreur="Respectez la taille  des champs!!!');
				}
			}
			else{
				header('location:../../views/operation/OperationModifier.php?msgErreur= Tous les champs avec * sont obligatoires !');
			}
		}
	
?>