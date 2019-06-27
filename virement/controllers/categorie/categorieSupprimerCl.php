<?php
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/categorie/CategorieDataAccess.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/beneficiaire/BeneficiaireDataAccess.class.php');
	
	$categorie = new CategorieDataAccess();
	$categorieDA = new CategorieDataAccess();
	
	
	if(isset($_POST['valider'])){
		
		$id = $_POST['id'];
		$libelle = $_POST['libelle'];	
		$categorie = new Categorie($id,$libelle);
		if($categorieDA->deleteCategorie($categorie)){
				$msgErreur = "Suppression reussie";		
		}
		else{
			$msgErreur = "Suppression echouee !";	
		}
		header('location:categorieListerCl.php?msgErreur='.$msgErreur.' !!!');
	}
	else{
		$categorie = $categorie->findByIdCategorie($_GET['id']);
		
		if($categorie){
			
			$beneficiaireDA = new BeneficiaireDataAccess();
			if(!$beneficiaire = $beneficiaireDA->findByCat($categorie->get_id())){
				
				$_SESSION['categorie']=serialize($categorie);
				header('location:../../views/categorie/categorieSupprimer.php');
			}
			else{
				echo "Impossible de supprimer";
				header('location:categorieListerCl.php?msgErreur=Impossible de supprimer la categorie  ! Supprimer d abord les benificiaires lies a cette categorie !');
			}			
		}
		else{
			$_SESSION['msgError']="Aucune categorie trouvee !! ";
			header('location:categorieListerCl.php?msgErreur=Aucune categorie trouvee !');
		}
		
	}
?>