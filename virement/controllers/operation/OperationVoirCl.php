<?php
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/operation/OperationDataAccess.class.php');
	
	$operation = new OperationDataAccess();
	if($operation->findByIdOperation($_GET['id'])){
		$_SESSION['operation']=serialize($operation->findByIdOperation($_GET['id']));
	}
	else{
		$_SESSION['msgError']="Aucune operation trouvee !! ";
	}
	header('location:../../views/operation/operationVoir.php');
	
?>
