<?php 
	session_start();

	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/compte/Compte.class.php');	
	
	if(isset($_SESSION['msgError'])){		
		echo $_SESSION['msgError'];
		unset ($_SESSION['msgError']);
		exit;
	}
	else{	
		$compte = unserialize($_SESSION['compte']);	
	}			
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/header.php');
?>
<h1 class="display-4">Detail d'un Compte</h1>
<form action="#" method="POST" class="form-horizontal">
	<div class="form-group">
		<label for="id" class=" control-label">ID Compte : </label>	
		<div >
			<input type="text" name="id" class="form-control" value="<?php echo $compte->get_id(); ?>" disabled ="true"></input>
		</div>
	</div>
	<div class="form-group">
		<label for="libelle" class=" control-label">ID Beneficiaire : </label>	
		<div>
			<input type="text" name="idBeneficiaire" class="form-control" value="<?php echo $compte->get_idBeneficiaire(); ?>" disabled ="true"></input>
		</div>
	</div>
	<div class="form-group">
		<label for="id" class=" control-label">Libelle : </label>	
		<div >
			<input type="text" name="libelle" class="form-control" value="<?php echo $compte->get_libelle(); ?>" disabled ="true"></input>
		</div>
	</div>
	<div class="form-group">
		<label for="libelle" class=" control-label">IBAN : </label>	
		<div>
			<input type="text" name="iban" class="form-control" value="<?php echo $compte->get_iban(); ?>" disabled ="true"></input>
		</div>
	</div>
</form>

<?php
	
	if($_SERVER ["HTTP_REFERER"] =="http://localhost/virement/views/operation/operationLister.php")		
		$retour = "../../controllers/operation/operationListerCl.php";
	else
		$retour = "../../controllers/compte/compteListerCl.php";

?>

<div class="form-group"><BR>		
	<a href="<?php echo $retour ?>" >
		<input type="button" name="retour" value=" < Retour " class="btn btn-danger"></input>
	</a>				
</div>

<?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
?>