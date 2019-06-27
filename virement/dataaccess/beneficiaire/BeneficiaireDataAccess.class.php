<?php

require($_SERVER['DOCUMENT_ROOT'].'/virement/models/beneficiaire/Beneficiaire.class.php'); 

 class BeneficiaireDataAccess{
	function __construct() {

    }
	function findAllBeneficiaire(){
		require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		
		$requete = $bdd->prepare('select * from beneficiaire'); //prepare la requete
		$requete->execute() or die(print_r($requete->errorInfo()));
		$result=$requete->fetchall(PDO::FETCH_ASSOC);
			// fetchall(PDO::FETCH_ASSOC)retourne l'ensemble de données sous forme d'un tableau associatif
								
			if(empty($result))
				return false;
			else{
				foreach($result as $beneficiaire)
				{						
					$beneficiaires[$beneficiaire['ben_id']]=new Beneficiaire($beneficiaire['ben_id'],$beneficiaire['ben_nom'],$beneficiaire['ben_siret'],$beneficiaire['ben_ics'],$beneficiaire['ben_id_cat']);	
					
				}		
				$bdd=null;
				return $beneficiaires;
			}
		
    }
	function findByCat($categorie){
	     require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		
		$requete = $bdd->prepare('select * from beneficiaire where ben_id_cat=?'); //prepare la requete
		$requete->execute(array($categorie)) or die(print_r($requete->errorInfo()));
		$result=$requete->fetchall(PDO::FETCH_ASSOC);
			// fetchall(PDO::FETCH_ASSOC)retourne l'ensemble de données sous forme d'un tableau associatif
								
			if(empty($result))
				return false;
			else{
				foreach($result as $beneficiaire)
				{						
					$beneficiaires[$beneficiaire['ben_id']]=new Beneficiaire($beneficiaire['ben_id'],$beneficiaire['ben_nom'],$beneficiaire['ben_siret'],$beneficiaire['ben_ics'],$beneficiaire['ben_id_cat']);	
					
				}		
				$bdd=null;
				return $beneficiaires;
			}
    }

	
	function findByIdBeneficiaire($id){
	     require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		 $requete = $bdd->prepare('select * from beneficiaire where ben_id=?'); //prepare la requete
			$requete->execute(array($id)) or die(print_r($requete->errorInfo()));
			$result=$requete->fetchall(PDO::FETCH_ASSOC);
			// fetchall(PDO::FETCH_ASSOC)retourne l'ensemble de données sous forme d'un tableau associatif² ²  
								
			if(empty($result))
				return false;
			else
			{ foreach($result as $ben)
				{	
					$beneficiaire =new Beneficiaire($ben['ben_id'],$ben['ben_nom'],$ben['ben_siret'],$ben['ben_ics'],$ben['ben_id_cat']);
					
				}				
				return $beneficiaire;
			}
          $bdd=null;			
    }
	
	
	
	
	
	
	function beneficiaireHasCompte($id){
	     require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		 	$requete = $bdd->prepare("select count(*) as count from compte where com_id_ben = ?");
			$requete->execute(array($id)) or die(print_r($requete->errorInfo()));
			$result=$requete->fetchall(PDO::FETCH_ASSOC);
			$nCompte=0;	
            if(!empty($result)){
				foreach($result as $res){
				    $nCompte=$res['count'];
					
			    }
			}
		$bdd=null;	
		return $nCompte;
      }
	function updateBeneficiaire($beneficiaire){
		require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		$sql =	'update beneficiaire 
					set 	
							ben_nom=?,
							ben_siret=?,
							ben_ics=?,
							ben_id_cat=?
					where ben_id= ?	';
		$requete=$bdd->prepare($sql);
		if($requete->execute(array(	$beneficiaire->get_nom(),
										$beneficiaire->get_siret(),
										$beneficiaire->get_ics(),
										$beneficiaire->get_idCategorie(),
										$beneficiaire->get_id()
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
	function insertBeneficiaire($beneficiaire){
		
		    require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		    $requete = $bdd->prepare('select * from beneficiaire where ben_id=?'); //prepare la requete 
			$requete->execute(array($beneficiaire->get_id())) or die(print_r($requete->errorInfo()));	// execute la requete			
			$result=$requete->fetch(); // recupere le resultat de la requete
			$requete->closeCursor(); // libere le curseur
			
			if(!empty($result))
			{
				$bdd=null;
				echo 'Creation echouee :  ID EXISTE !!!';
				//return false;
			}	
			else
			{ 
		      $sql='insert into beneficiaire (ben_id,ben_nom,ben_siret,ben_ics,ben_id_cat) 
						values (?,?,?,?,?)';
						
				$requete=$bdd->prepare($sql);	
			  if ($requete->execute(array( 
											$beneficiaire->get_id(),
											$beneficiaire->get_nom(),
											$beneficiaire->get_siret(),
											$beneficiaire->get_ics(),
											$beneficiaire->get_idCategorie()
			                             )))
										{ 
										return true;
										}
			  else	{
				  return false;
			  } 
				
			   $bdd=null;	
			}
	}
	
	function deleteBeneficiaire($id){
		require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		$requete = $bdd->prepare('delete from beneficiaire where ben_id=?'); //prepare la requete 
		$result = $requete->execute(array($id));
		if ( !$result ) {
			$bdd=null;
            return false;
		} else {
           $bdd=null;
		   return true;
	      }
	}
	
 }
?>
<?php

 /*$bda = new BeneficaireDataAccess();
 $result=$bda->beneficiaireHasCompte(100);
 echo "Resultat de l BeneficaireDataAccess........".$result;*/
 
 
/* $beneficiaire= new Beneficiaire(200,'GIGI','123456789','123456789','sal');
$result=$bda->insert($beneficiaire);
echo "Resultat de l inser........";
echo $result; */

//var_dump($beneficiaire);
 /* foreach($beneficiaires as $ben){

echo $ben->get_id();
echo "</br>";
echo $ben->get_nom();
echo "</br>";	 
} */


/*$bda = new BeneficaireDataAccess();
 $result=$bda->find0(100);*/
?>