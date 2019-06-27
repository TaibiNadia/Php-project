<?php
session_start();
   require($_SERVER['DOCUMENT_ROOT'].'/virement/views/header.php');
   require($_SERVER['DOCUMENT_ROOT'].'/virement/models/beneficiaire/Beneficiaire.class.php');
   
   $beneficiaire = unserialize($_SESSION['beneficiaire']);
   //var_dump($beneficiaire);
?>
<h2 class="display-4">Detail du Beneficiaire</h2><BR><BR>
<form id="beneficiaire-voir" action="../../controllers/beneficiaire/beneficiaireVoirCl.php" method="POST" class="form-horizontal">
	
	<fieldset style="border:solid 0.05rem #e0dede;  padding:50px; color:gray; background-color:#f6f6f6;>
		<div class="row">
			<div class="form-group">
				<label for="id" class="col-sm-3 control-label">ID : </label>	
				<div class="col-sm-5">
					<input type="text" name="id" class="form-control" value="<?php echo $beneficiaire->get_id(); ?>" disabled ="true"></input>			
				</div>
			</div>
			
			<div class="form-group">
				<label for="nom" class="col-sm-3 control-label">Nom : </label>	
				<div class="col-sm-5">
					<input type="text" name="nom" class="form-control" value="<?php echo $beneficiaire->get_nom(); ?>" disabled ="true"></input>
				</div>
			</div>
			
			<div class="form-group">
				<label for="siret" class="col-sm-3 control-label">Siret : </label>
				<div class="col-sm-5">		
					<input type="text" name="siret" class="form-control" value="<?php echo $beneficiaire->get_siret(); ?>" disabled ="true"></input>
				</div>
			</div>
			
			<div class="form-group">
				<label for="ics" class="col-sm-3 control-label">ICS : </label>	
				<div class="col-sm-5">
					<input type="text" name="ics" class="form-control" value="<?php echo $beneficiaire->get_ics(); ?>" disabled ="true"></input>
				</div>
			</div>
			
			<div class="form-group">
				<label for="categorie" class="col-sm-3 control-label">Categorie : </label>	
				<div class="col-sm-5">
					<input type="text" name="categorie" value="<?php echo $beneficiaire->get_idCategorie();?>" size="20" maxlength="35" disabled="disabled" id="beneficiaire-voir-categorie" class="form-control">
				</div>
			</div>
			
			<div class="form-group">
					<label class="col-sm-3 control-label"></label>
								
					<?php
						
						if($_SERVER ["HTTP_REFERER"] =="http://localhost/virement/views/beneficiaire/beneficiaireLister.php")		
							$retour = "../../controllers/beneficiaire/beneficiaireListerCl.php";
						else
							$retour = "../../controllers/compte/compteListerCl.php";
					?>
					<div class="col-sm-5"><BR>
					<a href="<?php echo $retour ?>" ><input type="button" name="retour" value="Retour" id="voir-retour" class="btn btn-danger" ></a>
					</div>
			</div>
		</div>
	</fieldset>
</form>

 <?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
?>