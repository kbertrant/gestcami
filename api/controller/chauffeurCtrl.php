<?php

class ChauffeurCtrl{
	private $conn;
	private $table = "chauffeur";

	public function __construct($conn)
	{
		$this->conn =$conn;
	}

	public function get()
	{
		$query = 'SELECT CH.*, C.*  FROM chauffeur CH
        INNER JOIN CAMION C
        ON CH.ID_CAMION=C.ID_CAMION';

        $statement = $this->conn->prepare($query);

        $statement->execute();

        return $statement;
	}

	  public function getById($id){
        $query = 'SELECT * FROM '.$this->table.' WHERE ID_CHAUFFEUR = ' . $id;

        $statement = $this->conn->prepare($query);

        $statement->execute();

        return $statement;
    }

    public function getByNom($nom){
        $query = 'SELECT * FROM '.$this->table.' WHERE NOM_CHAUFFEUR = "' . $nom . '"';

        $statement = $this->conn->prepare($query);

        $statement->execute();

        return $statement;
    }
    public function getByIdCamion($camion){
        $query = 'SELECT * FROM '.$this->table.' WHERE ID_CAMION = "' . $camion . '"';

        $statement = $this->conn->prepare($query);

        $statement->execute();

        return $statement;
    }

    public function insert(Chauffeur $model){
        $query = "INSERT INTO " . $this->table . "( ID_CAMION, NOM_CHAUFFEUR, NUMEROCNI, STATUS_CHAUFFEUR, CONTACT, DATE_MODIF_CHAUF, DATE_CREAT_CHAUF) VALUES ( :camion,:nom,:cni,:statut,:contact,:datecreate,:datemodif)";

        $statement = $this->conn->prepare($query);

        $statement->bindValue("camion", $model->getIdCamion(), PDO::PARAM_STR);
        $statement->bindValue(":nom", $model->getNom(), PDO::PARAM_STR);
        $statement->bindValue(":cni", $model->getcni(), PDO::PARAM_STR);
        $statement->bindValue(":statut", $model->getStatus(), PDO::PARAM_STR);
        $statement->bindValue(":contact", $model->getContact(), PDO::PARAM_STR);
        $statement->bindValue(":datecreate", $model->getDateCreate(), PDO::PARAM_STR);
        $statement->bindValue(":datemodif", $model->getDateModif(), PDO::PARAM_STR);

        $statement->execute();

        return $statement;
    }

    public function update(Chauffeur $model){
        $query = "UPDATE " . $this->table . " SET ID_CAMION=:camion, NOM_CHAUFFEUR=:nom, NUMEROCNI=:cni, STATUS_CHAUFFEUR=:statut, CONTACT=:contact, DATE_MODIF_CHAUF=:datemodif, DATE_CREAT_CHAUF=:datecreate WHERE ID_CHAUFFEUR=:id";

        $statement = $this->conn->prepare($query);
        $statement->bindValue(":id", $model->getId(), PDO::PARAM_INT);
        $statement->bindValue(":camion", $model->getIdCamion(), PDO::PARAM_INT);
        $statement->bindValue(":nom", $model->getNom(), PDO::PARAM_STR);
        $statement->bindValue(":cni", $model->getcni(), PDO::PARAM_STR);
        $statement->bindValue(":statut", $model->getStatus(), PDO::PARAM_STR);
        $statement->bindValue(":contact", $model->getContact(), PDO::PARAM_STR);
        $statement->bindValue(":datecreate", $model->getDateCreate(), PDO::PARAM_STR);
        $statement->bindValue(":datemodif", $model->getDateModif(), PDO::PARAM_STR);

        $statement->execute();

        return $statement;
    }

    public function delete($Id){
        $query = "DELETE FROM " . $this->table . " WHERE ID_CHAUFFEUR=:Id";

        $statement = $this->conn->prepare($query);

        $statement->bindValue(":Id", $Id, PDO::PARAM_INT);

        $statement->execute();

        return $statement;
    }
}
