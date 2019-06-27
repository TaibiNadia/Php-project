<?php 
	session_start();
	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/operation/Operation.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/header.php');
	
	if(isset($_GET['msgErreur'])){
		echo '<div  class="alert alert-info alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Info !   </strong>';
		echo $_GET['msgErreur'];
		echo '</div>';
	}	
?>
<h1>Liste des Operations</h1>
<table class="table table-striped">   
		<thead>
			<tr>
				<th>ID</th>
				<th>Libelle</th>				
				<th>Date</th>	
				<th>Montant</th>
				<th>Compte</th>
				<th>Remise</th>
				<th></th>
				<th></th>				
			</tr>
		</thead>	   			   
	   <tbody>
		<?php
				if(isset($_SESSION['operations']))
				{	
					$operations =unserialize($_SESSION['operations']);					
					foreach($operations  as $operation)
					{	
						 echo'<tr class="clr_tr">
									
									<td>'. $operation->get_id().'</td>
									<td>'. $operation->get_libelle().'</td>	
									<td>'. $operation->get_date().'</td>
									<td align = "right" >'. $operation->get_montant().'</td>
									<td><a href="../../controllers/compte/compteVoirCl.php?id='.$operation->get_compteId().'"target="_self" >'.$operation->get_compteId().'</a></td>
									<td><a href="../../controllers/remise/remiseVoirCl.php?id='.$operation->get_RemiseId().'"target="_self" >'. $operation->get_RemiseId().'</a></td>
									<td>'. '<a href="../../controllers/operation/operationVoirCl.php?id='.$operation->get_id().'"target="_self" class="btn btn-warning" >Voir</a>'.'</td>
									<td>'. '<a href="../../controllers/operation/operationModifierCl.php?id='.$operation->get_id().'"target="_self" class="btn btn-info">Modifier</a>'.'</td>
									<td>'. '<a href="../../controllers/operation/operationSupprimerCl.php?id='.$operation->get_id().'"target="_self" class="btn btn-danger" >Supprimer</a>'.'</td>
								</tr>';
					}
				}
				else{
					echo "Aucune Categorie trouvee ";
				}
		?>
		 
	   </tbody>
	</table>
	</br>
	<div>
		<a  href="../../controllers/operation/operationCreerCl.php">
			<input type="button" name="creer" value=" Creer" class="btn btn-success">
		</a> 
		<a  href="../../">
			<input type="button" name="accueil" value="Accueil" class="btn btn-active">
		</a>
	</div>
	
	<?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
	?>