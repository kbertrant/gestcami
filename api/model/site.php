<?php

class Site{
	private $id;
	private $nomSite;
    private $regioSite;
    private $dateModifSite;
    private $dateCreatSite;
    private $prixFacture;
    private $prixTransp;
   

	public function __construct($id, $nomSite, $regioSite, $dateModifSite, $datecreatSite, $prixFacture, $prixTransp){
		$this->id = $id;
		$this->nomSite = $nomSite;
        $this->regioSite = $regioSite;
        $this->dateModifSite = $dateModifSite;
        $this->dateCreatSite = $datecreatSite;
        $this->prixFacture = $prixFacture;
        $this->PrixTransp = $prixTransp;
    
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setNomSite($nomSite)
	{
		$this->nomSite = $nomSite;
	}

	public function getNomSite()
	{
		return $this->nomSite;
	}

    public function setRegioSite($regioSite)
    {
        $this->regioSite = $regioSite;
    }

    public function getRegioSite()
    {
        return $this->regioSite;
    }

    public function setDateModifSite($datemoifSite)
    {
        $this->datemodifSite = $datemodifSite;
    }

    public function getDateModifSite()
    {
        return $this->dateModifSite;
    }

    public function setDateCreatSite($dateCreatSite)
    {
        $this->dateCreatSite = $dateCreatSite;
    }

    public function getDateCreatSite()
    {
        return $this->dateCreatSite;
    }

    public function setPrixFacture($prixFacture)
    {
        $this->prixFacture = $prixFacture;
    }

    public function getPrixFacture()
    {
        return $this->prixFacture;
    }

    public function setPrixTransp($PrixTransp)
    {
        $this->PrixTransp = $PrixTransp;
    }

    public function getPrixTransp()
    {
        return $this->PrixTransp;
    }

   

	public function __toString()
	{
		return $this->nomSite;

	}
}