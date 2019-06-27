<?php
	session_start();
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/header.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/remise/remise.class.php');
	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/operation/operation.class.php');
   
	if(isset($_GET['msgErreur'])){
	echo '<div  class="alert alert-info alert-dismissible"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Alert !    </strong>';
	echo $_GET['msgErreur'];
	echo '</div>';
	}
   
   $remise = unserialize($_SESSION['remise']);
   $montantRemise = unserialize($_SESSION['montantRemise']);
   $nbOperationsRemise = unserialize($_SESSION['nbOperationsRemise']);
   $operationsRemise = unserialize($_SESSION['operationsRemise']);
   $operationsSansRemise = unserialize($_SESSION['operationsSansRemise']);
   $remiseValide = unserialize($_SESSION['remiseValide']);
  
   $action=0;
   if($montantRemise==null){
	 $montantRemise="0";  
   }
   
?>
<h1>Detail d'une Remise</h1>

<table  class="table table-bordered col-md-1">
   
   <tr>
      <td>Nom de la Remise :</td>
      <td><?php echo '  '.$remise->get_libelle();?></td>
      
   </tr>
   <tr>
      <td>Date d'execution  :</td>
      <td><?php echo '  '.$remise->get_date();?></td>
     
   </tr>
    <tr>
      <td>Motif : </td>
      <td><?php echo '  '.$remise->get_motif();?></td>     
   </tr>
   <tr>
      <td>Nombre d operations  : </td>
      <td><?php echo '  '.$nbOperationsRemise;?></td>     
   </tr>
   <tr>
      <td>Montant : </td>
      <td><?php echo '  '.$montantRemise;?></td>     
   </tr>
</table>

<table class="table table-striped">
<?php

    if(!empty($operationsRemise)){	
?>	    <br/><br/>
		<h3>Liste des Operations Attachees  </h3>
		<thead>
			<tr>
				<th>Libelle</th>				
				<th>Beneficiaire</th>	
				<th>Date</th>
				<th>Montant</th>
				<th></th>
				<th></th>				
			</tr>
		</thead>
	<?php }
?>	
	   <tbody>
	   <?php
	   $idRemise=$remise->get_id();
	   $action=1;
	   foreach($operationsRemise  as $cle => $operation){
		//   var_dump($operation);
	    echo'<tr class="clr_tr">
									
									<td>'. $operation['libelle'].'</td>
									<td>'. $operation['id_ben'].'</td>	
									<td>'. $operation['date'].'</td>
									<td>'. $operation['montant'].'</td>
									<td>'.'<a  href="../../controllers/remise/remiseVoirCl.php?id='.$operation['id'].'&idRemise='.$idRemise.'&action='.$action.'">
			                        <input type="button" name="detacher" value=" Detacher  " class="btn btn-primary"></a></td>
								    </tr>';
	   
	   
	   }
	   ?> 
       </tbody>
</table>
</br>
</br>
</br>
<table class="table table-striped">
<?php
if (!empty($operationsSansRemise) && $remiseValide !='1' ){
?>
	   <caption>Liste des Operations Attachees a aucune remise </caption>	   
		<thead>
			<tr>
				<th>Libelle</th>				
				<th>Beneficiaire</th>	
				<th>Date</th>
				<th>Montant</th>
				<th></th>
				<th></th>				
			</tr>
		</thead>
<?php
}
?>		
	   <tbody>
	   <?php
	   if ($remiseValide !='1'){
	   foreach($operationsSansRemise  as $key => $operationSansRemise){
		$action=2;   
		//echo $action;
		//echo $idRemise;
		//echo $operationSansRemise['id'];
		 echo'<tr class="clr_tr">
									
									<td>'. $operationSansRemise['libelle'].'</td>
									<td>'. $operationSansRemise['id_ben'].'</td>	
									<td>'. $operationSansRemise['date'].'</td>
									<td>'. $operationSansRemise['montant'].'</td>
									<td>'.'<a  href="../../controllers/remise/remiseVoirCl.php?id='.$operationSansRemise['id'].'&idRemise='.$idRemise.'&action='.$action.'">
			                        <input type="button" name="attacher" value=" Attacher  " class="btn btn-primary"></a></td>
								    </tr>';
	   
	   
	   }
	   }
	   ?> 
       </tbody>
</table>
	</br>
<?php	
	if($_GET['action']==3){
		
		include_once('auth.php');
	}
	
?>		
	<div>
		<a  href="../../views/remise/remiseVoir.php?id=<?php echo $idRemise?>&action=3">
			<input type="button" name="valider" value=" Valider  " class="btn btn-primary">
		</a> 
		<a  href="../../controllers/remise/remiseListerCl.php">
			<input type="button" name="retour" value=" retour  " class="btn btn-primary">
		</a>
	</div>
 <?php
	require($_SERVER['DOCUMENT_ROOT'].'/virement/views/footer.php');
?>