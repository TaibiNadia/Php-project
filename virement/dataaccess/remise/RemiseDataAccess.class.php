<?php

require($_SERVER['DOCUMENT_ROOT'].'/virement/models/remise/Remise.class.php'); 

 class RemiseDataAccess{
	
	public function findAllRemise(){
		require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		
		$requete = $bdd->prepare('select * from remise'); //prepare la requete
		$requete->execute() or die(print_r($requete->errorInfo()));
		$result=$requete->fetchall(PDO::FETCH_ASSOC);
								
			if(empty($result))
				return false;
			else{
				foreach($result as $remise)
				{						
					$remises[$remise['rem_id']]=new Remise($remise['rem_id'],$remise['rem_libelle'],$remise['rem_date'],$remise['rem_motif'],$remise['rem_valid']);	
				}		
				$bdd=null;
				return $remises;
			}		
    }
	public function findAllRemiseValid(){
		require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		
		$requete = $bdd->prepare('select * from remise where rem_valid=?'); //prepare la requete
		$requete->execute(array(1)) or die(print_r($requete->errorInfo()));
		$result=$requete->fetchall(PDO::FETCH_ASSOC);
								
			if(empty($result))
				return false;
			else{
				foreach($result as $remise)
				{						
					$remises[$remise['rem_id']]=new Remise($remise['rem_id'],$remise['rem_libelle'],$remise['rem_date'],$remise['rem_motif'],$remise['rem_valid']);	
				}		
				$bdd=null;
				return $remises;
			}		
    }
	public function findAllRemiseNonValid(){
		require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		
		$requete = $bdd->prepare('select * from remise where rem_valid=?'); //prepare la requete
		$requete->execute(array(0)) or die(print_r($requete->errorInfo()));
		$result=$requete->fetchall(PDO::FETCH_ASSOC);
								
			if(empty($result))
				return false;
			else{
				foreach($result as $remise)
				{						
					$remises[$remise['rem_id']]=new Remise($remise['rem_id'],$remise['rem_libelle'],$remise['rem_date'],$remise['rem_motif'],$remise['rem_valid']);	
				}		
				$bdd=null;
				return $remises;
			}		
    }
	public function findByIdRemise($id){
		require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		$requete = $bdd->prepare('select * from remise where rem_id=?'); //prepare la requete
		$requete->execute(array($id)) or die(print_r($requete->errorInfo()));
		
		if($result=$requete->fetch()){	
			$remise =  new Remise($result['rem_id'],$result['rem_libelle'],$result['rem_date'],$result['rem_motif'],$result['rem_valid']);
			return $remise;			
		}
		else{
			return false;
		}	
         $bdd=null;			
    }
	public function updateRemise(Remise $remise){
		require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		$sql =	'update remise
					set 	
							rem_libelle=?,
							rem_date=?,
							rem_motif=?
							
					where rem_id=?	';
		$requete=$bdd->prepare($sql);
			
		if($requete->execute(array(	
										$remise->get_libelle(),
										$remise->get_date(),
										$remise->get_motif(),
										$remise->get_id()
										
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
	public function insertRemise(Remise $remise){	
			require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
			
				$sql='insert into remise(rem_id,rem_libelle,rem_date,rem_motif,rem_valid)
				values (?,?,?,?,?)';	
				
				$requete=$bdd->prepare($sql);					
				if($requete->execute(array(null,$remise->get_libelle(),$remise->get_date(),$remise->get_motif(),$remise->get_valid())))
					return true ;
				else
					return false;
					
				$bdd=null;	
				
		}
	public function deleteRemise(Remise $remise){		
		require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		
		$sql =	'delete from remise where rem_id= ?	';			
		$requete=$bdd->prepare($sql);			
		if($requete->execute(array($remise->get_id()))){
			$bdd=null;	
			return true;
		}
		else{
			$bdd=null;	
			return false;
		}
	}
	public function montantsRemises(){
		require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		$requete = $bdd->prepare('select sum(ope_montant) as montant , ope_id_rem as id from operation group by ope_id_rem'); //prepare la requete 
		$requete->execute() or die(print_r($requete->errorInfo()));
		$result=$requete->fetchall(PDO::FETCH_ASSOC);
			
		$bdd=null;
		return $result;
	}
	public function montantRemise($id){
		require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		$requete = $bdd->prepare('select sum(ope_montant) as montant from operation where ope_id_rem=?'); //prepare la requete 
		$requete->execute(array($id)) or die(print_r($requete->errorInfo()));
		$result=$requete->fetchall(PDO::FETCH_ASSOC);
		$montant=0;	
		if(!empty($result)){
				foreach($result as $res){
				    $montant=$res['montant'];
				}
		}
		$bdd=null;
		return $montant;
	}
	public function nbOperationsRemise($id){
		require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		$requete = $bdd->prepare('select count(ope_id) as nombre from operation where ope_id_rem=?'); //prepare la requete 
		$requete->execute(array($id)) or die(print_r($requete->errorInfo()));
		$result=$requete->fetchall(PDO::FETCH_ASSOC);
		$nbOperations=0;	
		if(!empty($result)){
				foreach($result as $res){
				    $nbOperations=$res['nombre'];
				}
		}
        $bdd=null;
		return $nbOperations;	
	}
	public function findOperationsRemise($id){
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		$requete = $bdd->prepare('select ope_id as id, ope_libelle as libelle, ope_date as date, ope_montant as montant, com_id_ben as id_ben from operation,compte where ope_id_com = com_id and ope_id_rem = ?'); //prepare la requete 
		$requete->execute(array($id)) or die(print_r($requete->errorInfo()));
		$result=$requete->fetchall(PDO::FETCH_ASSOC);
		
        $bdd=null;
		return $result;	
	}
	public function findOperationsWithoutRemise(){
	    require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
		$requete = $bdd->prepare('select ope_id as id, ope_libelle as libelle, ope_date as date, ope_montant as montant, com_id_ben as id_ben from operation,compte where ope_id_com = com_id and ope_id_rem is null'); //prepare la requete 
		$requete->execute() or die(print_r($requete->errorInfo()));
		$result=$requete->fetchall(PDO::FETCH_ASSOC);
		
        $bdd=null;
		return $result;	
	}
	public function attacherOperation($id,$id_rem){
	   require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');	    
	   $sql =	'update operation
					set ope_id_rem=? where ope_id= ?';
					
		$requete=$bdd->prepare($sql);
		if($requete->execute(array($id_rem,$id)))
			{
				$bdd=null;	
				return true; 
			}
			else{
				$bdd=null;	
				return false; 
			}
	}
	public function detacherOperation($id){
		require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');	    
	   $sql =	'update operation
					set ope_id_rem=null where ope_id= ?';
					
		$requete=$bdd->prepare($sql);
		if($requete->execute(array($id)))
			{
				$bdd=null;	
				return true; 
			}
			else{
				$bdd=null;	
				return false; 
			}
	}
	public function validerRemise($id){
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');	    
	   $sql =	'update remise set rem_valid=1 where rem_id= ?';
					
		$requete=$bdd->prepare($sql);
		if($requete->execute(array($id))){
				$bdd=null;	
				return true; 
		}
		else{
			$bdd=null;	
			return false; 
		}
	}
	public function estValideeRemise($id){
		require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');	    
	   $sql =	'select rem_valid from remise where rem_id=?';
		$requete=$bdd->prepare($sql);
		$requete->execute(array($id)) or die(print_r($requete->errorInfo()));
		$result=$requete->fetchall(PDO::FETCH_ASSOC);
		$valide=0;	
		if(!empty($result)){
				foreach($result as $res){
				    $valide=$res['rem_valid'];
				}
		}
		$bdd=null;
		return $valide;
	}
 }	
?>
<?php

/*
echo "je suis DataAccessRemise ";


$bda = new RemiseDataAccess();
				//($id,$libelle,$date,$motif,$valid)
$remise= new Remise(150,'Remise poule sept 2020','2018-08-25','primes scolaires',0);

echo $remise->get_libelle();
$result=$bda->insertRemise($remise);
echo "</br>";
var_dump($result);



/*
 foreach($remises as $rem){

echo $rem->get_id();
echo "</br>";
echo $rem->get_libelle();
echo "</br>";	

} 
*/
?>




