<?php
/**
 * Created by PhpStorm.
 * User: Aurel Bertrand
 * Date: 18/09/2016
 * Time: 22:10
 */
class Voyage{

    private $id;
    private $id_site;
    private $id_chauf;
    private $id_prod;
    private $sit_id_site;
    private $id_client;
    private $ton_depart;
    private $ton_arrive;
    private $permutation;
    private $status_voyage;
    private $desc_voyage;
    private $dif_poids;
    private $nbre_sac;
    private $incident;
    private $paiement;
    private $depense_jubenros;
    private $avance_paiement;
    private $depense_total;
    private $revenu_jubenros;
    private $annulation;
    private $fact_chauf;
    private $fact_trans;
    private $revenu_total;
    private $commission;
    private $autre_depense;
    private $tonnage_trans;
    private $frais_demarcheur;
    private $num_recu;
    private $num_be;
    private $date_creation;
    private $date_modification;
    private $final;

    public function __construct($id,$id_site,$id_chauf,$id_prod,$sit_id_site,$id_client,
                                $ton_depart,$ton_arrive,$permutation,$status_voyage,$desc_voyage,
                                $dif_poids,$nbre_sac,$incident,$paiement,$depense_jubenros,
                                $avance_paiement,$depense_total,$revenu_jubenros,$fact_chauf,
                                $fact_trans,$revenu_total,$commission,$annulation,$autre,
                                $tonnage_trans,$frais,$num_recu,$num_be,$final,$date_creation,
                                $date_modification){

        $this->id = $id;
        $this->id_site = $id_site;
        $this->id_chauf = $id_chauf;
        $this->id_prod = $id_prod;
        $this->final = $final;
        $this->sit_id_site = $sit_id_site;
        $this->annulation = $annulation;
        $this->autre_depense = $autre;
        $this->tonnage_trans = $tonnage_trans;
        $this->frais_demarcheur = $frais;
        $this->num_recu = $num_recu;
        $this->date_creation = $date_creation;
        $this->num_be = $num_be;
        $this->id_client = $id_client;
        $this->ton_depart = $ton_depart;
        $this->ton_arrive = $ton_arrive;
        $this->permutation = $permutation;
        $this->status_voyage = $status_voyage;
        $this->desc_voyage = $desc_voyage;
        $this->dif_poids = $dif_poids;
        $this->nbre_sac = $nbre_sac;
        $this->incident = $incident;
        $this->paiement = $paiement;
        $this->depense_jubenros = $depense_jubenros;
        $this->avance_paiement = $avance_paiement;
        $this->depense_total = $depense_total;
        $this->revenu_jubenros = $revenu_jubenros;
        $this->fact_chauf = $fact_chauf;
        $this->fact_trans = $fact_trans;
        $this->revenu_total = $revenu_total;
        $this->commission = $commission;
        $this->date_creation = $date_creation;
        $this->date_modification = $date_modification;
    }

    public function getAutreDepense()
    {
        return $this->autre_depense;
    }

    public function getFraisDemarcheur()
    {
        return $this->frais_demarcheur;
    }

    public function getNumBe()
    {
        return $this->num_be;
    }

    public function getNumRecu()
    {
        return $this->num_recu;
    }

    public function getTonnageTrans()
    {
        return $this->tonnage_trans;
    }

    public function setTonnageTrans($tonnage_trans)
    {
        $this->tonnage_trans = $tonnage_trans;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getAnnulation()
    {
        return $this->annulation;
    }

    public function setAnnulation($annulation)
    {
        $this->annulation = $annulation;
    }

    public function setDateModification($date_modification)
    {
        $this->date_modification = $date_modification;
    }

    public function getFinal()
    {
        return $this->final;
    }

    public function setIdClient($id_client)
    {
        $this->id_client = $id_client;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId_site($id_site)
    {
        $this->id_site = $id_site;
    }

    public function getId_site()
    {
        return $this->id_site;
    }

    public function setId_chauf($id_chauf)
    {
        $this->id_chauf = $id_chauf;
    }

    public function getId_chauf()
    {
        return $this->id_chauf;
    }

    public function getDateModification()
    {
        return $this->date_modification;
    }

    public function getIdClient()
    {
        return $this->id_client;
    }

    public function setId_prod($id_prod)
    {
        $this->id_prod = $id_prod;
    }

    public function getId_prod()
    {
        return $this->id_prod;
    }

    public function setSit_id_site($sit_id_site)
    {
        $this->sit_id_site = $sit_id_site;
    }

    public function getSit_id_site()
    {
        return $this->sit_id_site;
    }

    public function setTon_depart($ton_depart)
    {
        $this->ton_depart = $ton_depart;
    }

    public function getTon_depart()
    {
        return $this->ton_depart;
    }

    public function setTon_arrive($ton_arrive)
    {
        $this->ton_arrive = $ton_arrive;
    }

    public function getTon_arrive()
    {
        return $this->ton_arrive;
    }

    public function setPermutation($permutation)
    {
        $this->permutation = $permutation;
    }

    public function getPermutation()
    {
        return $this->permutation;
    }

    public function setStatus_voyage($status_voyage)
    {
        $this->status_voyage = $status_voyage;
    }

    public function getStatus_voyage()
    {
        return $this->status_voyage;
    }

    public function setDesc_voyage($desc_voyage)
    {
        $this->desc_voyage = $desc_voyage;
    }

    public function getDesc_voyage()
    {
        return $this->desc_voyage;
    }

    public function setDif_poids($dif_poids)
    {
        $this->dif_poids = $dif_poids;
    }

    public function getDif_poids()
    {
        return $this->dif_poids;
    }

    public function setNbre_sac($nbre_sac)
    {
        $this->nbre_sac = $nbre_sac;
    }

    public function getNbre_sac()
    {
        return $this->nbre_sac;
    }

    public function setIncident($incident)
    {
        $this->incident = $incident;
    }

    public function getIncident()
    {
        return $this->incident;
    }

    public function setPaiement($paiement)
    {
        $this->paiement = $paiement;
    }

    public function getPaiement()
    {
        return $this->paiement;
    }

    public function setDepense_jubenros($depense_jubenros)
    {
        $this->depense_jubenros = $depense_jubenros;
    }

    public function getDepense_jubenros()
    {
        return $this->depense_jubenros;
    }

    public function setDepense_total($depense_total)
    {
        $this->depense_total = $depense_total;
    }

    public function getDepense_total()
    {
        return $this->depense_total;
    }

    public function setAvance_paiement($avance_paiement)
    {
        $this->avance_paiement = $avance_paiement;
    }

    public function getAvance_paiement()
    {
        return $this->avance_paiement;
    }

    public function setRevenu_jubenros($revenu_jubenros)
    {
        $this->revenu_jubenros = $revenu_jubenros;
    }

    public function getRevenu_jubenros()
    {
        return $this->revenu_jubenros;
    }

    public function setFact_chauf($fact_chauf)
    {
        $this->fact_chauf = $fact_chauf;
    }

    public function getFact_chauf()
    {
        return $this->fact_chauf;
    }

    public function setFact_trans($fact_trans)
    {
        $this->fact_trans = $fact_trans;
    }

    public function getFact_trans()
    {
        return $this->fact_trans;
    }

    public function setRevenu_total($revenu_total)
    {
        $this->revenu_total = $revenu_total;
    }

    public function getRevenu_total()
    {
        return $this->revenu_total;
    }
    public function setCommission($commission)
    {
        $this->commission = $commission;
    }

    public function getCommission()
    {
        return $this->commission;
    }

    public function setDate_creation($date_creation)
    {
        $this->date_creation = $date_creation;
    }

    public function getDate_creation()
    {
        return $this->date_creation;
    }

    public function setDate_modif($date_modif)
    {
        $this->date_modification = $date_modif;
    }

    public function getDate_modif()
    {
        return $this->date_modification;
    }

    public function __toString()
    {
        return $this->id_chauf.''.$this->id_site.$this->ton_depart.''.$this->ton_arrive.''.$this->status_voyage.''.$this->avance_paiement.''.$this->dif_poids.''.$this->commission;

    }







}