<?php 
session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/beneficiaire/Beneficiaire.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/header.php');
	
	if(isset($_GET['msgErreur'])){
		echo '<div  class="alert alert-info alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Info !   </strong>';
		echo $_GET['msgErreur'];
		echo '</div>';
	}	
?>

<div id="beneficiaire Beneficiaires">
<h1 class="display-4">Liste des Beneficiaires</h1>
    <table class="table table-striped">
        <thead>
          <tr>
              <th data-field="id">ID</th>
              <th data-field="nom">Nom</th>
              <th data-field="siret">Siret</th>
              <th data-field="ics">ICS</th>
			  <th data-field="categorie">Categorie</th>
          </tr>
        </thead>
        <tbody>
		<?php 
			$beneficiaires =unserialize($_SESSION['beneficiaires']);
			foreach($beneficiaires  as $beneficiaire){
				echo 	'<tr>
						<td>'.$beneficiaire->get_id().'</td>
						<td>'.$beneficiaire->get_nom().'</td>
						<td>'.$beneficiaire->get_siret().'</td>
						<td>'.$beneficiaire->get_ics().'</td>
						<td><a href="../../controllers/categorie/categorieVoirCl.php?id='.$beneficiaire->get_idCategorie().'">'.$beneficiaire->get_idCategorie().'</td></a>
						<td><a href="../../controllers/beneficiaire/beneficiaireVoirCl.php?id='. $beneficiaire->get_id().'"><input id="voir" type="button" value="Voir" class="btn btn-warning"></a></td>
						<td><a href="../../controllers/beneficiaire/beneficiaireModifierCl.php?id='.$beneficiaire->get_id().'"><input id="modifier" type="button" value="Modifier" class="btn btn-info"></a></td>
						<td><a href="../../controllers/beneficiaire/beneficiaireSupprimerCl.php?id='.$beneficiaire->get_id().'"><input id="supprimer" type="button" value="Supprimer" class="btn btn-danger"></a></td>
						</tr>';
				
				
				
			}
			
			
		?>
		
        </tbody>
      </table> <BR><BR> 
<a href="../../controllers/beneficiaire/beneficiaireCreerCl.php"><input id="creer" type="button" value="Creer" class="btn btn-success"></a>    
<a href="../../"><input id="accueil"  type="button" value="Accueil" class="btn btn-defaut active"></a>
</div>
  <?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
?>