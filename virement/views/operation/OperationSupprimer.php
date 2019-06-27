<?php

	session_start();

	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/operation/Operation.class.php');	
	
	if(isset($_SESSION['msgError'])){		
		echo $_SESSION['msgError'];
		unset ($_SESSION['msgError']);
		exit;
	}
	else{	
		$operation = unserialize($_SESSION['operation']);	
	}			
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/header.php');
?>
<h2 class="display-4">Suppression d'une Operation</h2>	<BR><BR>
<form action="../../controllers/operation/operationSupprimerCl.php" method="POST" class="form-horizontal">
<fieldset style="border:solid 0.05rem #e0dede;  padding:50px; color:gray; background-color:#f6f6f6;>
<div class="row">
	<div class="form-group">
		<label for="id" class="col-sm-3 control-label">ID : </label>	
		<div class="col-sm-5">
			<input type="text" name="id" class="form-control" value="<?php echo $operation->get_id(); ?>" disabled ="true"/>
			<input type="hidden" name="id" class="form-control" value="<?php echo $operation->get_id(); ?>"/>
		</div>
	</div>
	<div class="form-group">
		<label for="libelle" class="col-sm-3 control-label">Libelle : </label>	
		<div class="col-sm-5">
			<input type="text" name="libelle" class="form-control" value="<?php echo $operation->get_libelle(); ?>" disabled ="true"/>
			<input type="hidden" name="libelle" class="form-control" value="<?php echo $operation->get_libelle(); ?>"/>
		</div>
	</div>
	<div class="form-group">
		<label for="date" class="col-sm-3 control-label">Date : </label>	
		<div class="col-sm-5">
			<input type="text" name="date" class="form-control" value="<?php echo $operation->get_date(); ?>" disabled ="true"/>
			<input type="hidden" name="date" class="form-control" value="<?php echo $operation->get_date(); ?>"/>
		</div>
	</div>
	<div class="form-group">
		<label for="remise" class="col-sm-3 control-label">Montant : </label>	
		<div class="col-sm-5">
			<input type="text" name="montant" class="form-control" value="<?php echo $operation->get_montant(); ?>" disabled ="true"/>
			<input type="hidden" name="montant" class="form-control" value="<?php echo $operation->get_montant(); ?>"/>
		</div>
	</div>

	<div class="form-group">
		<label for="compte" class="col-sm-3 control-label">Compte : </label>	
		<div class="col-sm-5">
			<input type="text" name="compteId" class="form-control" value="<?php echo $operation->get_compteId(); ?>" disabled ="true"/>
			<input type="hidden" name="compteId" class="form-control" value="<?php echo $operation->get_compteId(); ?>"/>
		</div>
	</div>
	
	<div class="form-group">
		<label for="remise" class="col-sm-3 control-label">Remise : </label>	
		<div class="col-sm-5">
			<input type="text" name="remiseId" class="form-control" value="<?php echo $operation->get_remiseId(); ?>" disabled ="true"/>
			<input type="hidden" name="remiseId" class="form-control" value="<?php echo $operation->get_remiseId(); ?>"/>
		</div>
	</div>
	<div class="form-group">
		<label for="remise" class="col-sm-3 control-label"></label>	
		<div class="col-sm-5"><BR>
		<input type="submit" name="valider" value="Valider" class="btn btn-success col"/>
		<a href="../../controllers/operation/operationListerCl.php"><input type="button" name="abondonner" value="Retour" class="btn btn-danger col"/>
	</div>
	</div>
</div>	
</fieldset>
</form>

<?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
?>
