<?php

	require($_SERVER['DOCUMENT_ROOT'].'/virement/models/categorie/Categorie.class.php');
	
	class CategorieDataAccess	{
		
		public function findAllCategorie()
		{			
			require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');						
			$requete = $bdd->prepare('select * from categorie'); //prepare la requete
			$requete->execute() or die(print_r($requete->errorInfo()));											
			$result=$requete->fetchall(PDO::FETCH_ASSOC);
			// fetchall(PDO::FETCH_ASSOC)retourne l'ensemble de données sous forme d'un tableau associatif
								
			if(empty($result))
				return false;
			else
			{
				foreach($result as $categorie)
				{						
					$categories[$categorie['cat_id']]=new Categorie($categorie['cat_id'],$categorie['cat_libelle']);	
				}
				$bdd=null;
				return $categories;
			}
		}
		
		public function findByIdCategorie($id){
				
			require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
			$requete = $bdd->prepare('select * from categorie where cat_id=?'); //prepare la requete 
			$requete->execute(array($id)) or die(print_r($requete->errorInfo()));	// execute la requete		
			
			if($result=$requete->fetch()){				
				$categorie = new Categorie($result['cat_id'],$result['cat_libelle']);
				return $categorie;
			}
			else{
				return false;
			}	
		}
		
		public function insertCategorie(Categorie $categorie)
		{	
			require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
			$requete = $bdd->prepare('select * from categorie where cat_id=?'); //prepare la requete 
			$requete->execute(array($categorie->get_id())) or die(print_r($requete->errorInfo()));	// execute la requete		
			
			if($result=$requete->fetch()){				
				
				return "Creation echouee :  ID EXISTE !!!";
			}
			else
			{	
				$sql='insert into categorie(cat_id,cat_libelle) values (?,?)';	
				
				$requete=$bdd->prepare($sql);					
				if($requete->execute(array($categorie->get_id(),$categorie->get_libelle())))
					return "Creation reussie" ;
				else
					return "Creation echouee !!!";
					
				$bdd=null;	
			}	
		}
		
		public function updateCategorie(Categorie $categorie)
		{		
			require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
			
			$sql =	'update categorie set cat_libelle=? where cat_id= ?	';		
			
			$requete=$bdd->prepare($sql);			
			
			if($requete->execute(array($categorie->get_libelle(),$categorie->get_id()))){
				
				$bdd=null;	
				return true;  //"Modification reussie";
			}
			else{
				$bdd=null;	
				return false; //"Modification echouee !!!";
			}
		}
		
		public function deleteCategorie(Categorie $categorie)
		{		
			require($_SERVER['DOCUMENT_ROOT'].'/virement/dataaccess/connect.php');
			
			$sql =	'delete from categorie where cat_id= ?	';		
			
			$requete=$bdd->prepare($sql);			
			
			if($requete->execute(array($categorie->get_id()))){
				
				$bdd=null;	
				return true;
			}
			else{
				$bdd=null;	
				return false;
			}
		}	
		
		
	}	
?>

