<?php
class User{
    private $id;
	private $nom;
    private $prenom;
    private $pseudo;
    private $password;
    private $poste;
    private $date_create;
    private $date_update;

    public function __construct($id = null, $nom, $prenom, $pseudo, $password, $poste, $date_create, $date_update)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->pseudo = $pseudo;
        $this->password = $password;
        $this->poste = $poste;
        $this->date_create = $date_create;
        $this->date_update = $date_update;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDateUpdate()
    {
        return $this->date_update;
    }

    public function getDateCreate()
    {
        return $this->date_create;
    }

    public function getPoste()
    {
        return $this->poste;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setDateCreate($date_create)
    {
        $this->date_create = $date_create;
    }

    public function setDateUpdate($date_update)
    {
        $this->date_update = $date_update;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setPoste($poste)
    {
        $this->poste = $poste;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }
}

