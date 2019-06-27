<?php 

	class Operation
	{
		protected $id;
		protected $libelle;	
		protected $date;
		protected $montant;
		protected $compteId;
		protected $remiseId=null;
		protected $msg_erreur; //enregistre les messages d'erreur
		
	//****************************************************** Constructeur ***************************************************
		
		function __construct($id,$libelle,$date,$montant,$compteId)
		{
			if(func_num_args()!=5)
			{
				throw new Exception('Constructeur d\'objet POperation : attend 5 arguments ');
				exit;
			}
			else
			{
				$this->set_id($id);
				$this->set_libelle($libelle);	
				$this->set_date($date);
				$this->set_montant($montant);
				$this->set_compteId($compteId);				
				
				if($this->get_msg_erreur()=='vide')
					return true;
				else{
					//throw new Exception('Constructeur class Operation : '.$this->get_msg_erreur());
					//return null;
					echo 'Constructeur class Operation :'.$this->get_msg_erreur();
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
				if(strlen($libelle)>30 || strlen($libelle)<3) 
				{
					$this->set_msg_erreur('Le labelle est invalide !');
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
		
		public function set_date($date)
		{	
			if (!empty($date))
			{	
				$date= htmlspecialchars($date); // On rend inoffensives les balises HTML que le visiteur a pu entrer
				if (preg_match("#^[0-9]{4}[/-]?[0-1][0-9][/-]?[0-3][0-9]$#", $date)) //controle de format de la saisie  sous forme aaaa(/-)mm(/-)jj
				{
					$aaaa=substr($date,0,4);    // on divise la date en aaaa mm jj   	
					$mm=substr($date,5,2);
					$jj=substr($date,8,2);		
										
					if(checkdate((int)$mm,(int)$jj,(int)$aaaa)) // checkdate valide la date saisie
					{
						if((int)$aaaa>2017 && (int)$aaaa<2999) // on impose une un intervale de date
						{								
							$this->date = $date;
							$retour = true;
						}
						else
						{						
							$this->set_msg_erreur('Date hors intervale autorise !');
							$retour = false;
						}
					}
					else
					{			
						$this->set_msg_erreur('Mauvaise date !');
						$retour = false;
					}
				}				
				else
				{
					if (preg_match("#^[0-3][0-9][/-]?[0-1][0-9][/-]?[0-9]{4}$#", $date)) //controle de format de la saisie  sous forme jj(/-)mm(/-)aaaa
					{	$aaaa=substr($date,6,4);    // on divise la date en aaaa, mm, jj   	
						$mm=substr($date,3,2);
						$jj=substr($date,0,2);		
										
						if(checkdate((int)$mm,(int)$jj,(int)$aaaa)) // checkdate valide la date saisie
						{
							if((int)$aaaa>2017 && (int)$aaaa<2999) // on impose une un intervale de date
							{	
								$this->date = $date;
								$retour=true;	
							}
							else
							{						
								$this->set_msg_erreur('Date hors intervale autorise !');
								$retour=false;	
							}
						}
					}	
					else
					{			
						$this->set_msg_erreur('Mauvaise date !');
						$retour=false;	
					}
				}
			}
			else
			{
				$this->set_msg_erreur('Date obligatoire!');
				$retour=false;	
			}
			return $retour;		
		}
		
		public function set_montant($montant)
		{
			$montant=trim(htmlspecialchars($montant)); // trim() néttoye les espaces, tabulation, saut de ligne ... en début et en fin de chaine
			
			if(!empty($montant)) // est ce qu montant est renseigné
			{
				if(is_numeric($montant) && $montant > 0 && $montant <10000000) 
				{
					$this->montant=$montant;
					$retour = true;	
				}
				else
				{
					$this->set_msg_erreur('Le montant est invalide !');
					$retour=false;					
				}
			}	
			else
			{
				$this->set_msg_erreur('Le montant est obligatoire !');
				$retour=false;							
			}
			return $retour;
		}
		
		public function set_compteId($compteId)
		{
			$compteId=trim(htmlspecialchars($compteId)); // trim() néttoye les espaces, tabulation, saut de ligne ... en début et en fin de chaine
			
			if(!empty($compteId)) // est ce qu compteId est renseigné
			{
				$this->compteId=$compteId;
				$retour=true;
			}	
			else
			{
				$this->set_msg_erreur('Le compteId est obligatoire !');
				$retour=false;							
			}
			return $retour;
		}
		public function set_remiseId($remiseId)
		{
			$remiseId=trim(htmlspecialchars($remiseId)); // trim() néttoye les espaces, tabulation, saut de ligne ... en début et en fin de chaine
			if(empty($remiseId))
				$remiseId=null;
			$this->remiseId=$remiseId;
			$retour=true;				
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
		public function get_date()
		{
			return $this->date;
		}
		public function get_montant()
		{
			return $this->montant;
		}
		public function get_compteId()
		{
			return $this->compteId;
		}
		public function get_remiseId()
		{
			return $this->remiseId;
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

<?php
/*
	$op = new Operation('111','ooooooo','23-11-2555','0.00001','123');
	var_dump($op);
	echo "</br>libelle : ".$op->get_libelle();
*/
?>
	