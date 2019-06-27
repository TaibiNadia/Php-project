<?php 
	session_start();
	
	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/categorie/Categorie.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/header.php');
	
	if(isset($_GET['msgErreur'])){
		echo '<div  class="alert alert-info alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Info !   </strong>';
		echo $_GET['msgErreur'];
		echo '</div>';
	}	
?>
<h1>Liste des Categories</h1>
<table class="table table-striped">   
		<thead>
			<tr>
				<th>Id</th>
				<th>Libelle</th>
				<th>Action</th>					
				<th></th>
				<th></th>				
			</tr>
		</thead>	   			   
	   <tbody>
		<?php
				if(isset($_SESSION['categories']))
				{	
					$categories =unserialize($_SESSION['categories']);					
					foreach($categories  as $categorie)
					{	
						 echo'<tr class="clr_tr">
									
									<td>'. $categorie->get_id().'</td>
									<td>'. $categorie->get_libelle().'</td>																
									<td>'. '<a href="../../controllers/categorie/categorieVoirCl.php?id='.$categorie->get_id().'"target="_self" class="btn btn-warning" >Voir</a>'.'</td>
									<td>'. '<a href="../../controllers/categorie/categorieModifierCl.php?id='.$categorie->get_id().'"target="_self" class="btn btn-info">Modifier</a>'.'</td>
									<td>'. '<a href="../../controllers/categorie/categorieSupprimerCl.php?id='.$categorie->get_id().'"target="_self" class="btn btn-danger" >Supprimer</a>'.'</td>
								</tr>';
					}
				}
				else{
					echo "Aucune Categorie trouvee !";
				}
		?>
		 
	   </tbody>
	</table>
	</br>
	<div><BR> 
		<a  href="../../controllers/categorie/categorieCreerCl.php">
			<input type="button" name="creer" value=" Creer" class="btn btn-success">
		</a> 
		
		<a  href="../../">
			<input type="button" name="acceuil" value=" Accueil  " class="btn btn-active">
		</a>
	</div>
	<div>
		
	</div>
	
	<?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
	?>