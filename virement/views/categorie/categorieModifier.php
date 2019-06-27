<?php 
	session_start();

	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/categorie/Categorie.class.php');	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/header.php');
	if(isset($_GET['msgErreur'])){
		echo '<div  class="alert alert-info alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Alert !    </strong>';
		echo $_GET['msgErreur'];
		echo '</div>';
	}	
	if(isset($_SESSION['msgErreur'])){		
		echo $_SESSION['msgErreur'];
		unset ($_SESSION['msgErreur']);
		exit;
	}
	else{	
		$categorie = unserialize($_SESSION['categorie']);	
	}			
?>
<h2>Modifier la Categorie</h2><BR><BR>
<form action="../../controllers/categorie/categorieModifierCl.php" method="POST" class="form-horizontal">
<fieldset style="border:solid 0.05rem #e0dede;  padding:50px; color:gray; background-color:#f6f6f6;>
<div class="row">
		<div class="form-group">
		<label for="id" class="col-sm-3 control-label">ID * : </label>
		<div class="col-sm-5">	
			<input type="text" name="id" class="form-control" placeholder= "3 caracteres requis" value="<?php echo $categorie->get_id(); ?>" disabled ="true"></input>
			<input type="hidden" name="id" class="form-control" value="<?php echo $categorie->get_id(); ?>"></input>
		</div>
		</div>
		<div class="form-group">
		<label for="libelle" class="col-sm-3 control-label">Libelle * : </label>	
		<div class="col-sm-5">
			<input type="text" name="libelle" placeholder= "entre 3 et 31 caracteres" class="form-control" value="<?php echo $categorie->get_libelle(); ?>" ></input>
		</div>
		</div>
		<div class="form-group">
		<label class="col-sm-3 control-label"></label>
		<div class="col-sm-5"><BR>
			<input type="submit" name="valider" value="Valider" class="btn btn-success col"></input>
			<a href="../../controllers/categorie/categorieListerCl.php"><input type="button" name="abondonner" value="Retour" class="btn btn-danger col"></input>
		</div>
		</div>	
</div>
</fieldset>
</form>
<?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
?>