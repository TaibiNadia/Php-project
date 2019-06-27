<?php
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/operation/OperationDataAccess.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/remise/RemiseDataAccess.class.php');
	
	
	
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
		
		header('location:operationListerCl.php?msgErreur= Suppression Impossible : operation liee a une remise VALIDEE !');
		exit;
	}
	else{
		
		$operation = new OperationDataAccess();
		$operationDA = new OperationDataAccess();
		
		if($operation->findByIdOperation($_GET['id'])){
			$_SESSION['operation']=serialize($operation->findByIdOperation($_GET['id']));
		}
		else{
			$_SESSION['msgError']="Aucune operation trouvee !! ";
		}
		header('location:../../views/operation/operationSupprimer.php');
	
	}	
	if(isset($_POST['valider'])){
		
		$id = $_POST['id'];
		$libelle = $_POST['libelle'];
		$date = $_POST['date'];
		$montant = $_POST['montant'];		
		$compteId = $_POST['compteId'];
		$remiseId = $_POST['remiseId'];
		
		$operation = new Operation($id,$libelle,$date,$montant,$compteId);
		if(!empty($remiseId)){		
			
			$remiseDA = new RemiseDataAccess();
			//var_dump($remiseDA->findByIdRemise($remiseId));
			echo $remiseDA->findByIdRemise($remiseId)->get_valid();
		
			if($remiseDA->findByIdRemise($remiseId)->get_valid()==1){
				$msgErreur = "Suppression INTERDITE : operation rattachee a une remise validee !";
				header('location:operationListerCl.php?msgErreur='.$msgErreur.' !!!');
			}
			else{
				if($operationDA->deleteOperation($operation)){
					$msgErreur = "Suppression reussie";		
				}
				else{
					$msgErreur = "Suppression echouee !";	
				}
				header('location:operationListerCl.php?msgErreur='.$msgErreur.' !!!');
			}
		}
		else{	
			if($operationDA->deleteOperation($operation)){
					$msgErreur = "Suppression reussie";		
			}
			else{
				$msgErreur = "Suppression echouee !";	
			}
			header('location:operationListerCl.php?msgErreur='.$msgErreur.' !!!');
		}
	}
	
?>