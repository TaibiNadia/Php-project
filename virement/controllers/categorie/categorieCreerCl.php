<?php
	session_start();
	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/categorie/CategorieDataAccess.class.php');	
	
	if(isset($_POST['valider'])){
		
		if(!empty($_POST['id']) && !empty($_POST['libelle'])){
			
			$id = trim(htmlspecialchars($_POST['id']));
			$libelle = trim(htmlspecialchars($_POST['libelle']));
			
			if(strlen($id)==3 && strlen($libelle)>3 && strlen($libelle)<31){
				$categorie = new Categorie($id,$libelle);
				$categorieDA = new CategorieDataAccess();
				$retour = $categorieDA->insertCategorie($categorie);
			
				if($retour == true){
					header('location:categorieListerCl.php?msgErreur='.$retour. ' !!!');
				}
				if($retour == false){
					header('location:../../views/categorie/categorieCreer.php?msgErreur='.$retour. ' !!!');
				}	
				if($retour != true && $retour != false){
					header('location:../../views/categorie/categorieCreer.php?msgErreur='.$retour. ' !!!');
				}
			}
			else{
				header('location:../../views/categorie/categorieCreer.php?msgErreur="Respectez la taille  des champs!!!');
			}
		}
		else{
			header('location:../../views/categorie/categorieCreer.php?msgErreur="Remplissez tout les champ !!!');
		}
	}
	else{
		header('location:../../views/categorie/categorieCreer.php');
	}	
?>