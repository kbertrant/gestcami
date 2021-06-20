<?php  

class Transporteur
{
	private $id;
    private $nom;
    private $contact;
    private $dossier_fiscale;
    private $name_interne;
    private $date_create;
    private $date_modification;
    private $numero_interne;
    private $tmp;

    public function __construct($id = null, $nom, $contact, $dossier, $name, $dateC, $dateU, $num, $tmp)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->contact = $contact;
        $this->dossier_fiscale = $dossier;
        $this->name_interne = $name;
        $this->date_create = $dateC;
        $this->date_modification = $dateU;
        $this->numero_interne = $num;
        $this->tmp = $tmp;
    }

    public function getContact()
    {
        return $this->contact;
    }

    public function getTmp()
    {
        return $this->tmp;
    }

    public function getDateCreate()
    {
        return $this->date_create;
    }

    public function getDateModification()
    {
        return $this->date_modification;
    }

    public function getDossierFiscale()
    {
        return $this->dossier_fiscale;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNameInterne()
    {
        return $this->name_interne;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getNumeroInterne()
    {
        return $this->numero_interne;
    }
}