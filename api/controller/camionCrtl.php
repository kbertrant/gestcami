<?php

class CamionCrtl{
	private $conn;
    private $table_name = "camion";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function get()
    {
    	$query = 'SELECT c.*, t.* FROM '.$this->table_name.' c
         LEFT JOIN transporteur t
          ON c.ID_TRANSPORTEUR = t.ID_TRANSPORTEUR';

        $statement = $this->conn->prepare($query);

        $statement->execute();

        return $statement;
    }

    public function getById($id){
        $query = 'SELECT c.*, t.* FROM '.$this->table_name.' c
         LEFT JOIN transporteur t
          ON c.ID_TRANSPORTEUR = t.ID_TRANSPORTEUR WHERE ID_CAMION = ' . $id;

        $statement = $this->conn->prepare($query);

        $statement->execute();

        return $statement;
    }

    public function getByMatricule($matricule){
        $query = 'SELECT c.*, t.* FROM '.$this->table_name.' c
         LEFT JOIN transporteur t
          ON c.ID_TRANSPORTEUR = t.ID_TRANSPORTEUR WHERE MATRICULE = "' . $matricule . '"';

        $statement = $this->conn->prepare($query);

        $statement->execute();

        return $statement;
    }
    
    public function insert(Camion $model){
        $query = "INSERT INTO " . $this->table_name . "(ID_TRANSPORTEUR,MATRICULE,TONNAGE,COULEUR,MARQUE,PHOTO,DATE_CREAT_CAM,DATE_MODIF_CAM) VALUES (:id_trans,:matricule,:tonnage,:couleur,:marque,:photo,:datecreation,:datemodification)";

        $statement = $this->conn->prepare($query);

        $statement->bindValue(":id_trans", $model->getIdTrans(), PDO::PARAM_INT);
        $statement->bindValue(":matricule", $model->getMatricule(), PDO::PARAM_STR);
        $statement->bindValue(":tonnage", $model->getTonnage(), PDO::PARAM_STR);
        $statement->bindValue(":couleur", $model->getCouleur(), PDO::PARAM_STR);
        $statement->bindValue(":marque", $model->getMarque(), PDO::PARAM_STR);
        $statement->bindValue(":photo", $model->getPhoto(), PDO::PARAM_STR);
        $statement->bindValue(":datecreation", $model->getDatecreation(), PDO::PARAM_STR);
        $statement->bindValue(":datemodification", $model->getDatemodification(), PDO::PARAM_STR);

        $statement->execute();

        return $statement;
    }

    public function update(Camion $model){
        $query = "UPDATE " . $this->table_name . " SET ID_TRANSPORTEUR=:id_trans, MATRICULE=:matricule, MARQUE=:marque, COULEUR=:couleur, PHOTO=:photo, TONNAGE=:tonnage, DATE_CREAT_CAM=:datecreation, DATE_MODIF_CAM=:datemodification WHERE ID_CAMION=:id";

        $statement = $this->conn->prepare($query);

        $statement->bindValue(":id", $model->getId(), PDO::PARAM_INT);
        $statement->bindValue(":id_trans", $model->getIdTrans(), PDO::PARAM_INT);
        $statement->bindValue(":matricule", $model->getMatricule(), PDO::PARAM_STR);
        $statement->bindValue(":tonnage", $model->getTonnage(), PDO::PARAM_STR);
        $statement->bindValue(":couleur", $model->getCouleur(), PDO::PARAM_STR);
        $statement->bindValue(":marque", $model->getMarque(), PDO::PARAM_STR);
        $statement->bindValue(":photo", $model->getPhoto(), PDO::PARAM_STR);
        $statement->bindValue(":datecreation", $model->getDatecreation(), PDO::PARAM_STR);
        $statement->bindValue(":datemodification", $model->getDatemodification(), PDO::PARAM_STR);

        $statement->execute();

        return $statement;
    }

    public function delete($id){
        $query = "DELETE FROM " . $this->table_name . " WHERE ID_CAMION=:id";

        $statement = $this->conn->prepare($query);

        $statement->bindValue(":id", $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement;
    }
}