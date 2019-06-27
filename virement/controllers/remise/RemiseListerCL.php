<?php
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/remise/remiseDataAccess.class.php');

	$remises = new RemiseDataAccess();
	
	$result = $remises->findAllRemise();
	$montantsRemises = $remises->montantsRemises();
	//
	
	//var_dump($result);
	if($result){
		
		$_SESSION['remises']=serialize($result);
		
		if($montantsRemises){
			$_SESSION['montantsRemises'] = serialize($montantsRemises);
		}else {
			$_GET['msgErreur']="Erreur sur le calcul des montants !";
		}
	}
	else{
		$_GET['msgErreur']="Aucune Remise trouvee !";
	}
	
	if(isset($_GET['msgErreur'])){
		$msgErreur=$_GET['msgErreur'];
		header('location:../../views/remise/remiseLister.php?msgErreur='.$msgErreur. ' !!!');
	}
	else{
		header('location:../../views/remise/remiseLister.php');
	}	
?>	