<?php 
	class Remise
	{
		protected $id;
		protected $libelle;
		protected $date;
		protected $motif;	
		protected $valid;
		
		protected $msg_erreur; //enregistre les messages d'erreur
		
	//****************************************************** Constructeur ***************************************************
		
		function __construct($id,$libelle,$date,$motif,$valid)
		{
			if(func_num_args()!=5)
			{
				throw new Exception('Constructeur d\'objet Remise : attend 5 arguments ');
				exit;
			}
			else
			{
				$this->set_id($id);
				$this->set_libelle($libelle);
				$this->set_date($date);
				$this->set_motif($motif);
				$this->set_valid($valid);				
				if($this->get_msg_erreur()=='vide')
					return true;
				else
					throw new Exception('Constructeur class Remise ooooooooooo : '.$this->get_msg_erreur());
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
		// ******************** set id ***************************************
		public function set_valid($valid)
		{
			$this->valid=$valid;
		}
	// ******************** set libelle *********************************************
		public function set_libelle($libelle)
		{
			$libelle=trim(htmlspecialchars($libelle)); // trim() néttoye les espaces, tabulation, saut de ligne ... en début et en fin de chaine
			
			if(!empty($libelle)) // est ce qu nom est renseigné
			{
				if(strlen($libelle)>30 || strlen($libelle)<2) 
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
				$this->set_msg_erreur('Le idBeneficiare est obligatoire !');
				$retour=false;							
			}
			return $retour;
		}
	//*************************** set date****************
		
		public function set_date($date)
		{
			$date=trim(htmlspecialchars($date)); // trim() néttoye les espaces, tabulation, saut de ligne ... en début et en fin de chaine
				
			if(!empty($date)) // est ce qu siret est renseigné
			{
				if(strlen($date)>30 || strlen($date)<2) 
				{
					$this->set_msg_erreur('Le date est invalide !');
					$retour=false; 							
				}
				else
				{
					$this->date=$date;
					$retour=true;					
				}
			}	
			else
			{
				$this->set_msg_erreur('Le date est obligatoire !');
				$retour=false;							
			}
			return $retour;
		}
		
	//*********************** set_motif *************************
	
		public function set_motif($motif)
		{
			if(strlen($motif)>300) 
			{
				$this->set_msg_erreur('La taille du motif est invalide !');	
				$retour=false;	
			}					
			else
			{
				$this->motif=$motif;
				$retour=true;					
			}
			return $retour;
		}
		
	
	//****************************************************** Getters ***************************************************
		public function get_id()
		{
			return $this->id;
		}
		public function get_valid()
		{
			return $this->valid;
		}
		public function get_libelle()
		{
			return $this->libelle;
		}
		public function get_date()
		{
			return $this->date;
		}
		public function get_motif()
		{
			return $this->motif;
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