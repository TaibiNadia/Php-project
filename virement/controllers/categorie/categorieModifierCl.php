<?php
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/categorie/CategorieDataAccess.class.php');
	
	$categorie = new CategorieDataAccess();
	if(isset($_POST['valider'])){
		
		if(!empty($_POST['libelle'])){						
			
			$id = trim(htmlspecialchars($_POST['id']));
			$libelle = trim(htmlspecialchars($_POST['libelle']));			
			
			if(strlen($libelle)>3 && strlen($libelle)<31){
				$categorie = new Categorie($id,$libelle);
				
				var_dump($categorie);
				$categorieDA = new CategorieDataAccess();
				
				if($categorieDA->updateCategorie($categorie)){
					$msgErreur = "Modification reussie";
				}
				else{
					$msgErreur = "Modification echouee";
				}
				header('location:categorieListerCl.php?msgErreur='.$msgErreur);
			}
			else{
				header('location:../../views/categorie/categorieModifier.php?msgErreur="Respectez la taille  des champs  !!!');
			}
		}
		else{
			header('location:../../views/categorie/categorieModifier.php?msgErreur="Remplissez tout les champs !!!');
		}
	}	
	else{
		if($categorie->findByIdCategorie($_GET['id'])){
			
			$_SESSION['categorie']=serialize($categorie->findByIdCategorie($_GET['id']));
		}
		else{
			$_SESSION['msgErreur']="Aucune categorie trouvee !! ";
		}
		header('location:../../views/categorie/categorieModifier.php');
	}
	
?>

