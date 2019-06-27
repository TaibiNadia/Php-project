<?php
	session_start();
	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/remise/RemiseDataAccess.class.php');
	
	$remiseDA = new RemiseDataAccess();
	
	if(isset($_GET['id'])){		
		$retour = $remiseDA->findByIdRemise($_GET['id']);
		if($retour){
			
			if($retour->get_valid() == 1){
				header('location:../../controllers/remise/remiseListerCl.php?msgErreur="Impossible de supprimer une Remise VALIDEE !');
			}
			else{
				$_SESSION['remise']=serialize($retour);	
				header('location:../../views/remise/remiseSupprimer.php');
			}
		}
		else{
			header('location:../../controllers/remise/remiseListerCl.php?msgErreur="Remise INTROUVABLE !');
		}
	}
	
	if(isset($_POST['valider'])){
		
		$id = $_POST['id'];
		$libelle = $_POST['libelle'];
		$date = $_POST['date'];
		$motif = $_POST['motif'];
		$valid = $_POST['valid'];
		
		$remise = new Remise($id,$libelle,$date,$motif,$valid);
		
		if($remiseDA->deleteRemise($remise)){
				$msgErreur = "Suppression reussie";		
		}
		else{
			$msgErreur = "Suppression echouee !";	
		}
		header('location:remiseListerCl.php?msgErreur='.$msgErreur.' !!!');
		
	}
?>