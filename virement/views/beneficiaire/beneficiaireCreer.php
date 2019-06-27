<?php
  session_start();
  require($_SERVER['DOCUMENT_ROOT'].'/virement/models/categorie/Categorie.class.php');
  $categories = unserialize($_SESSION['categories']);	
 
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/header.php');
	
	if(isset($_GET['msgErreur'])){
		echo '<div  class="alert alert-info alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Info !   </strong>';
		echo $_GET['msgErreur'];
		echo '</div>';
	}	
?>
<h2>Creation d'un Beneficiaire</h2><BR><BR>
<form id="beneficiaireCreer" action="../../controllers/beneficiaire/beneficiaireCreerCl.php" method="POST" class="form-horizontal">
<fieldset style="border:solid 0.05rem #e0dede;  padding:50px; color:gray; background-color:#f6f6f6;>
<div class="row">
<div class="form-group">
			<label for="libelle" class="col-sm-3 control-label">Nom * : </label>	
			<div class="col-sm-5">
				<input type="text" name="nom" placeholder= "2 caracteres requis" class="form-control" value=""></input>
			</div>
			</div>
		<div class="form-group">
			<label for="siret" class="col-sm-3 control-label">Siret  : </label>	
			<div class="col-sm-5">
				<input type="text" name="iban" class="form-control" value=""></input>
			</div>
			</div>
		<div class="form-group">	
			<label for="ics" class="col-sm-3 control-label">ICS *  : </label>	
			<div class="col-sm-5">
				<input type="text" name="ics" placeholder= "15 caracteres minimum" class="form-control" value=""></input>
			</div>
			</div>	
		<div class="form-group">
		<label for="categorie" class="col-sm-3 control-label">Categorie : </label>	
		<div class="col-sm-5">
		<SELECT name="categorie" size="1" id="beneficiaire-creer-categorie" class="form-control">
<?php
    foreach ($categories as $categorie) {?>    
        <option value = "<?php echo $categorie->get_id(); ?>"> <?php echo $categorie->get_libelle(); ?> </option>;
		<?php }?>
		</SELECT><BR>	 
		</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label"></label>
			<div class="col-sm-5"><BR>	
<input type="submit" name="valider" value="Valider" id="creer-valider" class="btn btn-success" >
<input type="reset" name="annuler" value="Effacer" class="btn btn-warning"></input>
<a href="../../controllers/beneficiaire/beneficiaireListerCl.php"><input type="button" name="annuler" value="Retour" id="modifier-annuler" class="btn btn-danger" ></a>
</div>
</div>
</div>
</fieldset>
</form>
 <?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
?>
