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
			<strong>Info !   </strong>';
		echo $_GET['msgErreur'];
		echo '</div>';
	}
?>
<h2 class="display-4">Creation d'une Operation</h2>	<BR><BR>
<form action="../../controllers/operation/OperationCreerCl.php" method="POST" class="form-horizontal">
<fieldset style="border:solid 0.05rem #e0dede;  padding:50px; color:gray; background-color:#f6f6f6;>
<div class="row">
	<div class="form-group">
	<input type="submit" name="filtre" value="Filtrer" class="btn btn-info" ></input>
		<label for="id" class="col-sm-3 control-label">Categorie * : </label>				
		<div class="col-sm-5">
			<select id="categorie" name="categorie" class="form-control">
			<option></option>
				<?php 	
					$categories =unserialize($_SESSION['categories']);	
					$selected='';
					foreach($categories  as $categorie)
					{
						if(isset($_SESSION['categSelected']) && $_SESSION['categSelected']==$categorie->get_id()){
							$selected='selected';
						}						
						echo '<option value="'.$categorie->get_id().'"' .$selected.'>'.$categorie->get_libelle().'</option>';
						$selected='';
					}	
					if(isset($_SESSION['categSelected'])){
						unset($_SESSION['categSelected']);
					}					
						
				?>
			</select>
		</div>		
	</div>
		
	<form action="../../controllers/operation/OperationCreerCl.php" method="POST" class="form-horizontal">	
		<div class="form-group">
		<input type="submit" name="compte" value="Selectionner"  class="btn btn-info col" ></input>
			<label for="id" class="col-sm-3 control-label">Beneficiaire * : </label>					
			<div class="col-sm-5">
				<select id="cathegorie" name="beneficiaire" class="form-control">
					<?php 	
						$beneficiaires =unserialize($_SESSION['beneficiaires']);
						$selected='';
						foreach($beneficiaires  as $beneficiaire)
						{							
							if(isset($_SESSION['benefSelected']) && $_SESSION['benefSelected']==$beneficiaire->get_id()){
							$selected='selected';
							}						
							echo '<option value= "'.$beneficiaire->get_id().'"' .$selected.'>'.$beneficiaire->get_nom().'</option>';
							$selected='';
						}	
						if(isset($_SESSION['benefSelected'])){
							unset($_SESSION['benefSelected']);
							unset($_SESSION['beneficiaires']);
						}
						
					?>
				</select>
			</div>		
		</div>
	
	<form action="../../controllers/operation/OperationCreerCl.php" method="POST" class="form-horizontal">	
		<div class="form-group">
			<label for="id" class="col-sm-3 control-label">Compte * : </label>					
			<div class="col-sm-5">
				<select id="cathegorie" name="compte" class="form-control">
				
					<?php 	
						$comptes =unserialize($_SESSION['comptes']);	
						foreach($comptes  as $compte)
						{
							echo'<option value="'.$compte->get_id().'">'.$compte->get_libelle().'  IBAN : '.$compte->get_iban().'</option>';
						}	
						unset($_SESSION['comptes']);
					?>
				</select>
			</div>		
		</div>
		
		<div class="form-group">
			<label for="libelle" class="col-sm-3 control-label">Libelle * : </label>	
			<div class="col-sm-5">
				<input type="text" name="libelle" class="form-control" placeholder= "entre 2 et 31 caracteres" value=""></input>
			</div>
		</div>
		<div class="form-group">
			<label for="date" class="col-sm-3 control-label">Date * : </label>	
			<div class="col-sm-5">
				<input type="date" name="date" class="form-control" value=""></input>
			</div>
		</div>
		<div class="form-group">
			<label for="montant" class="col-sm-3 control-label">Montant * : </label>	
			<div class="col-sm-5">
				<input type="text" name="montant" placeholder= "0-9" class="form-control" value=""></input>
			</div>
		</div>
		
		<div class="form-group">
			<label for="id" class="col-sm-3 control-label">Ratacher a la Remise : </label>					
			<div class="col-sm-5">
				<select id="cathegorie" name="remise" class="form-control">	
				<option></option>
					<?php 	
						$remises =unserialize($_SESSION['remises']);	
						foreach($remises  as $remise)
						{
							//echo'<option>'.$remise->get_id().' '.$remise->get_libelle().'</option>';
							echo'<option value="'.$remise->get_id().'"> Num : '.$remise->get_id().' Libelle '.$remise->get_libelle().'</option>';
						}
					?>
				</select>
			</div>		
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label"></label>
			<div class="col-sm-5"><BR>
				<input type="submit" name="valider" value="Valider" class="btn btn-success col"></input>
				<input type="reset" name="annuler" value="Effacer" class="btn btn-warning"></input>	
				<a href="../../controllers/operation/OperationListerCl.php"><input type="button" name="annuler" value="Retour" class="btn btn-danger col"></input>
			</div>
		</div>
</div>
	</fieldset>
	</form>

<?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
?>