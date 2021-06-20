<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 27/09/2016
 * Time: 00:39
 */
class Client
{
    private $id;
    private $nom;
    private $date_create;
    private $date_update;

    public function __construct($id, $nom, $date_create, $date_update)
    {
        $this->id = $id;
        $this->nom  = $nom;
        $this->date_create = $date_create;
        $this->date_update = $date_update;
    }

    public function getDateCreate()
    {
        return $this->date_create;
    }

    public function getDateUpdate()
    {
        return $this->date_update;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }
}