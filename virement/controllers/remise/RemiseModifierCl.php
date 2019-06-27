<?php
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/remise/RemiseDataAccess.class.php');
	
	$remise = new RemiseDataAccess();
	$remiseDA = new RemiseDataAccess();
	if(isset($_GET['id'])){		
		$retour = $remiseDA->findByIdRemise($_GET['id']);
		if($retour){
			
			if($retour->get_valid() == 1){
				header('location:../../controllers/remise/remiseListerCl.php?msgErreur="Impossible de supprimer une Remise VALIDEE !');
			}
			else{
				$_SESSION['remise']=serialize($retour);	
				header('location:../../views/remise/remiseModifier.php');
			}
		}
		else{
			header('location:../../controllers/remise/remiseListerCl.php?msgErreur="Remise INTROUVABLE !');
		}
	}
	if(isset($_POST['valider'])){
		
		if(!empty($_POST['libelle'])){						
			
			$id = $_POST['id'];
			$libelle = trim(htmlspecialchars($_POST['libelle']));
			$date = $_POST['date'];
			$motif = trim(htmlspecialchars($_POST['motif']));
			$valid = $_POST['valid'];
			
			if(strlen($libelle)>3 && strlen($libelle)<31){
				$remise = new Remise($id,$libelle,$date,$motif,$valid);
				var_dump($remise);
				$remiseDA = new RemiseDataAccess();
				
				if($remiseDA->updateRemise($remise)){
					$msgErreur = "Modification reussie";
				}
				else{
					$msgErreur = "Modification echouee";
				}
				header('location:remiseListerCl.php?msgErreur='.$msgErreur);
			}
			else{
				header('location:../../views/remise/remiseModifier.php?msgErreur="Respectez la taille  des champs  !!!');
			}
		}
		else{
			header('location:../../views/remise/remiseModifier.php?msgErreur="Remplissez tout les champs !!!');
		}
	}
	
?>

