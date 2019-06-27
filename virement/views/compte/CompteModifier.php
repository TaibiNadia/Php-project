<?php 
	session_start();

	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/compte/Compte.class.php');	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/header.php');
	if(isset($_GET['msgErreur'])){
		echo '<div  class="alert alert-info alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Info!   </strong>';
		echo $_GET['msgErreur'];
		echo '</div>';
	}	
	if(isset($_SESSION['msgErreur'])){		
		echo $_SESSION['msgErreur'];
		unset ($_SESSION['msgErreur']);
		exit;
	}
	else{	
		$compte = unserialize($_SESSION['compte']);	
	}			
?>
<h2 class="display-4">Modifier un Compte</h2><BR><BR>
<form action="../../controllers/compte/compteModifierCl.php" method="POST" class="form-horizontal">
<fieldset style="border:solid 0.05rem #e0dede;  padding:50px; color:gray; background-color:#f6f6f6;>
<div class="row">
		<div class="form-group">
		<label for="id" class="col-sm-3 control-label">ID Compte : </label>	
		<div class="col-sm-5">
			<input type="text" name="id" class="form-control" value="<?php echo $compte->get_id(); ?>" disabled ="true"></input>
			<input type="hidden" name="id" class="form-control" value="<?php echo $compte->get_id(); ?>"></input>
			</div>
			</div>
		<div class="form-group">	
			<label for="libelle" class="col-sm-3 control-label">ID Beneficiaire : </label>
		<div class="col-sm-5">			
			<input type="text" name="idBeneficiaire" class="form-control" value="<?php echo $compte->get_idBeneficiaire(); ?>"disabled ="true" ></input>
	        <input type="hidden" name="idBeneficiaire" class="form-control" value="<?php echo $compte->get_idBeneficiaire(); ?>" ></input>
			</div>
			</div>
		<div class="form-group">
			<label for="libelle" class="col-sm-3 control-label">Libelle * : </label>	
		<div class="col-sm-5">
			<input type="text" name="libelle" class="form-control" placeholder= "entre 2 et 30 caracteres" value="<?php echo $compte->get_libelle(); ?>" ></input>
			</div>
			</div>
		<div class="form-group">	
			<label for="libelle" class="col-sm-3 control-label">IBAN * : </label>
		<div class="col-sm-5">		
			<input type="text" name="iban" class="form-control" placeholder= "entre 14 et 34 caracteres" value="<?php echo $compte->get_iban(); ?>" ></input>
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
  </div>
</div>
</fieldset>
</form>

<?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
?>