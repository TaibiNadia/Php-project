<?php
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/beneficiaire/BeneficiaireDataAccess.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/categorie/categorieDataAccess.class.php');
    $beneficiaire = new BeneficiaireDataAccess();
	$beneficiaireDA = new BeneficiaireDataAccess();
	
	if(isset($_POST['valider'])) 
	{
		
		if(!empty($_POST['nom']) &&  !empty($_POST['ics']) && !empty($_POST['categorie'])){
		    $id = trim(htmlspecialchars($_POST['id']));
		    $nom = trim(htmlspecialchars($_POST['nom']));
		    $siret = trim(htmlspecialchars($_POST['siret']));			
		    $ics = trim(htmlspecialchars($_POST['ics']));
		    $categorie = trim(htmlspecialchars($_POST['categorie']));
			
		    if(strlen($nom)>2 && strlen($ics)==15 && strlen($categorie)==3 ){
				if(empty($siret) || strlen($siret) == 14){
					
					$beneficiaire=new beneficiaire($id,$nom,$siret,$ics,$categorie);
					if($beneficiaireDA->updateBeneficiaire($beneficiaire)){
					   header('location:beneficiaireListerCl.php?msgErreur=Modification reussie!!!');
					}
					else{
						header('location:beneficiaireListerCl.php?msgErreur=Modification echouee!!!');
					} 
					header('location:beneficiaireListerCl.php?msgErreur=Modification reussie!!!');				
				}
				else{
					 header('location:../../views/beneficiaire/beneficiaireModifier.php?msgErreur="La taille de siret est invalide !');
				}				
			} 
			else{
			   header('location:../../views/beneficiaire/beneficiaireModifier.php?msgErreur="Respectez la taille des champs  !');
		   }
		
		}
		else{
			header('location:../../views/beneficiaire/beneficiaireModifier.php?msgErreur="Remplissez tous les champs !');
		}
		
	} else {
		if($beneficiaire->findByIdBeneficiaire($_GET['id'])){
			$_SESSION['beneficiaire']=serialize($beneficiaireDA->findByIdBeneficiaire($_GET['id']));
			$categorieDA =new CategorieDataAccess();
			$result=$categorieDA->findAllCategorie();
			if($result){
	          $_SESSION['categories']=serialize($result);	
	        }else {
	            $_GET['msgErreur']="Aucune categorie trouvee !";	
	        }
	}
		else{
			$_SESSION['msgErreur']="Aucune categorie trouvee !! ";
		}
		header('location:../../views/beneficiaire/beneficiaireModifier.php');
	} 	
?>