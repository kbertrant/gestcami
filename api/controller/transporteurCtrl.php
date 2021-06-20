<?php  

class transporteurCtrl
{
	private $conn;
	private $table ="transporteur";

	public function __construct($conn)
	{
		$this->conn= $conn;
	}

	public function get()
	{
		$query ='SELECT * FROM '.$this->table;

		$statement = $this->conn->prepare($query);

		$statement->execute();

        return $statement;
	}

    public function getById($id_transporteur){
        $query = 'SELECT * FROM '.$this->table.' WHERE ID_TRANSPORTEUR = ' . $id_transporteur;

        $statement = $this->conn->prepare($query);

        $statement->execute();

        return $statement;
    }

    public function getByNom($Nom_transporteur){
        $query = 'SELECT * FROM '.$this->table.' WHERE NOM_TRANSPORTEUR = "' . $Nom_transporteur . '"';

        $statement = $this->conn->prepare($query);

        $statement->execute();

        return $statement;
    }

    public function insert(transporteur $model){
        $query = "INSERT INTO " . $this->table . "(NOM_TRANSPORTEUR, DATE_CREAT_TRANSPORT, DATE_MODIF_TRANSPORT, CONTACT, DOSSIER_FISCALE, NAME_INTERNE, NUMERO_INTERNE) VALUES ( :nom, :datecreate, :datemodif, :contact, :doc_fisc, :Name, :Numero)";

        $statement = $this->conn->prepare($query);

        $statement->bindValue(":nom", $model->getNom(), PDO::PARAM_STR);
        $statement->bindValue(":datecreate", $model->getDateCreate(), PDO::PARAM_STR);
        $statement->bindValue(":datemodif", $model->getDateModification(), PDO::PARAM_STR);
        $statement->bindValue("contact", $model->getContact(), PDO::PARAM_STR);
        $statement->bindValue(":doc_fisc", $model->getDossierFiscale(), PDO::PARAM_STR);
        $statement->bindValue(":Name", $model->getNameInterne(), PDO::PARAM_STR);
        $statement->bindValue(":Numero", $model->getNumeroInterne(), PDO::PARAM_STR);

        $statement->execute();

        return $statement;
    }

    public function update(transporteur $model){
        $query = "UPDATE " . $this->table . " SET NOM_TRANSPORTEUR=:nom, DATE_CREAT_TRANSPORT=:datecreate, DATE_MODIF_TRANSPORT=:datemodif, CONTACT=:contact, DOSSIER_FISCALE=:doc, TMP=:tmp, NAME_INTERNE=:name, NUMERO_INTERNE=:num WHERE ID_TRANSPORTEUR=:id";

        $statement = $this->conn->prepare($query);

        $statement->bindValue(":id", $model->getId(), PDO::PARAM_INT);
        $statement->bindValue(":nom", $model->getNom(), PDO::PARAM_STR);
        $statement->bindValue(":datecreate", $model->getDateCreate(), PDO::PARAM_STR);
        $statement->bindValue(":datemodif", $model->getDateModification(), PDO::PARAM_STR);
        $statement->bindValue(":contact", $model->getContact(), PDO::PARAM_STR);
        $statement->bindValue(":doc", $model->getDossierFiscale(), PDO::PARAM_STR);
        $statement->bindValue(":name", $model->getNameInterne(), PDO::PARAM_STR);
        $statement->bindValue(":num", $model->getNumeroInterne(), PDO::PARAM_STR);
        $statement->bindValue(":tmp", $model->getTmp(), PDO::PARAM_STR);

        $statement->execute();

        return $statement;
    }

    public function delete($Id){
        $query = "DELETE FROM " . $this->table . " WHERE ID_TRANSPORTEUR=:Id";

        $statement = $this->conn->prepare($query);

        $statement->bindValue(":Id", $Id, PDO::PARAM_INT);

        $statement->execute();

        return $statement;
    }

}