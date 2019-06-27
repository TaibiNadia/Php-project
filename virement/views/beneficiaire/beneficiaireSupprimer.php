<?php

	session_start();

	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/beneficiaire/beneficiaire.class.php');	
	
	if(isset($_SESSION['msgError'])){		
		echo $_SESSION['msgError'];
		unset ($_SESSION['msgError']);
		exit;
	}
	else{	
		$beneficiaire = unserialize($_SESSION['beneficiaire']);	
		
	}			
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/header.php');
?>

<h2>Suppression du Beneficiaire</h2><BR><BR>
<form id="beneficiaire-supprimer-form" action="../../controllers/beneficiaire/beneficiaireSupprimerCl.php" method="POST" class="form-horizontal">
<fieldset style="border:solid 0.05rem #e0dede;  padding:50px; color:gray; background-color:#f6f6f6;>
<div class="row">
		<div class="form-group">
		<label for="id" class="col-sm-3 control-label">ID : </label>
		<div class="col-sm-5">
		<input type="text" name="id" value="<?php echo $beneficiaire->get_id();?>" size="15" maxlength="3" disabled="disabled" id="beneficiaire-supprimer-id" class="form-control">
		<input type="hidden" name="id" value="<?php echo $beneficiaire->get_id();?>" size="15" maxlength="10" id="beneficiaire-modifier-id" class="form-control">
		</div>
		</div>		
		<div class="form-group">
		<label for="nom" class="col-sm-3 control-label">Nom : </label>
		<div class="col-sm-5">	
		<input type="text" name="nom" value="<?php echo $beneficiaire->get_nom();?>" size="20" maxlength="20" disabled="disabled" id="beneficiaire-supprimer-nom" class="form-control">
		</div>
		</div>
		<div class="form-group">
		<label for="siret" class="col-sm-3 control-label">Siret : </label>
		<div class="col-sm-5">	
		<input type="text" name="siret" value="<?php echo $beneficiaire->get_siret();?>" size="20" maxlength="20" disabled="disabled" id="beneficiaire-supprimer-siret" class="form-control">
		</div>
		</div>	
		<div class="form-group">
		<label for="ics" class="col-sm-3 control-label">ICS : </label>
		<div class="col-sm-5">	
		<input type="text" name="ics" value="<?php echo $beneficiaire->get_ics();?>" size="20" maxlength="14" disabled="disabled" id="beneficiaire-supprimer-ics" class="form-control">
		</div>
		</div>	
		<div class="form-group">
		<label for="categorie" class="col-sm-3 control-label">Categorie : </label>
		<div class="col-sm-5">		
		<input type="text" name="categorie" value="<?php echo $beneficiaire->get_idCategorie();?>" size="20" maxlength="14" disabled="disabled" id="beneficiaire-supprimer-categorie" class="form-control"><BR>
		</div>
		</div>	
		<div class="form-group">
		<label for="categorie" class="col-sm-3 control-label"></label>
		<div class="col-sm-5">	
		<input type="submit" name="valider" value="Valider" id="supprimer-valider" class="btn btn-success" >
		<a href="../../controllers/beneficiaire/beneficiaireListerCl.php"><input type="button" name="annuler" value="Retour" id="modifier-annuler" class="btn btn-danger" ></a>
</div>
</div>
</div>
</fieldset>
</form>
 <?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
?>