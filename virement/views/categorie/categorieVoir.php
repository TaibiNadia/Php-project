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
<h2>Detail d'une Categorie</h2><BR><BR>
<form action="#" method="POST" class="form-horizontal">
	<fieldset style="border:solid 0.05rem #e0dede;  padding:50px; color:gray; background-color:#f6f6f6;>
		<div class="row">
				<div class="form-group">
					<label for="id" class="col-sm-3 control-label">ID : </label>
					<div class="col-sm-5">		
						<input type="text" name="id" class="form-control" value="<?php echo $categorie->get_id(); ?>" disabled ="true"></input>
					</div>
				</div>
				
				<div class="form-group">
					<label for="libelle" class="col-sm-3 control-label">Libelle : </label>
					<div class="col-sm-5">	
						<input type="text" name="libelle" class="form-control" value="<?php echo $categorie->get_libelle(); ?>" disabled ="true"></input>
					</div>
				</div>
				<?php	
					if($_SERVER ["HTTP_REFERER"] =="http://localhost/virement/views/beneficiaire/beneficiaireLister.php")		
						$retour = "../../controllers/beneficiaire/beneficiaireListerCl.php";
					else
						$retour = "../../controllers/categorie/categorieListerCl.php";
				?>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div class="col-sm-5">	
						<a href="<?php echo $retour ?>" >
							<input type="button" name="retour" value=" Retour " class="btn btn-danger"></input>
						</a>
					</div>
				</div>
		</div>
	</fieldset>
</form>
<?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
?>