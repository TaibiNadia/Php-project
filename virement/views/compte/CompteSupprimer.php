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
<h2 class="display-4">Supprimer un Compte</h2><BR><BR>
<form action="../../controllers/compte/compteSupprimerCl.php" method="POST" class="form-horizontal">
<fieldset style="border:solid 0.05rem #e0dede;  padding:50px; color:gray; background-color:#f6f6f6;>
<div class="row">
		<div class="form-group">
		<label for="id" class="col-sm-3 control-label">ID Compte : </label>	
		<div class="col-sm-5">
			<input type="text" name="id" class="form-control" value="<?php echo $compte->get_id(); ?>" disabled ="true"/>
			<input type="hidden" name="id" class="form-control" value="<?php echo $compte->get_id(); ?>"/>
			</div>
			</div>
		<div class="form-group">	
		<label for="id" class="col-sm-3 control-label">ID Beneficiaire : </label>
		<div class="col-sm-5">
			<input type="text" name="idBeneficiaire" class="form-control" value="<?php echo $compte->get_idBeneficiaire(); ?>" disabled ="true"/>
			<input type="hidden" name="idBeneficiaire" class="form-control" value="<?php echo $compte->get_idBeneficiaire(); ?>"/>
			</div>
			</div>
		<div class="form-group">	
		<label for="libelle" class="col-sm-3 control-label">Libelle : </label>
		<div class="col-sm-5">
			<input type="text" name="libelle" class="form-control" value="<?php echo $compte->get_libelle(); ?>" disabled ="true"/>
			<input type="hidden" name="libelle" class="form-control" value="<?php echo $compte->get_libelle(); ?>"/>
			</div>
			</div>
		<div class="form-group">	
		<label for="id" class="col-sm-3 control-label">IBAN : </label>
		<div class="col-sm-5">	
			<input type="text" name="iban" class="form-control" value="<?php echo $compte->get_iban(); ?>" disabled ="true"/>
			<input type="hidden" name="iban" class="form-control" value="<?php echo $compte->get_iban(); ?>"/>		
			</div>
			</div>
		<div class="row">
		<div class="form-group">
			<label class="col-sm-3 control-label"></label>
			<div class="col-sm-5"><BR>		
			<input type="submit"  name="valider" value="Valider" class="btn btn-success">
			<a href="../../controllers/compte/CompteListerCl.php"><input id="accueil"  type="button" value="Retour" class="btn btn-danger"></a>
			</div>
			</div>
</fieldset>	
</form>

<?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
?>
