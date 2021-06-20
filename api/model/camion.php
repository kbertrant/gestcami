<?php

class Camion{
	private $id;
	private $id_trans;
    private $matricule;
    private $tonnage;
	private $couleur;
    private $marque;
    private $photo;
    private $dateCreation;
    private $dateModification;

	public function __construct($id , $id_trans, $matricule , $tonnage, $couleur, $marque, $photo , $dateCreation , $dateModification){
			$this->id = $id;
			$this->id_trans = $id_trans;
      $this->matricule = $matricule;
      $this->tonnage= $tonnage;
      $this->couleur = $couleur;
      $this->marque = $marque;
      $this->photo = $photo;
      $this->dateCreation = $dateCreation;
      $this->dateModification = $dateModification;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getIdTrans()
	{
		return $this->id_trans;
	}

    public function getCouleur()
    {
        return $this->couleur;
    }

    public function getMarque()
    {
        return $this->marque;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setTonnage($tonnage)
    {
        $this->tonnage = $tonnage;
    }
    public function setMatricule($matricule)
	{
		$this->matricule = $matricule;
	}
    public function getMatricule()
	{
		return $this->matricule;
	}

    public function setTonage($poste)
	{
		$this->tonnage = $tonnage;
	}
    public function getTonnage()
	{
		return $this->tonnage;
	}


    public function setDatecreation($dateCreation)
	{
		$this->dateCreation = $dateCreation;
	}
    public function getDatecreation()
	{
		return $this->dateCreation;
	}


    public function setDatemodification($dateModification)
	{
		$this->dateModification = $dateModification;
	}
    public function getDatemodification()
	{
		return $this->dateModification;
	}
	public function __toString()
	{
        return $this->matricule;
	}
}
