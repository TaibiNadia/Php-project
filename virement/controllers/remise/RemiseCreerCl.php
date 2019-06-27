<?php
	session_start();
	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/remise/RemiseDataAccess.class.php');	
	
	if(isset($_POST['valider'])){
		
		if(!empty($_POST['libelle']) && !empty($_POST['date'])){
			
			$id ='1';
			$libelle = trim(htmlspecialchars($_POST['libelle']));
			$date = trim(htmlspecialchars($_POST['date']));
			$motif = trim(htmlspecialchars($_POST['motif']));
			$valid = 0;
			if(!empty($_POST['motif']))
				$motif = trim(htmlspecialchars($_POST['motif']));
			else 
				$motif ='';
					
			if(strlen($libelle)>3 && strlen($libelle)<31 && strlen($motif)<300){
				
				$remise = new Remise($id,$libelle,$date,$motif,$valid);
				$remiseDA = new RemiseDataAccess();
				$retour = $remiseDA->insertRemise($remise);
			
				if($retour == true){
					header('location:remiseListerCl.php?msgErreur='.$retour. ' !!!');
				}	
					
				if($retour == false){
					header('location:../../views/remise/remiseCreer.php?msgErreur='.$retour. ' !!!');
				}	
				if($retour != true && $retour != false){
					header('location:../../views/remise/remiseCreer.php?msgErreur='.$retour. ' !!!');
				}
			}
			else{
				header('location:../../views/remise/remiseCreer.php?msgErreur="Respectez la taille  des champs!!!');
			}
		}
		else{
			header('location:../../views/remise/remiseCreer.php?msgErreur="Remplissez tout les champ !!!');
		}
	}
	else{
		header('location:../../views/remise/remiseCreer.php');
	}	
	
	
?>