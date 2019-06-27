<?php

require($_SERVER['DOCUMENT_ROOT'].'/virement/models/compte/Compte.class.php'); 

 class CompteDataAccess{
	function __construct() {

    }
	function findAllCompte(){
		require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		
		$requete = $bdd->prepare('select * from compte'); //prepare la requete
		$requete->execute() or die(print_r($requete->errorInfo()));
		$result=$requete->fetchall(PDO::FETCH_ASSOC);
			// fetchall(PDO::FETCH_ASSOC)retourne l'ensemble de données sous forme d'un tableau associatif
								
			if(empty($result))
				return false;
			else{
				foreach($result as $compte)
				{						
					$comptes[$compte['com_id']]=new Compte($compte['com_id'],$compte['com_id_ben'],$compte['com_libelle'],$compte['com_iban']);	
					
				}		
				$bdd=null;
				return $comptes;
			}
		
    }
	function findByBeneficiaire($id){
		require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		
		$requete = $bdd->prepare('select * from compte where com_id_ben=?'); //prepare la requete
		$requete->execute(array($id)) or die(print_r($requete->errorInfo()));
		$result=$requete->fetchall(PDO::FETCH_ASSOC);
			// fetchall(PDO::FETCH_ASSOC)retourne l'ensemble de données sous forme d'un tableau associatif
								
		if(empty($result))
			return false;
		else{
			foreach($result as $compte)
			{						
				$comptes[$compte['com_id']]=new Compte($compte['com_id'],$compte['com_id_ben'],$compte['com_libelle'],$compte['com_iban']);	
			}		
			$bdd=null;
			return $comptes;
		}		
    }
	
	function findByIdCompte($id){
	     require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		 $requete = $bdd->prepare('select * from compte where com_id=?'); //prepare la requete
			$requete->execute(array($id)) or die(print_r($requete->errorInfo()));
			$result=$requete->fetchall(PDO::FETCH_ASSOC);
			// fetchall(PDO::FETCH_ASSOC)retourne l'ensemble de données sous forme d'un tableau associatif
								
			if(empty($result))
				return false;
			else
			{ foreach($result as $com)
				{	
					$compte =new Compte($com['com_id'],$com['com_id_ben'],$com['com_libelle'],$com['com_iban']);
				}				
				return $compte;
			}
          $bdd=null;			
    }
	function updateCompte(Compte $compte){
		require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		$sql =	'update compte
					set 	
							com_libelle=?,
							com_iban=?
									
					where com_id= ?	';
		$requete=$bdd->prepare($sql);
		if($requete->execute(array(	
									$compte->get_libelle(),
									$compte->get_iban(),
									$compte->get_id()
														)))
			{
				$bdd=null;	
				return true; 
			}
			else{
				$bdd=null;	
				return false; 
			}
					
	}
	function insertCompte(Compte $compte){
		
		    require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
			$sql='insert into compte (com_id,com_libelle,com_iban,com_id_ben) 
						values (?,?,?,?)';			
				$requete=$bdd->prepare($sql);	
			  if ($requete->execute(array( 
											null,
											$compte->get_libelle(),
											$compte->get_iban(),
											$compte->get_idBeneficiaire(),
			                             )))
										return true;
										//return "Creation s est deroulee avec succes" ;
			  else
			  {	
				  return false;
				  //return "Creation echouee !!!";
			   $bdd=null;	
		}
	}

	function deleteCompte(Compte $compte){
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		$requete = $bdd->prepare('delete from compte where com_id=?'); //prepare la requete 
		$result = $requete->execute(array($compte->get_id()));
		echo $result;
		if ( !$result ) {
			$bdd=null;
            echo 'Erreur de suppression';
		    return false;
		} else {
           $bdd=null;
		   return true;
	      }
	
	} 
	function compteHasOperation(Compte $compte){
	    require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		$requete = $bdd->prepare('select count(*) as count from operation,compte where operation.ope_id_com=compte.com_id and compte.com_id=?'); 	
		$requete->execute(array($compte->get_id())) or die(print_r($requete->errorInfo()));
		$result=$requete->fetchall(PDO::FETCH_ASSOC);
		$nOperation=0;	
		if(!empty($result)){
				foreach($result as $res){
				    $nOperation=$res['count'];
					
			    }
			}
		$bdd=null;	
		return $nOperation;
	}
	
	
    }

?>

<?php
/* 
	echo "</br>Je suis le la classe CategorieDataAccess.php</br>";
	$catd = new CompteDataAccess();
	$cat = new Compte('111','123','toto','12312312312312312222');
	
	if($catd->deleteCompte(100)){
		echo "ok";
	}
	else{
		echo "pas ok";
	}
*/	
?>



