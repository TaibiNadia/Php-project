<?php 
	class Beneficiaire
	{
		protected $id;
		protected $nom;
		protected $siret;
		protected $ics;
		protected $idCategorie;
		
		protected $msg_erreur; //enregistre les messages d'erreur
		
	//****************************************************** Constructeur ***************************************************
		
		function __construct($id,$nom,$siret,$ics,$idCategorie)
		{
			if(func_num_args()!=5)
			{
				throw new Exception('Constructeur d\'objet Beneficiaire : attend 5 arguments ');
				exit;
			}
			else
			{
				$this->set_id($id);
				$this->set_nom($nom);
				$this->set_siret($siret);
				$this->set_ics($ics);
				$this->set_idCategorie($idCategorie);
				
				
				if($this->get_msg_erreur()=='vide')
					return true;
				else
					throw new Exception('Constructeur class Beneficiaire : '.$this->get_msg_erreur());
			}
		}
	//****************************************************** setters ***************************************************
		public function set_msg_erreur($msg_erreur)
		{
			$this->msg_erreur=$this->msg_erreur.$msg_erreur.'<br />';
		}
	// ******************** set id ***************************************
		public function set_id($id)
		{
			$this->id=$id;
		}
	// ******************** set nom *********************************************
		public function set_nom($nom)
		{
			$nom=trim(htmlspecialchars($nom)); // trim() néttoye les espaces, tabulation, saut de ligne ... en début et en fin de chaine
			
			if(!empty($nom)) // est ce qu nom est renseigné
			{
				if(strlen($nom)>30 || strlen($nom)<2) 
				{
					$this->set_msg_erreur('Le nom est invalide !');
					$retour=false; 							
				}
				else
				{
					$this->nom=$nom;
					$retour=true;					
				}
			}	
			else
			{
				$this->set_msg_erreur('Le nom est obligatoire !');
				$retour=false;							
			}
			return $retour;
		}
	//*************************** set siret****************
		
		public function set_siret($siret)
		{		
			$siret=trim(htmlspecialchars($siret)); // trim() néttoye les espaces, tabulation, saut de ligne ... en début et en fin de chaine
				
			if(!empty($siret)) // est ce qu siret est renseigné
			{
				if(strlen($siret) != 14) 
				{
					$this->set_msg_erreur('Le siret est invalide !');
					$retour=false; 							
				}
				else
				{
					$this->siret=$siret;
					$retour=true;					
				}
			}	
			else
			{
				$siret="";
				$this->siret=$siret;
				$retour=true;							
			}
		}
		
	//*********************** set_ics *************************
	
		public function set_ics($ics)
		{
			if(!empty($ics)) // est ce qu pwd est renseigné
			{	
				$pwd=trim(htmlspecialchars($ics));
				if(strlen($ics)<1 || strlen($ics)>15) 
				{
					$retour=false;
					$this->set_msg_erreur('La taille du ics est invalide !');				
				}					
				else
				{
					$this->ics=$ics;
					$retour=true;					
				}
			}	
			else
			{
				$retour=false;
				$this->set_msg_erreur('Le ics est obligatoire  !');					
			}
			return $retour;
		}
		
	//**************************** set_idCategorie *****************
		
		public function set_idCategorie($idCategorie)
		{
			if(!empty($idCategorie)) // est ce qu idCategorie est renseigné
			{
				$login=trim(htmlspecialchars($idCategorie));
				if(strlen($idCategorie)>30 || strlen($idCategorie)<2) 
				{
					$retour=false;
					$this->set_msg_erreur('La taille de la idCategorie est invalide !');				
				}
				else
				{
					$this->idCategorie=$idCategorie;
					$retour=true;					
				}
			}	
			else
			{
				$retour=false; //pas renseigné
				$this->set_msg_erreur('Le idCategorie est obligatoire !');				
			}
			return $retour;
		}
	
		
		
	//****************************************************** Getters ***************************************************
		public function get_id()
		{
			return $this->id;
		}
		public function get_nom()
		{
			return $this->nom;
		}
		public function get_siret()
		{
			return $this->siret;
		}
		public function get_ics()
		{
			return $this->ics;
		}
		public function get_idCategorie()
		{
			return $this->idCategorie;
		}
		public function get_msg_erreur()
		{
			if(empty($this->msg_erreur))
				return 'vide';			
			else
				return $this->msg_erreur;
		}
		
	}
?>