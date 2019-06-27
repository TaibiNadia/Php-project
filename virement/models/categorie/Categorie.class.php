<?php 

	class Categorie
	{
		protected $id;
		protected $libelle;		
		protected $msg_erreur; //enregistre les messages d'erreur
		
	//****************************************************** Constructeur ***************************************************
		
		function __construct($id,$libelle)
		{
			if(func_num_args()!=2)
			{
				throw new Exception('Constructeur d\'objet Personne : attend 2 arguments ');
				exit;
			}
			else
			{
				$this->set_id($id);
				$this->set_libelle($libelle);				
				
				if($this->get_msg_erreur()=='vide')
					return true;
				else{
					throw new Exception('Constructeur class Personne : '.$this->get_msg_erreur());
					//return null;
				}	
			}
		}
	//****************************************************** setters ***************************************************
		public function set_msg_erreur($msg_erreur)
		{
			$this->msg_erreur=$this->msg_erreur.$msg_erreur.'<br />';
		}
		
		public function set_id($id)
		{
			$this->id=$id;
		}
		
		public function set_libelle($libelle)
		{
			$libelle=trim(htmlspecialchars($libelle)); // trim() néttoye les espaces, tabulation, saut de ligne ... en début et en fin de chaine
			
			if(!empty($libelle)) // est ce qu libelle est renseigné
			{
				if(strlen($libelle)>30 || strlen($libelle)<4) 
				{
					$this->set_msg_erreur('Le libelle est invalide !');
					$retour=false; 							
				}
				else
				{
					$this->libelle=$libelle;
					$retour=true;					
				}
			}	
			else
			{
				$this->set_msg_erreur('Le libelle est obligatoire !');
				$retour=false;							
			}
			return $retour;
		}
	
		
	//****************************************************** Getters ***************************************************
		public function get_id()
		{
			return $this->id;
		}
		public function get_libelle()
		{
			return $this->libelle;
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