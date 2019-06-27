<?php
	session_start();	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/operation/OperationDataAccess.class.php');	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/categorie/Categorie.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/beneficiaire/Beneficiaire.class.php');	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/remise/Remise.class.php');	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/compte/Compte.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/header.php');

	if(isset($_GET['msgErreur'])){
		echo '<div  class="alert alert-info alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Info !    </strong>';
		echo $_GET['msgErreur'];
		echo '</div>';
	}
	
	if($_SESSION['resultOperation']){		
		$operation = unserialize($_SESSION['resultOperation']);		
	}
	
?>	
<h2 class="display-4">Modification d'une Operation</h2>	<BR><BR>
<div class="row">
	<form action="../../controllers/operation/OperationModifierCl.php" method="POST" class="form-horizontal">
<fieldset style="border:solid 0.05rem #e0dede;  padding:50px; color:gray; background-color:#f6f6f6;>	
	<input type="hidden" name="id"  value="<?php  echo $operation->get_Id(); ?>"></input>
	<input type="hidden" name="compte"  value="<?php  echo $operation->get_compteId(); ?>"></input>
		<div class="form-group">
			<label for="id" class="col-sm-3 control-label">Beneficiaire * : </label>					
			<div class="col-sm-5">
				<select id="cathegorie" name="beneficiaire" class="form-control" disabled>
					<?php 							
						echo '<option>'.$_SESSION['beneficiaire'].'</option>';						
					?>
				</select>
				
			</div>		
		</div>
	
	
		<div class="form-group">
			<label for="id" class="col-sm-3 control-label">Compte * : </label>					
			<div class="col-sm-5">
				<select id="cathegorie" name="compte" class="form-control" disabled>
				
					<?php 						
						echo '<option>'.$operation->get_compteId().'</option>';											
					?>
				</select>
			</div>		
		</div>
		
		<div class="form-group">
			<label for="libelle" class="col-sm-3 control-label">Libelle * : </label>	
			<div class="col-sm-5">
				<input type="text" name="libelle" placeholder="entre 2 et 31 caracteres" class="form-control" value="<?php  echo $operation->get_libelle(); ?>"></input>
			</div>
		</div>
		<div class="form-group">
			<label for="date" class="col-sm-3 control-label">Date * : </label>	
			<div class="col-sm-5">
				<input type="date" name="date" class="form-control" value="<?php  echo $operation->get_date(); ?>"></input>
			</div>
		</div>
		<div class="form-group">
			<label for="montant" class="col-sm-3 control-label">Montant * : </label>	
			<div class="col-sm-5">
				<input type="text" name="montant" placeholder="0-9"  class="form-control" value="<?php  echo $operation->get_montant(); ?>"></input>
			</div>
		</div>
		
		<div class="form-group">
			<label for="id" class="col-sm-3 control-label">Ratacher a la Remise : </label>					
			<div class="col-sm-5">
				<select id="cathegorie" name="remise" class="form-control">	
				<!-- <option selected ><?php  echo $operation->get_remiseId(); ?></option>	-->	
					<option></option>
					<?php 	
						$remises =unserialize($_SESSION['remises']);
						$selected='';
						foreach($remises  as $remise)
						{
							if(isset($operation) && $operation->get_remiseId()==$remise->get_id()){
								$selected='selected';
							}	
							echo'<option value="'.$remise->get_id().'"'.$selected.'> Num : '.$remise->get_id().' Libelle '.$remise->get_libelle().'</option>';
							$selected='';
						}
						
					?>
					
				</select>
			</div>		
		</div>
		
	
	<div class="row">
		<div class="form-group">
			<label class="col-sm-3 control-label"></label>
			<div class="col-sm-5"><BR>
				<input type="submit" name="valider" value="Valider" class="btn btn-success col"></input>
				<input type="reset" name="annuler" value="Effacer" class="btn btn-warning col"></input>	
				<a href="../../controllers/operation/OperationListerCl.php"><input type="button" name="annuler" value="Retour" class="btn btn-danger col"></input>
			</div>
		</div>
	</div>
</fieldset>	
	</form>
</div>
<?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
?>