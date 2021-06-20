<?php 
class Chauffeur{

	private $id;
	private $nom;
	private $cni;
	private $statut;
	private $contact;
	private $datecreate;
	private $dateModif;
	private $camion;

	public function __construct($id,$camion, $nom, $cni, $statut,  $contact, $datecreate, $dateModif){

		$this->id= $id;
		$this->camion= $camion;
		$this->nom= $nom;
		$this->cni= $cni;
		$this->statut = $statut;
		$this->contact= $contact;
		$this->datecreate= $datecreate;
		$this->dateModif= $dateModif;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}
	public function setIdCamion($camion)
	{
		$this->camion = $camion;
	}

	public function getIdCamion()
	{
		return $this->camion;
	}

	public function setNom($nom)
	{
		$this->nom = $nom;
	}

	public function getNom()
	{
		return $this->nom;
	}
	public function setcni($cni)
	{
		$this->cni= $cni;
	}

	public function getcni()
	{
		return $this->cni;
	}
	public function setStatus($statut)
	{
		$this->statut= $statut;
	}

	public function getStatus()
	{
		return $this->statut;
	}
	public function setContact($contact)
	{
		$this->contact= $contact;
	}

	public function getContact()
	{
		return $this->contact;
	}
	public function setDateCreate($datecreate)
	{
		$this->datecreate= $datecreate;
	}

	public function getDateCreate()
	{
		return $this->datecreate;
	}
	public function setDateModif($dateModif)
	{
		$this->dateModif= $dateModif;
	}

	public function getDateModif()
	{
		return $this->dateModif;
	}
	
	public function __toString()
	{
		return $this->nom;

	}
}