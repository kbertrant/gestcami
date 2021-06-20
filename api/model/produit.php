<?php 
class Produit{

	private $Id;
	private $Nom;
	private $description;
	private $DateModif;
	private $Datecreate;

	public function __construct($Id, $Nom, $description, $DateModif,  $Datecreate){
		$this->Id= $Id;
		$this->Nom= $Nom;
		$this->description= $description;
		$this->DateModif= $DateModif;
		$this->Datecreate= $Datecreate;
		
	}

	public function setId($Id)
	{
		$this->Id= $Id;
	}

	public function getId()
	{
		return $this-> Id;
	}
	public function setNom($Nom)
	{
		$this->Nom= $Nom;
	}

	public function getNom()
	{
		return $this-> Nom;
	}
	public function setDescription($description)
	{
		$this->description= $description;
	}

	public function getDescription()
	{
		return $this-> description;
	}
	public function setDateModif($DateModif)
	{
		$this->DateModif= $DateModif;
	}

	public function getDateModif()
	{
		return $this-> DateModif;
	}
	public function setDateCreate($Datecreate)
	{
		$this->Datecreate= $Datecreate;
	}

	public function getDateCreate()
	{
		return $this->Datecreate;
	}
	
	public function __toString()
	{
		return $this->Nom;

	}
}