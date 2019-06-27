<?php
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/compte/CompteDataAccess.class.php');
    //echo $_SERVER['DOCUMENT_ROOT'];
	//	echo "contr  ";
	echo"Je suis dans le controlleur....";
	$compteDA = new CompteDataAccess();
	
	if(!isset($_POST['valider'])) {
		$_SESSION['compte']=serialize($compteDA->findByIdCompte($_GET['id']));	
		header('location:../../views/compte/compteModifier.php');
	} else { 
		if(!empty($_POST['libelle'])&&  !empty($_POST['iban'])){
		  $libelle = trim(htmlspecialchars($_POST['libelle']));
		  $iban = trim(htmlspecialchars($_POST['iban']));
		  if(strlen($libelle)>2 && strlen($libelle)<31 && strlen($iban)>14 && strlen($iban)<34 ){  
		    $compte=new Compte($_POST['id'],$_POST['idBeneficiaire'],$_POST['libelle'],$_POST['iban']);
	        if($compteDA->updateCompte($compte)){
				header('location:compteListerCl.php?msgErreur=Modification reussie!!!');
				}
				else{
					header('location:compteListerCl.php?msgErreur=Modification echouee!!!');
				}	
		    }
			else{
				header('location:../../views/compte/compteModifier.php?msgErreur="Respectez la taille des champs  !!!');
			}
		}
		else{
			header('location:../../views/compte/compteModifier.php?msgErreur="Remplissez tous les champs !!!');
		}
	    //header('location:../../controllers/compte/compteListerCl.php');
	} 	
?>