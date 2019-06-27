
<?php 
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/header.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/beneficiaire/Beneficiaire.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/categorie/Categorie.class.php');
	
	//var_dump ($categories);
	if(isset($_GET['msgErreur'])){
		echo '<div  class="alert alert-info alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Info !   </strong>';
		echo $_GET['msgErreur'];
		echo '</div>';
	}	
	if(isset($_SESSION['msgErreur'])){		
		echo $_SESSION['msgErreur'];
		unset ($_SESSION['msgErreur']);
		exit;
	}
	else{	
		$beneficiaire = unserialize($_SESSION['beneficiaire']);	
		$categories = unserialize($_SESSION['categories']);
		$catSelected = $beneficiaire->get_idCategorie();
		$selected='';
	}	
		
?>
<h2>Modification du Beneficiaire</h2><BR><BR>
<form id="beneficiaire-modifier-form" action="../../controllers/beneficiaire/beneficiaireModifierCl.php" method="POST" class="form-horizontal">
	<input type="hidden" name="id" value="<?php echo $beneficiaire->get_id();?>">

	<fieldset style="border:solid 0.05rem #e0dede;  padding:50px; color:gray; background-color:#f6f6f6;>
		<div class="row">

			<div class="form-group">
				<label for="id" class="col-sm-3 control-label">ID : </label>
				<div class="col-sm-5">
					<input type="text" name="id" value="<?php echo $beneficiaire->get_id();?>" size="15" maxlength="10" disabled="disabled" id="beneficiaire-modifier-id" class="form-control">
				</div>
			</div>
			
			<div class="form-group">
				<label for="nom" class="col-sm-3 control-label">Nom * : </label>
				<div class="col-sm-5">
					<input type="text" name="nom" placeholder= "2 caracteres minimum" value="<?php echo $beneficiaire->get_nom();?>" size="20" maxlength="30" id="beneficiaire-modifier-nom" class="form-control">
				</div>
			</div>
			
			<div class="form-group">
				<label for="siret" class="col-sm-3 control-label">Siret : </label>
				<div class="col-sm-5">
					<input type="text" name="siret" value="<?php echo $beneficiaire->get_siret();?>" size="20" maxlength="15" id="beneficiaire-modifier-siret" class="form-control">
				</div>
			</div>
			
			<div class="form-group">
				<label for="ics" class="col-sm-3 control-label">ICS * : </label>
				<div class="col-sm-5">
					<input type="text" name="ics" placeholder= "15 caracteres requis" value="<?php echo $beneficiaire->get_ics();?>" size="20" maxlength="15" id="beneficiaire-modifier-ics" class="form-control">
				</div>
			</div>
			
			<div class="form-group">
				<label for="categorie" class="col-sm-3 control-label">Categorie : </label>
				<div class="col-sm-5">
					<SELECT name="categorie" size="1" id="beneficiaire-modifier-categorie" class="form-control">
				
			
			<?php
				foreach ($categories as $categorie) {
					if($categorie->get_id()==$catSelected) 
					{
						$selected='selected';
					} 
			?>  
			   <option value = "<?php echo $categorie->get_id(); ?>" <?php echo $selected; ?> > <?php echo $categorie->get_libelle(); ?> </option>;
			   <?php $selected=''; ?>
			<?php }
			?>
				</SELECT>
			</div>
			</div>
			<BR>						
			<div class="form-group">	
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-5">
					<input type="submit" name="valider" value="Valider" id="modifier-valider" class="btn btn-success" >
					<a href="../../controllers/beneficiaire/beneficiaireListerCl.php"><input type="button" name="annuler" value="retour" id="modifier-annuler" class="btn btn-danger" ></a>
				</div>
			</div>
			
		</div>
	</fieldset>		
</form>
 <?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
?>

