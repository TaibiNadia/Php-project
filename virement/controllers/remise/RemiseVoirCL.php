<?php
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/remise/remiseDataAccess.class.php');
	
	$remise = new remiseDataAccess();
	
	if (isset($_GET['id']) && empty($_GET['action'])){ 		
		if($remise->findByIdRemise($_GET['id'])){
	    	$idRemise=$_GET['id'];
	    	$_SESSION['remise']=serialize($remise->findByIdRemise($_GET['id']));
	    	$_SESSION['montantRemise'] =serialize($remise->montantRemise($_GET['id']));
		    $_SESSION['nbOperationsRemise'] =serialize($remise->nbOperationsRemise($_GET['id']));
	     	$_SESSION['operationsRemise'] = serialize($remise->findOperationsRemise($_GET['id']));
	    	$_SESSION['operationsSansRemise'] = serialize($remise->findOperationsWithoutRemise());
			$_SESSION['remiseValide'] = serialize($remise->estValideeRemise($_GET['id']));
			
			//var_dump($_SESSION['operationsSansRemise']);
			if(isset($_GET['msgErreur']))
				header('location:../../views/remise/remiseVoir.php?msgErreur='.$_GET['msgErreur']);
			else 
				header('location:../../views/remise/remiseVoir.php');
	    }
	     else{
			 echo "Je suis dans le else";
		     
			  header('location:../../views/remise/remiseVoir.php?msgErreur=Aucune remise trouvee !');
	    }
	}
	
	if (isset($_GET['id']) && !empty($_GET['action']) && !empty($_GET['idRemise'])) {
	
		if ($_GET['action']==2){ // pour attacher une operation
			$id=$_GET['id'];
			$idRemise = $_GET['idRemise'];
			$remise->attacherOperation($id,$idRemise);
			if ($remise->attacherOperation($id,$idRemise)){
				header('location:remiseVoirCl.php?id='.$_GET['idRemise'].'&msgErreur=Operation Attachee avec succes !');
			} else{
				$_SESSION['msgError']="L operation n a pas ete attachee !! ";
				header('location:../../views/remise/remiseVoir.php');
			}
		}else { 
		    if($_GET['action']==1) { // pour detacher une operation
				
				if($remise->estValideeRemise($_GET['idRemise'])=='1'){
					header('location:remiseVoirCl.php?id='.$_GET['idRemise'].'&msgErreur=remise deja validee !');
				}					
				else{
					
					$id=$_GET['id'];
					$remise->detacherOperation($id);
					if ($remise->detacherOperation($id)){
						header('location:remiseVoirCl.php?id='.$_GET['idRemise'].'&msgErreur=Operation DETACHEE avec succes !');
					} 
					else{
						header('location:remiseVoirCl.php?id='.$_GET['idRemise'].'&msgErreur=L operation n a pas ete detachee !');
					}
				}		
			}
		}
	} 
	
	if($_GET['action']==3){ // pour valider une remise
			$id=$_GET['id'];
			if ($remise->estValideeRemise($id)=='1') {  
				header('location:remiseVoirCl.php?id='.$_GET['id'].'&msgErreur=Remise deja validee !');
			}
			else {
					if($remise->nbOperationsRemise($id)>0){
						$remise->validerRemise($id);
						if ($remise->validerRemise($id)){
						   header('location:remiseVoirCl.php?id='.$_GET['id'].'&msgErreur=Remise Validee avec succes !');
						} 
						else{
							 header('location:remiseVoirCl.php?id='.$_GET['id'].'&msgErreur=La remise n a pas ete validee !');
						}
					}
					else{
						 header('location:remiseVoirCl.php?id='.$_GET['id'].'&msgErreur=Impossible de valider une remise sans operations !');
					}
			}			 
	}
		
	
	
?>
