<?php

class ProduitCtrl{

	private $conn;
	private $table = "produit";

	public function __construct($conn)
	{
		$this->conn =$conn;
	}

	public function get()
	{
		$query = 'SELECT * FROM ' . $this->table;

        $statement = $this->conn->prepare($query);

        $statement->execute();

        return $statement;
	}

	  public function getById($Id){
        $query = 'SELECT * FROM '.$this->table.' WHERE ID_PRODUIT = ' . $Id;

        $statement = $this->conn->prepare($query);

        $statement->execute();

        return $statement;
    }

    public function getByNom($Nom){
        $query = 'SELECT * FROM '.$this->table.' WHERE NOM_PRODUIT = "' . $Nom . '"';

        $statement = $this->conn->prepare($query);

        $statement->execute();

        return $statement;
    }

    public function insert(Produit $model){
        $query = "INSERT INTO " . $this->table . "(NOM_PRODUIT, DESCRIPTION, DATE_CREAT_PRO, DATE_MODIF_PRO) VALUES (:nom, :description, :datecreate, :datemodification)";

        $statement = $this->conn->prepare($query);

        $statement->bindValue(":nom", $model->getNom(), PDO::PARAM_STR);
        $statement->bindValue(":description", $model->getDescription(), PDO::PARAM_STR);
        $statement->bindValue(":datemodification", $model->getDateModif(), PDO::PARAM_STR);
        $statement->bindValue(":datecreate", $model->getDateCreate(), PDO::PARAM_STR);
        
        $statement->execute();

        return $statement;
    }

    public function update(Produit $model){
        $query = "UPDATE " . $this->table . " SET NOM_PRODUIT=:NomProduit, DESCRIPTION=:DescriptionProduit, DATE_MODIF_PRO=:DateModifProduit, DATE_CREAT_PRO=:DateCreateProduit WHERE ID_PRODUIT=:IDProduit";

        $statement = $this->conn->prepare($query);

        $statement->bindValue(":IDProduit", $model->getId(), PDO::PARAM_INT);
        $statement->bindValue(":NomProduit", $model->getNom(), PDO::PARAM_STR);
        $statement->bindValue(":DescriptionProduit", $model->getDescription(), PDO::PARAM_STR);
        $statement->bindValue(":DateModifProduit", $model->getDateModif(), PDO::PARAM_STR);
        $statement->bindValue(":DateCreateProduit", $model->getDateCreate(), PDO::PARAM_STR);
        
        $statement->execute();

        return $statement;
    }

    public function delete($Id){
        $query = "DELETE FROM " . $this->table . " WHERE ID_PRODUIT=:Id";

        $statement = $this->conn->prepare($query);

        $statement->bindValue(":Id", $Id, PDO::PARAM_INT);

        $statement->execute();

        return $statement;
    }
}