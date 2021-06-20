<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 27/09/2016
 * Time: 00:45
 */
class ClientCtrl
{
    private $conn;
    private $table = "client";

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
        $query = 'SELECT * FROM '.$this->table.' WHERE ID_CLIENT = ' . $Id;

        $statement = $this->conn->prepare($query);

        $statement->execute();

        return $statement;
    }

    public function getByNom($nom){
        $query = 'SELECT * FROM '.$this->table.' WHERE NOM = "' . $nom . '"';

        $statement = $this->conn->prepare($query);

        $statement->execute();

        return $statement;
    }

    public function insert(Client $model){
        $query = "INSERT INTO " . $this->table . "(NOM, DATE_CREAT_CLIENT, DATE_MODIF_CLIENT) VALUES (:nom, :datecreate, :datemodification)";

        $statement = $this->conn->prepare($query);

        $statement->bindValue(":nom", $model->getNom(), PDO::PARAM_STR);
        $statement->bindValue(":datemodification", $model->getDateUpdate(), PDO::PARAM_STR);
        $statement->bindValue(":datecreate", $model->getDateCreate(), PDO::PARAM_STR);

        $statement->execute();

        return $statement;
    }

    public function update(Client $model){
        $query = "UPDATE " . $this->table . " SET NOM=:nom, DATE_MODIF_CLIENT=:datemodif, DATE_CREAT_CLIENT=:datecreate WHERE ID_CLIENT=:ID";

        $statement = $this->conn->prepare($query);

        $statement->bindValue(":ID", $model->getId(), PDO::PARAM_INT);
        $statement->bindValue(":nom", $model->getNom(), PDO::PARAM_STR);
        $statement->bindValue(":datemodif", $model->getDateUpdate(), PDO::PARAM_STR);
        $statement->bindValue(":datecreate", $model->getDateCreate(), PDO::PARAM_STR);

        $statement->execute();

        return $statement;
    }

    public function delete($Id){
        $query = "DELETE FROM " . $this->table . " WHERE ID_CLIENT=:Id";

        $statement = $this->conn->prepare($query);

        $statement->bindValue(":Id", $Id, PDO::PARAM_INT);

        $statement->execute();

        return $statement;
    }
}
