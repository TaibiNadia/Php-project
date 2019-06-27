<?php 
	session_start();
	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/remise/remise.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/header.php');
	
	if(isset($_GET['msgErreur'])){
		echo '<div  class="alert alert-info alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Alert !    </strong>';
		echo $_GET['msgErreur'];
		echo '</div>';
	}	
?>
<h1 class="display-4">Liste des Remises</h1>
<br><br>
<table class="table table-striped">
	 	<thead>
			<tr>
				<th>Id</th>
				<th>Libelle</th>				
				<th>Date</th>	
				<th>Motif</th>
				<th>Montant</th>
				<th>Etat</th>
				<th></th>
				<th></th>				
			</tr>
		</thead>	   			   
	   <tbody>
		<?php
				if(isset($_SESSION['remises']))
				{	
					$remises =unserialize($_SESSION['remises']);	
					$montantsRemises=unserialize($_SESSION['montantsRemises']);
					
					foreach($remises  as $remise){
					$montant=0;
					foreach($montantsRemises as $cle => $element){
						if($remise->get_id()==$element['id']){
							$montant =  $element['montant']; 
						}
					}
					  echo'<tr class="clr_tr">
									
									<td>'. $remise->get_id().'</td>
									<td>'. $remise->get_libelle().'</td>	
									<td>'. $remise->get_date().'</td>
									<td>'. $remise->get_motif().'</td>
									<td align="right">'. number_format($montant,2).'</td>';
									
									if($remise->get_valid() == 1) $valide = "valide"; else $valide = "pas valide";
									echo'
									<td>'.$valide.'</td>
									<td>'. '<a href="../../controllers/remise/remiseVoirCl.php?id='.$remise->get_id().'"target="_self" class="btn btn-warning" >Voir</a>'.'</td>
									<td>'. '<a href="../../controllers/remise/remiseModifierCl.php?id='.$remise->get_id().'"target="_self" class="btn btn-info">Modifier</a>'.'</td>
									<td>'. '<a href="../../controllers/remise/remiseSupprimerCl.php?id='.$remise->get_id().'"target="_self" class="btn btn-danger" >Supprimer</a>'.'</td>
								</tr>';
					    		
					}
				}
				else{
					echo "Aucune Remise trouvee ";
				}
		?>
		 
	   </tbody>
	</table>
	</br>
	<div>
		<a  href="../../controllers/remise/remiseCreerCl.php">
			<input type="button" name="creer" value=" Creer une remise  " class="btn btn-primary">
		</a> 
		<a  href="../../">
			<input type="button" name="accueil" value=" Accueil  " class="btn btn-primary">
		</a>
	</div>
	
	<?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
	?>