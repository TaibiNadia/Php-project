<?php

	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/operation/Operation.class.php');
	
	class OperationDataAccess	{
		
		public function findAllOperation()
		{			
			require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');						
			$requete = $bdd->prepare('select * from operation'); //prepare la requete
			$requete->execute() or die(print_r($requete->errorInfo()));											
			$result=$requete->fetchall(PDO::FETCH_ASSOC);
			// fetchall(PDO::FETCH_ASSOC)retourne l'ensemble de données sous forme d'un tableau associatif
								
			if(empty($result))
				return false;
			else
			{
				foreach($result as $operation)
				{						
					$operations[$operation['ope_id']]=new Operation($operation['ope_id'],$operation['ope_libelle'],$operation['ope_date'],$operation['ope_montant'],$operation['ope_id_com']);	
					$operations[$operation['ope_id']]->set_remiseId($operation['ope_id_rem']);
				}
				$bdd=null;
				return $operations;
			}
		}
		
		public function findByIdOperation($id){
				
			require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
			$requete = $bdd->prepare('select * from operation where ope_id=?'); //prepare la requete 
			$requete->execute(array($id)) or die(print_r($requete->errorInfo()));	// execute la requete		
			
			if($result=$requete->fetch()){				
				$operation = new Operation($result['ope_id'],$result['ope_libelle'],$result['ope_date'],$result['ope_montant'],$result['ope_id_com']);
				$operation->set_remiseId($result['ope_id_rem']);
				return $operation;
			}
			else{
				return false;
			}	
		}
		
		public function insertOperation(Operation $operation)
		{	
			require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
			
				$sql='insert into operation(ope_id,ope_libelle,ope_date,ope_montant,ope_id_com,ope_id_rem)
				values (?,?,?,?,?,?)';	
				
				$requete=$bdd->prepare($sql);					
				if($requete->execute(array(null,$operation->get_libelle(),$operation->get_date(),$operation->get_montant(),$operation->get_compteId(),$operation->get_remiseId())))
					return true ;
				else
					return false;
					
				$bdd=null;	
				
		}
		
		public function updateOperation(Operation $operation)
		{		
		var_dump($operation);
	
			require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
			
			$sql =	'update operation   set ope_libelle=?,
											ope_date=?,
											ope_montant=?,											
											ope_id_rem=?
										where ope_id= ?	';		
			
			$requete=$bdd->prepare($sql);			
			
			if($requete->execute(array(	$operation->get_libelle(),
										$operation->get_date(),
										$operation->get_montant(),
										$operation->get_remiseId(),
										$operation->get_id()))){
				
				$bdd=null;	
				return true;  //"Modification reussie";
			}
			else{
				$bdd=null;	
				return false; //"Modification echouee !!!";
			}
		}
		
		public function deleteOperation(Operation $operation)
		{		
			require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
			
			$sql =	'delete from operation where ope_id= ?	';		
			
			$requete=$bdd->prepare($sql);			
			
			if($requete->execute(array($operation->get_id()))){
				
				$bdd=null;	
				return true;
			}
			else{
				$bdd=null;	
				return false;
			}
		}	
		
		
	}	
?>
<?php 
/*
	echo "</br>Je suis le la classe OperationDataAccess.php</br>";
	$opedb = new OperationDataAccess();
	$ope = new Operation('546','ooooooo','2020-12-20',0.00001,104);
	var_dump($opedb->findAllOperation());
	var_dump($opedb->deleteOperation($ope));
	var_dump($opedb->findAllOperation());	
	

	echo '</br>';
	//var_dump($opedb->findByIdOperation(100));
	echo '</br>';
	//var_dump($opedb->insertOperation($ope));
	echo '</br>';
	var_dump($opedb->findAllOperation());
	echo '</br>';
	$opedb->updateOperation($ope);
	echo '</br>'.$opedb->updateOperation($ope);
	echo '</br>';
	var_dump($opedb->findAllOperation());
	echo '</br>';
*/	
?>

