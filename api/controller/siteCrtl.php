<?php

class SiteCrtl{
	private $conn;
    private $table_name = "site";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function get()
    {
    	$query = 'SELECT * FROM site';

        $statement = $this->conn->prepare($query);

        $statement->execute();

        return $statement;
    }

    public function getById($id){
        $query = 'SELECT * FROM site WHERE ID_SITE = ' . $id;

        $statement = $this->conn->prepare($query);

        $statement->execute();

        return $statement;
    }

    public function getByNomSite($nomSite){
        $query = 'SELECT * FROM site WHERE NOM_SITE = "' . $nomSite . '"';

        $statement = $this->conn->prepare($query);

        $statement->execute();

        return $statement;
    }
    
    public function insert(Site $model){
        $query = "INSERT INTO " . $this->table_name . "(NOM_SITE,REGION_SITE,DATE_MODIF_SITE,DATE_CREAT_SITE,PRIX_FACTURE,PRIX_TRANSPORT) VALUES (:nomSite,:regioSite,:dateModifSite,:dateCreatSite,:prixFacture,:prixTransp)";

        $statement = $this->conn->prepare($query);

        $statement->bindValue(":nomSite", $model->getNomSite(), PDO::PARAM_STR);
        $statement->bindValue(":regioSite", $model->getRegioSite(), PDO::PARAM_STR);
        $statement->bindValue(":dateModifSite", $model->getDateModifSite(), PDO::PARAM_STR);
        $statement->bindValue(":dateCreatSite", $model->getDateCreatSite(), PDO::PARAM_STR);
         $statement->bindValue(":prixFacture", $model->getPrixFacture(), PDO::PARAM_STR);
         $statement->bindValue(":prixTransp", $model->getPrixTransp(), PDO::PARAM_STR);

        $statement->execute();

        return $statement;
    }

    public function update(Site $model){
        $query = "UPDATE " . $this->table_name . " SET  NOM_SITE=:nomSite, REGION_SITE=:regioSite, DATE_MODIF_SITE=:dateModifSite, DATE_CREAT_SITE=:dateCreatSite, PRIX_FACTURE=:prixFacture, PRIX_TRANSPORT=:prixTransp WHERE ID_SITE=:id";

        $statement = $this->conn->prepare($query);

        $statement->bindValue(":id", $model->getId(), PDO::PARAM_INT);
        $statement->bindValue(":nomSite", $model->getNomSite(), PDO::PARAM_STR);
        $statement->bindValue(":regioSite", $model->getRegioSite(), PDO::PARAM_STR);
        $statement->bindValue(":dateModifSite", $model->getDateModifSite(), PDO::PARAM_STR);
        $statement->bindValue(":dateCreatSite", $model->getDateCreatSite(), PDO::PARAM_STR);
         $statement->bindValue(":prixFacture", $model->getPrixFacture(), PDO::PARAM_STR);
         $statement->bindValue(":prixTransp", $model->getPrixTransp(), PDO::PARAM_STR);

        $statement->execute();

        return $statement;
    }

    public function delete($id){
        $query = "DELETE FROM " . $this->table_name . " WHERE ID_SITE=:id";

        $statement = $this->conn->prepare($query);

        $statement->bindValue(":id", $id, PDO::PARAM_INT);

        $statement->execute();

        return $statement;
    }
}