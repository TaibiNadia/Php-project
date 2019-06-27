<?php
	session_start();
	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/compte/CompteDataAccess.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/header.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/beneficiaire/Beneficiaire.class.php');
    $beneficiaires= unserialize($_SESSION['beneficiaires']);
	//var_dump($beneficiaires);
	if(isset($_GET['msgErreur'])){
		echo '<div  class="alert alert-info alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Info !   </strong>';
		echo $_GET['msgErreur'];
		echo '</div>';
	}	
		
?>

<h2 class="display-4">Creation d'un Compte</h2><BR><BR>
<form action="../../controllers/compte/CompteCreerCl.php" method="POST" class="form-horizontal">
<fieldset style="border:solid 0.05rem #e0dede;  padding:50px; color:gray; background-color:#f6f6f6;>
<div class="row">
		<div class="form-group">
		<label for="beneficiaire" class="col-sm-3 control-label">Beneficiaire : </label>	
		<div class="col-sm-5">
		<SELECT name="idBeneficiaire" id="compte-creer" class ="form-control" >	
		  <?php foreach($beneficiaires as $beneficiaire){?>
			<option value="<?php echo $beneficiaire->get_id();?>"> <?php echo $beneficiaire->get_nom();?> </option>
		  <?php  }?>
		 </SELECT>
		</div>
		</div>
		<!-- <label for="libelle" class="col-sm-3 control-label">ID Compte : </label>	
		<input type="text" name="id" class="form-control" value=""></input> -->
		<div class="form-group">
			<label for="libelle" class="col-sm-3 control-label">Libelle * : </label>	
			<div class="col-sm-5">
				<input type="text" name="libelle" class="form-control" value="" placeholder= "entre 2 et 30 caracteres" ></input>
			</div>
			</div>
		<div class="form-group">
			<label for="iban" class="col-sm-3 control-label">IBAN * : </label>	
			<div class="col-sm-5">
				<input type="text" name="iban" class="form-control" value="" placeholder="entre 14 et 34 caracteres" ></input>
			</div>
			</div>
		<div class="form-group"><BR>	
			<label class="col-sm-3 control-label"></label>
			<div class="col-sm-5">
			<input type="submit"  name="valider" value="Valider" class="btn btn-success">
			<input type="reset" name="annuler" value="Effacer" class="btn btn-warning"></input>
			<a href="../../controllers/compte/CompteListerCl.php"><input id="accueil"  type="button" value="Retour" class="btn btn-danger"></a>
	</div>
		</div>

		<!--<div class="btn-group">	
			<button type="submit" name="valider" value="Valider" class="btn btn-success col">Valider</button><p style="color:white">a</p>
			<button type="reset" name="annuler" value="Effacer" class="btn btn-success col">Effacer</button><p style="color:white">a</p>	
			<a href="../../controllers/compte/CompteListerCl.php"><button type="button" name="annuler" value="Retour" class="btn btn-danger col">Retour</button>
		<div/>	 -->
	</div>
</fieldset>	
</form>

<?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
?>