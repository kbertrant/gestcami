
<?php
/**
 * Created by PhpStorm.
 * User: Aurel Bertrand
 * Date: 18/09/2016
 * Time: 23:00
 */
class voyageCtrl{

    private $connection;
    private $table_name = "voyage";

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public  function get(){
        $query = "SELECT c.*, v.*, p.*, sd.NOM_SITE 'NOM_SITE_DEPART', sd.PRIX_TRANSPORT 'PRIX_TD', sa.NOM_SITE 'NOM_SITE_ARRIVE', cl.*
FROM ".$this->table_name." v
  INNER JOIN chauffeur c
  ON v.ID_CHAUFFEUR = c.ID_CHAUFFEUR
  INNER JOIN produit p
  ON v.ID_PRODUIT = p.ID_PRODUIT
  INNER JOIN site sd
  ON v.ID_SITE = sd.ID_SITE
  INNER JOIN site sa
  ON v.SIT_ID_SITE = sa.ID_SITE
  INNER JOIN client cl
  ON v.ID_CLIENT = cl.ID_CLIENT
  GROUP BY v.ID_VOYAGE
ORDER BY v.ID_VOYAGE ASC";

        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->execute();

        return $statement_prepare;
    }

    public function search($obj){
        $query = "SELECT c.*, v.*, p.*, t.*, ca.*, sd.NOM_SITE 'NOM_SITE_DEPART', sd.PRIX_TRANSPORT 'PRIX_TD', sd.PRIX_FACTURE 'PRIX_FD', sa.NOM_SITE 'NOM_SITE_ARRIVE', cl.*
FROM ".$this->table_name." v
  INNER JOIN chauffeur c
  ON v.ID_CHAUFFEUR = c.ID_CHAUFFEUR
  INNER JOIN camion ca
  ON c.ID_CAMION = ca.ID_CAMION
  INNER JOIN produit p
  ON v.ID_PRODUIT = p.ID_PRODUIT
  INNER JOIN site sd
  ON v.ID_SITE = sd.ID_SITE
  INNER JOIN site sa
  ON v.SIT_ID_SITE = sa.ID_SITE
  INNER JOIN transporteur t
  ON ca.ID_TRANSPORTEUR = t.ID_TRANSPORTEUR
  INNER JOIN client cl
  ON v.ID_CLIENT = cl.ID_CLIENT
  WHERE v.ID_CHAUFFEUR LIKE '%".$obj['ID_CHAUFFEUR']."%' AND
  v.ID_PRODUIT LIKE '%".$obj['ID_PRODUIT']."%' AND
  v.SIT_ID_SITE LIKE '%".$obj['ID_SITE_ARRIVEE']."%' AND
  v.ID_SITE LIKE '%".$obj['ID_SITE_DEPART']."%' AND
  v.DIFFERENCE_POIDS LIKE '%".$obj['DIFF']."%' AND
  v.DATE_CREATION LIKE '%".$obj['DATE_CREATION']."%' AND
  v.ID_CLIENT LIKE '%".$obj['ID_CLIENT']."%' AND
  v.NUM_RECU LIKE '%".$obj['NUM_RECU']."%' AND
  v.STATUS_VOYAGE = ".$obj['STATUT']." AND
  v.FINAL = ".$obj['FINAL']." AND
  v.ANNULATION = ".$obj['ANNULATION']."
ORDER BY v.ID_VOYAGE ASC";

        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->execute();

        return $statement_prepare;
    }

    public  function getActif(){
        $query = "SELECT c.*, v.*, p.*, ca.*, sd.NOM_SITE 'NOM_SITE_DEPART', sd.PRIX_TRANSPORT 'PRIX_TD', sd.PRIX_FACTURE 'PRIX_FD', sa.NOM_SITE 'NOM_SITE_ARRIVE', cl.*
FROM ".$this->table_name." v
  INNER JOIN chauffeur c
  ON v.ID_CHAUFFEUR = c.ID_CHAUFFEUR
  INNER JOIN camion ca
  ON c.ID_CAMION = ca.ID_CAMION
  INNER JOIN produit p
  ON v.ID_PRODUIT = p.ID_PRODUIT
  INNER JOIN site sd
  ON v.ID_SITE = sd.ID_SITE
  INNER JOIN site sa
  ON v.SIT_ID_SITE = sa.ID_SITE
  INNER JOIN client cl
  ON v.ID_CLIENT = cl.ID_CLIENT
  WHERE STATUS_VOYAGE = false AND
  ANNULATION = FALSE
  GROUP BY v.ID_VOYAGE
ORDER BY v.ID_VOYAGE ASC";

        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->execute();

        return $statement_prepare;
    }

    public function getGroubBy($obj){
        $query = "SELECT NOM_TRANSPORTEUR, sum(DEPENSE_JUBENROS) 'SUMDJ', sum(AUTRE_DEPENSE) 'SUMAD', sum(AVANCE_PAIEMENT) 'SUMAP'
FROM ".$this->table_name." v
  INNER JOIN chauffeur c
  ON v.ID_CHAUFFEUR = c.ID_CHAUFFEUR
  INNER JOIN camion ca
  ON c.ID_CAMION = ca.ID_CAMION
  INNER JOIN produit p
  ON v.ID_PRODUIT = p.ID_PRODUIT
  INNER JOIN site sd
  ON v.ID_SITE = sd.ID_SITE
  INNER JOIN site sa
  ON v.SIT_ID_SITE = sa.ID_SITE
  INNER JOIN transporteur t
  ON ca.ID_TRANSPORTEUR = t.ID_TRANSPORTEUR
  INNER JOIN client cl
  ON v.ID_CLIENT = cl.ID_CLIENT
  WHERE v.ID_CHAUFFEUR LIKE '%".$obj['ID_CHAUFFEUR']."%' AND
  v.ID_PRODUIT LIKE '%".$obj['ID_PRODUIT']."%' AND
  v.SIT_ID_SITE LIKE '%".$obj['ID_SITE_ARRIVEE']."%' AND
  v.ID_SITE LIKE '%".$obj['ID_SITE_DEPART']."%' AND
  v.DIFFERENCE_POIDS LIKE '%".$obj['DIFF']."%' AND
  v.DATE_CREATION LIKE '%".$obj['DATE_CREATION']."%' AND
  v.ID_CLIENT LIKE '%".$obj['ID_CLIENT']."%' AND
  v.NUM_RECU LIKE '%".$obj['NUM_RECU']."%' AND
  v.STATUS_VOYAGE = ".$obj['STATUT']." AND
  v.FINAL = ".$obj['FINAL']." AND
  v.ANNULATION = ".$obj['ANNULATION']."
GROUP BY t.NOM_TRANSPORTEUR ORDER BY v.ID_VOYAGE ASC";

        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->execute();

        return $statement_prepare;
    }

    public  function getAllFinish(){
        $query = "SELECT c.*, v.*, p.*, t.*, ca.*, sd.NOM_SITE 'NOM_SITE_DEPART', sd.PRIX_TRANSPORT 'PRIX_TD', sd.PRIX_FACTURE 'PRIX_FD', sa.NOM_SITE 'NOM_SITE_ARRIVE', cl.*
FROM ".$this->table_name." v
  INNER JOIN chauffeur c
  ON v.ID_CHAUFFEUR = c.ID_CHAUFFEUR
  INNER JOIN camion ca
  ON c.ID_CAMION = ca.ID_CAMION
  INNER JOIN produit p
  ON v.ID_PRODUIT = p.ID_PRODUIT
  INNER JOIN site sd
  ON v.ID_SITE = sd.ID_SITE
  INNER JOIN site sa
  ON v.SIT_ID_SITE = sa.ID_SITE
  INNER JOIN client cl
  ON v.ID_CLIENT = cl.ID_CLIENT
  INNER JOIN transporteur t
  ON ca.ID_TRANSPORTEUR = t.ID_TRANSPORTEUR
  WHERE FINAL = true AND STATUS_VOYAGE = true
  GROUP BY v.ID_VOYAGE
ORDER BY v.ID_VOYAGE ASC";

        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->execute();

        return $statement_prepare;
    }

    public  function getById($id){
        $query = "SELECT c.*, v.*, p.*, ca.*, t.*, cam.MATRICULE 'PERMUT', sd.PRIX_TRANSPORT 'PRIX_TD', sd.PRIX_FACTURE 'PRIX_FD', sd.NOM_SITE 'NOM_SITE_DEPART', sa.NOM_SITE 'NOM_SITE_ARRIVE', cl.*
FROM ".$this->table_name." v
  INNER JOIN chauffeur c
  ON v.ID_CHAUFFEUR = c.ID_CHAUFFEUR
  INNER JOIN camion ca
  ON c.ID_CAMION = ca.ID_CAMION
  INNER JOIN produit p
  ON v.ID_PRODUIT = p.ID_PRODUIT
  INNER JOIN site sd
  ON v.ID_SITE = sd.ID_SITE
  INNER JOIN site sa
  ON v.SIT_ID_SITE = sa.ID_SITE
  INNER JOIN client cl
  ON v.ID_CLIENT = cl.ID_CLIENT
  LEFT JOIN camion cam
  ON v.PERMUTATION = cam.ID_CAMION
  INNER JOIN transporteur t
  ON ca.ID_TRANSPORTEUR = t.ID_TRANSPORTEUR
  WHERE ID_VOYAGE=".$id."
  GROUP BY ID_VOYAGE ORDER BY DATE_CREATION ASC ";

        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->execute();

        return $statement_prepare;
    }

    public function ifExist($num){
        $query = "SELECT *
FROM ".$this->table_name." WHERE NUM_RECU='".$num."' ORDER BY DATE_CREATION ASC ";

        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->execute();

        return $statement_prepare;
    }

    public  function dispo($id){
        $query = "SELECT * FROM " . $this->table_name . " WHERE ID_CHAUFFEUR=".$id." AND STATUS_VOYAGE=false AND ANNULATION = false ORDER BY DATE_CREATION ASC ";

        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->execute();

        return $statement_prepare;
    }

    public function execute($query){
        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->execute();

        return $statement_prepare;
    }

    public function insert(Voyage $model){
            $query = "INSERT INTO " . $this->table_name . " (
            ID_SITE,
            ID_CHAUFFEUR,
            ID_PRODUIT,
            SIT_ID_SITE,
            ID_CLIENT,
            TONNAGE_DEPART,
            NUM_RECU,
            DATE_MODIFICATION,
            DATE_CREATION
        ) VALUES(
            :id_site,
            :id_chauf,
            :id_prod,
            :sit_id_site,
            :id_client,
            :ton_depart,
            :num_recu,
            :date_modification,
            :date_creation
        );";

            $statement_prepare = $this->connection->prepare($query);

            //$statement_prepare->bindValue(":id", $model->getId(), PDO::PARAM_STR);
            $statement_prepare->bindValue(":id_site", $model->getId_site(), PDO::PARAM_STR);
            $statement_prepare->bindValue(":id_chauf", $model->getId_chauf(), PDO::PARAM_STR);
            $statement_prepare->bindValue(":id_prod", $model->getId_prod(), PDO::PARAM_STR);
            $statement_prepare->bindValue(":sit_id_site", $model->getSit_id_site(), PDO::PARAM_STR);
            $statement_prepare->bindValue(":num_recu", $model->getNumRecu(), PDO::PARAM_STR);
            $statement_prepare->bindValue(":id_client", $model->getIdClient(), PDO::PARAM_INT);
            $statement_prepare->bindValue(":ton_depart", $model->getTon_depart(), PDO::PARAM_STR);
            $statement_prepare->bindValue(":date_creation", $model->getDate_creation(), PDO::PARAM_STR);
            $statement_prepare->bindValue(":date_modification", $model->getDate_modif(), PDO::PARAM_STR);
            $statement_prepare->execute();

            return $statement_prepare;
    }


    public function update(Voyage $model){
        $query = "UPDATE ". $this->table_name . " SET ID_SITE=:id_site,ID_CHAUFFEUR=:id_chauf,
        ID_PRODUIT=:id_prod,SIT_ID_SITE=:sit_id_site, ID_CLIENT=:id_client, TONNAGE_DEPART=:ton_depart,TONNAGE_ARRIVE=:ton_arrive,
        PERMUTATION=:permutation,STATUS_VOYAGE=:status_voyage, ANNULATION=:annulation,NUM_BE=:num_be,
        TONNAGE_TRANS=:tonnage_trans,FRAIS_DEMARCHEUR=:frais,NUM_RECU=:num_recu,AUTRE_DEPENSE=:autre,
        DESCRIPTION_VOYAGE=:desc_voyage,DIFFERENCE_POIDS=:dif_poids,FINAL=:final,
        NOMBRE_SAC=:nombre_sac,INCIDENT_SURVENU=:incident,PAIEMENT=:paiement,
        DEPENSE_JUBENROS=:depense_jubenros,AVANCE_PAIEMENT=:avance_paiement,DEPENSE_TOTAL=:depense_total,
        REVENU_JUBENROS=:revenu_jubenros,FACTURATION_CHAUFFEUR=:facture_chauf,
        FACTURATION_TRANSPORTEUR=:facture_trans,REVENU_TOTAL=:revenu_total,COMMISSION=:commission,
         DATE_CREATION=:date_creation, DATE_MODIFICATION=:date_modification WHERE ID_VOYAGE=:id";

        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->bindValue(":id", $model->getId(), PDO::PARAM_INT);
        $statement_prepare->bindValue(":id_site", $model->getId_site(), PDO::PARAM_INT);
        $statement_prepare->bindValue(":num_be", $model->getNumBe(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":tonnage_trans", $model->getTonnageTrans(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":frais", $model->getFraisDemarcheur(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":num_recu", $model->getNumRecu(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":final", $model->getFinal(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":autre", $model->getAutreDepense(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":id_chauf", $model->getId_chauf(), PDO::PARAM_INT);
        $statement_prepare->bindValue(":id_prod", $model->getId_prod(), PDO::PARAM_INT);
        $statement_prepare->bindValue(":sit_id_site", $model->getSit_id_site(), PDO::PARAM_INT);
        $statement_prepare->bindValue(":id_client", $model->getIdClient(), PDO::PARAM_INT);
        $statement_prepare->bindValue(":ton_depart", $model->getTon_depart(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":ton_arrive", $model->getTon_arrive(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":annulation", $model->getAnnulation(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":permutation", $model->getPermutation(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":status_voyage", $model->getStatus_voyage(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":desc_voyage", $model->getDesc_voyage(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":dif_poids", $model->getDif_poids(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":nombre_sac", $model->getNbre_sac(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":incident", $model->getIncident(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":paiement", $model->getPaiement(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":commission", $model->getCommission(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":date_creation", $model->getDate_creation(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":date_modification", $model->getDate_modif(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":depense_jubenros", $model->getDepense_jubenros(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":avance_paiement", $model->getAvance_paiement(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":depense_total", $model->getDepense_total(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":revenu_jubenros", $model->getRevenu_jubenros(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":facture_chauf", $model->getFact_chauf(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":facture_trans", $model->getFact_trans(), PDO::PARAM_STR);
        $statement_prepare->bindValue(":revenu_total", $model->getRevenu_total(), PDO::PARAM_STR);

        $statement_prepare->execute();

        return $statement_prepare;
    }

    public function annulation($id, $annulation){
        $query = "UPDATE ". $this->table_name . " SET ANNULATION=".$annulation.", DATE_MODIFICATION='".Date('Y-m-d')."' WHERE ID_VOYAGE=".$id;

        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->execute();

        return $statement_prepare;
    }

    public function finalize($id, $status){
        $query = "UPDATE ". $this->table_name . " SET STATUS_VOYAGE=".$status.", DATE_MODIFICATION='".Date('Y-m-d')."' WHERE ID_VOYAGE=".$id;

        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->execute();

        return $statement_prepare;
    }

    public function delete($id){
        $query = "DELETE FROM " . $this->table_name . " WHERE ID_VOYAGE=:id";

        $statement_prepare = $this->connection->prepare($query);

        $statement_prepare->bindValue(":id",$id, PDO::PARAM_INT);

        $statement_prepare->execute();

        return $statement_prepare;

    }

}
