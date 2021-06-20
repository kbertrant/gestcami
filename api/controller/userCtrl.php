<?php

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 08/06/2016
 * Time: 15:33
 */
class userCtrl
{
    private $connection;
    private $table_name = "utilisateur";

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public  function get(){
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY NOM_USER ASC ";

        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->execute();

        return $statement_prepare;
    }

    public  function getById($id){
        $query = "SELECT * FROM " . $this->table_name . " WHERE ID_USER=".$id." ORDER BY NOM_USER ASC ";

        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->execute();

        return $statement_prepare;
    }

    public  function getByPseudo($pseudo){
        $query = "SELECT * FROM " . $this->table_name . " WHERE PSEUDO_USER='".$pseudo."' ORDER BY NOM_USER ASC ";

        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->execute();

        return $statement_prepare;
    }

    public  function auth($pseudo, $password){
        $query = "SELECT * FROM " . $this->table_name . " WHERE PSEUDO_USER='".$pseudo."' AND PASSWORD_USER='".$password."'";

        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->execute();

        return $statement_prepare;
    }

    public function insert(User $model){
        $query = "INSERT INTO " . $this->table_name . " (
            NOM_USER,
            PRENOM_USER,
            PSEUDO_USER,
            PASSWORD_USER,
            POSTE,
            DATE_CREAT_USER,
            DATE_MODIF_USER
        ) VALUES(
            :nom,
            :prenom,
            :pseudo,
            :password,
            :poste,
            :date_create,
            :date_update
        );";

        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->bindValue(":nom", $model->getNom(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":prenom", $model->getPrenom(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":pseudo", $model->getPseudo(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":password", $model->getPassword(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":poste", $model->getPoste(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":date_create", $model->getDateCreate(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":date_update", $model->getDateUpdate(), PDO::PARAM_STR);

        $statement_prepare->execute();

        return $statement_prepare;
    }

    public function update(User $model){

        $query = "UPDATE ". $this->table_name . " SET NOM_USER=:nom, PRENOM_USER=:prenom,
         PSEUDO_USER=:pseudo, PASSWORD_USER=:password, POSTE=:poste,
         DATE_CREAT_USER=:date_create, DATE_MODIF_USER=:date_update WHERE ID_USER=:id";

        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->bindValue(":id", $model->getId(), PDO::PARAM_INT);
        $statement_prepare->bindValue(":nom", $model->getNom(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":prenom", $model->getPrenom(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":pseudo", $model->getPseudo(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":password", $model->getPassword(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":poste", $model->getPoste(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":date_create", $model->getDateCreate(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":date_update", $model->getDateUpdate(), PDO::PARAM_STR);

        $statement_prepare->execute();

        return $statement_prepare;
    }

    public function delete($id){

        $query = "DELETE FROM " . $this->table_name . " WHERE ID_USER=:id";

        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->bindValue(":id",$id, PDO::PARAM_INT);

        $statement_prepare->execute();

        return $statement_prepare;


    }
}