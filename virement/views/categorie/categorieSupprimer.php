<?php

	session_start();

	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/categorie/Categorie.class.php');	
	
	if(isset($_SESSION['msgError'])){		
		echo $_SESSION['msgError'];
		unset ($_SESSION['msgError']);
		exit;
	}
	else{	
		$categorie = unserialize($_SESSION['categorie']);	
	}			
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/header.php');
?>
<h2 class="display-4">Supprimer un Compte</h2><BR><BR>
<form action="../../controllers/categorie/categorieSupprimerCl.php" method="POST" class="form-horizontal">
<fieldset style="border:solid 0.05rem #e0dede;  padding:50px; color:gray; background-color:#f6f6f6;>
<div class="row">
	<div class="form-group">
		<label for="id" class=" col-sm-3 control-label">ID : </label>	
		<div class="col-sm-5">
			<input type="text" name="id" class="form-control" value="<?php echo $categorie->get_id(); ?>" disabled ="true"/>
			<input type="hidden" name="id" class="form-control" value="<?php echo $categorie->get_id(); ?>"/>
		</div>
	</div>
	<div class="form-group">
		<label for="libelle" class="col-sm-3 control-label">Libelle : </label>	
		<div class="col-sm-5">
			<input type="text" name="libelle" class="form-control" value="<?php echo $categorie->get_libelle(); ?>" disabled ="true"/>
			<input type="hidden" name="libelle" class="form-control" value="<?php echo $categorie->get_libelle(); ?>"/>
		</div>
	</div>
	<div class="form-group">
		<label for="libelle" class="col-sm-3 control-label"></label>	
		<div class="col-sm-5"><BR>
		<input type="submit" name="valider" value="Valider" class="btn btn-success col"/>
		<a href="../../controllers/categorie/categorieListerCl.php"><input type="button" name="abondonner" value="Retour" class="btn btn-danger col"/>
	</div>
	
</div>
</fieldset>
</form>

<?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
?>
