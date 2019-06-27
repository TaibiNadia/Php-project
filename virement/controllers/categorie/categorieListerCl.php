<?php
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/categorie/CategorieDataAccess.class.php');

	$categories = new CategorieDataAccess();
	$result = $categories->findAllCategorie();
	if($result){
		$_SESSION['categories']=serialize($result);
	}
	else{
		$_GET['msgErreur']="Aucune Categorie trouvee !";
	}	
	if(isset($_GET['msgErreur'])){
		$msgErreur=$_GET['msgErreur'];
		header('location:../../views/categorie/categorieLister.php?msgErreur='.$msgErreur. ' !!!');
	}
	else{
		header('location:../../views/categorie/categorieLister.php');
	}	
?>