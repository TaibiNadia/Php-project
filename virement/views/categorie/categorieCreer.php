<?php
	session_start();
	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/categorie/CategorieDataAccess.class.php');			
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/header.php');

	if(isset($_GET['msgErreur'])){
		echo '<div  class="alert alert-info alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Info !   </strong>';
		echo $_GET['msgErreur'];
		echo '</div>';
	}	
		
?>
<h2>Creation d'une Categorie</h2><BR><BR>
<form action="../../controllers/categorie/categorieCreerCl.php" method="POST" class="form-horizontal">
<fieldset style="border:solid 0.05rem #e0dede;  padding:50px; color:gray; background-color:#f6f6f6;>
<div class="row">
		<div class="form-group">
		<label for="id" class="col-sm-3 control-label">ID * : </label>	
		<div class="col-sm-5">
		<input type="text" name="id" placeholder="3 caracteres requis"  class="form-control" value=""></input>
		</div>
		</div>
		<div class="form-group">
		<label for="libelle" class="col-sm-3 control-label">Libelle * : </label>	
		<div class="col-sm-5">
		<input type="text" name="libelle" placeholder="entre 3 et 31 caracteres " class="form-control" value=""></input>
		</div>
		</div>
		<div class="form-group">
		<label class="col-sm-3 control-label"></label>
		<div class="col-sm-5"><BR>
		<input type="submit" name="valider" value="Valider" class="btn btn-success col"></input>
		<input type="reset" name="annuler" value="Effacer" class="btn btn-warning"></input>	
		<a href="../../controllers/categorie/categorieListerCl.php"><input type="button" name="annuler" value="Retour" class="btn btn-danger col"></input>
		</div>
		</div>
</div>
</fieldset>
</form>

<?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
?>