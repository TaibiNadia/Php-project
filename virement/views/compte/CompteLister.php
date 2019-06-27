<?php 
	session_start();
	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/compte/Compte.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/header.php');
	if(isset($_GET['msgErreur'])){
		echo '<div  class="alert alert-info alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Info !   </strong>';
		echo $_GET['msgErreur'];
		echo '</div>';
	}
//var_dump($_SERVER);
//$url = $_SERVER['HTTP_REFERER'];
//var_dump($url);
//exit(0);	
?>
<h1 class="display-4">Liste des Comptes</h1>
<br><br>
<table class="table table-striped"> 
		<thead>
			<tr>
				<th>ID Compte</th>
				<th>ID Beneficiaire</th>
				<th>Libelle</th>
				<th>IBAN</th>
				<th>Action</th>					
			</tr>
		</thead>	   			   
	   <tbody>
		<?php
				if(isset($_SESSION['comptes']))
				{	
					$comptes =unserialize($_SESSION['comptes']);					
					foreach($comptes  as $compte)
					{	
						 echo'<tr class="clr_tr">
									
									<td>'. $compte->get_id().'</td>
									<td> <a href="../../controllers/beneficiaire/BeneficiaireVoirCl.php?id='.$compte->get_idbeneficiaire().'"target="_self"  >'. $compte->get_idbeneficiaire().'</a> </td>
									<td>'. $compte->get_libelle().'</td>
									<td>'. $compte->get_iban().'</td>
																	
									<td>'. '<a href="../../controllers/compte/CompteVoirCl.php?id='.$compte->get_id().'"target="_self" class="btn btn-warning" >Voir</a>'.'</td>
									<td>'. '<a href="../../controllers/compte/CompteModifierCl.php?id='.$compte->get_id().'"target="_self" class="btn btn-info">Modifier</a>'.'</td>
									<td>'. '<a href="../../controllers/compte/CompteSupprimerCl.php?id='.$compte->get_id().'"target="_self" class="btn btn-danger" >Supprimer</a>'.'</td>
								</tr>';
					}
				}
				else{
					echo "Aucun Compte trouve";
				}
		?>
		 
	   </tbody>
	</table>
	</br>
	<div>
		<a  href="../../controllers/compte/CompteCreerCl.php">
			<input type="button" name="creer" value="Creer" class="btn btn-success">
			<a href="../../"><input id="accueil"  type="button" value="Accueil" class="btn btn-defaut active"></a>
		</a>
	</div>
	
	<?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
	?>