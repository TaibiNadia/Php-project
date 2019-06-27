<?php 
	session_start();

	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/remise/Remise.class.php');	
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
		$remise = unserialize($_SESSION['remise']);
	}	
?>

<h3>Modifier une Remise</h3> 
<form action="../../controllers/remise/remiseModifierCl.php" method="POST" class="form-horizontal">
	<input type="hidden" name="id" class="form-control" value="<?php echo $remise->get_id(); ?>"></input>
	<input type="hidden" name="valid" class="form-control" value="<?php echo $remise->get_valid(); ?>"></input>
	<fieldset style="border:solid 0.05rem #e0dede; padding:50px; color:gray; background:#f6f6f6 "> 		
		<div class="row">
			<div class="form-group">
				<label for="id" class="col-sm-3 control-label">ID : </label>	
				<div class="col-sm-5">
					<input type="text" name="iv" class="form-control" value="<?php echo $remise->get_id(); ?>" disabled></input>
				</div>
			</div>
			<div class="form-group">
				<label for="libelle" class="col-sm-3 control-label">Libelle : </label>	
				<div class="col-sm-5">
					<input type="text" name="libelle" class="form-control" value="<?php echo $remise->get_libelle(); ?>"></input>
				</div>
			</div>
			<div class="form-group">
				<label for="date" class="col-sm-3 control-label">Date : </label>	
				<div class="col-sm-5">
					<input type="date" name="date" class="form-control" value="<?php echo $remise->get_date(); ?>"></input>
				</div>
			</div>
			<div class="form-group">
				<label for="motif" class="col-sm-3 control-label">Motif : </label>	
				<div class="col-sm-5">
					<textarea rows="3" cols="71" name="motif"><?php echo $remise->get_motif(); ?></textarea>
				</div>
			</div>			
		</div>
		<div class="row">
			<div class="form-group">
				<label class="col-sm-3 control-label"></label>
				<div class="col-sm-5">
					<input type="submit" name="valider" value="Valider" class="btn btn-success col"></input>
					<input type="reset" name="annuler" value="Annuler" class="btn btn-success col"></input>	
					<a href="../../controllers/remise/remiseListerCl.php"><input type="button" name="annuler" value="Retour" class="btn btn-danger col"></input></a>
				</div>
			</div>
		</div>
	</fieldset> 
</form>

<?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
?>