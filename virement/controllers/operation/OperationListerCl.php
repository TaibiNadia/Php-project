<?php
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/operation/OperationDataAccess.class.php');

	$operations = new OperationDataAccess();
	
	$result = $operations->findAllOperation();
	
	//var_dump($result);
	if($result){
		$_SESSION['operations']=serialize($result);
	}
	else{
		$_GET['msgErreur']="Aucune Operation trouvee !";
	}
	
	if(isset($_GET['msgErreur'])){
		$msgErreur=$_GET['msgErreur'];
		header('location:../../views/operation/operationLister.php?msgErreur='.$msgErreur. ' !!!');
	}
	else{
		header('location:../../views/operation/operationLister.php');
	}	
?>