<?php 
	class Compte
	{
		protected $id;
		protected $idBeneficiaire;
		protected $libelle;
		protected $iban;
		
		protected $msg_erreur; //enregistre les messages d'erreur
		
	//****************************************************** Constructeur ***************************************************
		
		function __construct($id,$idBeneficiaire,$libelle,$iban)
		{
			if(func_num_args()!=4)
			{
				throw new Exception('Constructeur d\'objet Compte : attend 4 arguments ');
				exit;
			}
			else
			{
				$this->set_id($id);
				$this->set_idBeneficiaire($idBeneficiaire);
				$this->set_libelle($libelle);
				$this->set_iban($iban);
			
				
				
				if($this->get_msg_erreur()=='vide')
					return true;
				else
					throw new Exception('Constructeur class Compte : '.$this->get_msg_erreur());
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
	// ******************** set idBeneficiaire *********************************************
		public function set_idBeneficiaire($idBeneficiaire)
		{
			$idBeneficiaire=trim(htmlspecialchars($idBeneficiaire)); // trim() néttoye les espaces, tabulation, saut de ligne ... en début et en fin de chaine
			
			if(!empty($idBeneficiaire)) // est ce qu nom est renseigné
			{
				if(strlen($idBeneficiaire)>30 || strlen($idBeneficiaire)<2) 
				{
					$this->set_msg_erreur('Le idBeneficiaire est invalide !');
					$retour=false; 							
				}
				else
				{
					$this->idBeneficiaire=$idBeneficiaire;
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
	//*************************** set libelle****************
		
		public function set_libelle($libelle)
		{
			$libelle=trim(htmlspecialchars($libelle)); // trim() néttoye les espaces, tabulation, saut de ligne ... en début et en fin de chaine
				
			if(!empty($libelle)) // est ce qu siret est renseigné
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
				$this->set_msg_erreur('Le libelle est obligatoire !');
				$retour=false;							
			}
			return $retour;
		}
		
	//*********************** set_iban *************************
	
		public function set_iban($iban)
		{
			if(!empty($iban)) // est ce qu pwd est renseigné
			{	
				$pwd=trim(htmlspecialchars($iban));
				if(strlen($iban)>30 || strlen($iban)<4) 
				{
					$retour=false;
					$this->set_msg_erreur('La taille du iban est invalide !');				
				}					
				else
				{
					$this->iban=$iban;
					$retour=true;					
				}
			}	
			else
			{
				$retour=false;
				$this->set_msg_erreur('Le iban est obligatoire  !');					
			}
			return $retour;
		}
		
	
	//****************************************************** Getters ***************************************************
		public function get_id()
		{
			return $this->id;
		}
		public function get_idBeneficiaire()
		{
			return $this->idBeneficiaire;
		}
		public function get_libelle()
		{
			return $this->libelle;
		}
		public function get_iban()
		{
			return $this->iban;
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