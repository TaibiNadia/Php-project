<?php
session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/beneficiaire/BeneficiaireDataAccess.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/categorie/categorieDataAccess.class.php');
    //echo $_SERVER['DOCUMENT_ROOT'];
	//	echo "contr  ";
	if(isset($_POST['valider'])){
	    if(!empty($_POST['nom']) && !empty($_POST['ics']) && !empty($_POST['categorie']) ){
		   $id='';
		   $nom = trim(htmlspecialchars($_POST['nom']));
		   $ics = trim(htmlspecialchars($_POST['ics']));
		   $siret = trim(htmlspecialchars($_POST['siret']));
		   $categorie = trim(htmlspecialchars($_POST['categorie']));
		   if(strlen($nom)>2 && strlen($ics)==15 && strlen($categorie)==3){
	           $beneficiaire=new Beneficiaire($id,$nom,$siret,$ics,$categorie); 
	           $beneficiaireDA = new BeneficiaireDataAccess();
    	       $retour = $beneficiaireDA->insertBeneficiaire($beneficiaire);
		   
		       if($retour == true){
					header('location:beneficiaireListerCl.php?msgErreur=Creation reussie !!!');
				}	
					
				if($retour == false){
					header('location:../../views/beneficiaire/beneficiaireCreer.php?msgErreur=Creation echouee !!!');
				} 	
						  
	        }
			else {
		        header('location:../../views/beneficiaire/beneficiaireCreer.php?msgErreur=Respectez la taille  des champs  !!!');
	        }
	    }	
	    else {
		    header('location:../../views/beneficiaire/beneficiaireCreer.php?msgErreur=Remplissez tous les champs obligatoires!!!'); 
	        }
	}	
	else{
		    $categorieDA =new CategorieDataAccess();
			$result=$categorieDA->findAllCategorie();
			if($result){
	          $_SESSION['categories']=serialize($result);	
	        }else {
	            $_GET['msgErreur']="Aucune categorie trouvee !";	
	        }
			
			 header('location:../../views/beneficiaire/beneficiaireCreer.php');
	    } 		
?>