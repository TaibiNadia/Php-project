<?php
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/categorie/CategorieDataAccess.class.php');
	
	$categorie = new CategorieDataAccess();
	if($categorie->findByIdCategorie($_GET['id'])){
		$_SESSION['categorie']=serialize($categorie->findByIdCategorie($_GET['id']));
	}
	else{
		$_SESSION['msgError']="Aucune categorie trouvee !! ";
	}
	header('location:../../views/categorie/categorieVoir.php');
	
?>