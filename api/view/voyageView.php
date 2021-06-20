<?php
/**
 * Created by PhpStorm.
 * User: Aurel Bertrand
 * Date: 18/09/2016
 * Time: 23:47
 */


include_once "../controller/voyageCtrl.php";
include_once "../model/voyage.php";
include_once "../database.php";

$base = new Database();
$conn = $base->getConnection();
$controller = new voyageCtrl($conn);


if($_REQUEST['action'] == "getAll"){
    $response = array();

    $stmt = $controller->get();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows) > 0){
        $response['results'] = $rows;
        $response['message'] = "voyage trouvés";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}else if($_REQUEST['action'] == "getActif"){
    $response = array();

    $stmt = $controller->getActif();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows) > 0){
        $response['results'] = $rows;
        $response['message'] = "voyage trouvés";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}else if($_REQUEST['action'] == "getAllFinish"){
    $response = array();

    $stmt = $controller->getAllFinish();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows) > 0){
        $response['results'] = $rows;
        $response['message'] = "voyage trouvés";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}else if($_REQUEST['action'] == "getById"){
    $response = array();

    $stmt = $controller->getById($_GET['id']);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows) > 0){
        $response['results'] = $rows;
        $response['message'] = "voyages trouvés";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}else if($_REQUEST['action'] == "search"){
    $response = array();
    $option = array();

    $option['ID_CHAUFFEUR'] = $_POST['chauffeur'];
    $option['ID_PRODUIT'] = $_POST['produit'];
    $option['ID_SITE_ARRIVEE'] = $_POST['site_arrivee'];
    $option['ID_SITE_DEPART'] = $_POST['site_depart'];
    $option['NUM_RECU'] = $_POST['num_recu'];
    $option['DIFF'] = $_POST['diff'];
    $option['DATE_CREATION'] = $_POST['date_creation'];
    $option['ANNULATION'] = $_POST['annulation'];
    $option['ID_CLIENT'] = $_POST['client'];
    $option['STATUT'] = $_POST['statut'];
    $option['FINAL'] = $_POST['final'];

    $stmt = $controller->search($option);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows) > 0){
        $response['results'] = $rows;
        $response['message'] = "voyages trouvés";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}else if($_REQUEST['action'] == "groupBy"){
    $response = array();
    $option = array();

    $option['ID_CHAUFFEUR'] = $_POST['chauffeur'];
    $option['ID_PRODUIT'] = $_POST['produit'];
    $option['ID_SITE_ARRIVEE'] = $_POST['site_arrivee'];
    $option['ID_SITE_DEPART'] = $_POST['site_depart'];
    $option['NUM_RECU'] = $_POST['num_recu'];
    $option['DIFF'] = $_POST['diff'];
    $option['DATE_CREATION'] = $_POST['date_creation'];
    $option['ANNULATION'] = 0;
    $option['ID_CLIENT'] = $_POST['client'];
    $option['STATUT'] = 1;
    $option['FINAL'] = 1;

    $stmt = $controller->getGroubBy($option);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows) > 0){
        $response['results'] = $rows;
        $response['message'] = "voyages trouvés";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}else if($_REQUEST['action'] == 'insert'){
    $response = array();

    $st = $controller->ifExist($_POST['num_recu']);

    $exist = $st->fetchAll(PDO::FETCH_ASSOC);

    if(!$exist){
        $voyage = new Voyage(null,$_POST['id_site'],$_POST['id_chauf'],$_POST['id_prod'],
            $_POST['sit_id_site'], $_POST['id_client'], $_POST['ton_depart'],
            null,null,0,
            null,null,null,
            null, null,null,
            null,null,null,
            null,null,null,
            null,null,null,null,null,$_POST['num_recu'],null,null,Date('Y-m-d'),Date('Y-m-d'));

        $stmt = $controller->insert($voyage);

        $nbr = $conn->lastInsertId();

        if(count($nbr) > 0){
            $response['results'] = null;
            $response['message'] = "voyage inséré";
            $response['status'] = "success";
        }else {
            $response['results'] = null;
            $response['message'] = "aucune réponse";
            $response['status'] = "error";
        }
    }else{
        $response['results'] = null;
        $response['message'] = "Numéro de recu déjà existant.";
        $response['status'] = "error";
    }

    echo json_encode($response);

}else if($_REQUEST['action'] == 'update'){

    $response = array();

        $voyage = new Voyage($_POST['id'],$_POST['id_site'],$_POST['id_chauf'],
            $_POST['id_prod'],$_POST['sit_id_site'], $_POST['id_client'],$_POST['ton_depart'],
            $_POST['ton_arrive'],$_POST['permutation'],$_POST['status_voyage'],
            $_POST['desc_voyage'],$_POST['dif_poids'],$_POST['nombre_sac'],
            $_POST['incident'], $_POST['paiement'],$_POST['depense_jubenros'],
            $_POST['avance_paiement'],$_POST['depense_total'],$_POST['revenu_jubenros'],
            $_POST['facture_chauf'],$_POST['facture_trans'],$_POST['revenu_total'],
            $_POST['commission'],$_POST['annulation'],$_POST['autre'],$_POST['tonnage_trans'],
            $_POST['frais'],$_POST['num_recu'],$_POST['num_be'],$_POST['final'],$_POST['date_creation'],Date('Y-m-d'));

    $stmt = $controller->update($voyage);

    if($stmt){
        $response['results'] = null;
        $response['message'] = "voyage modifié";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);


}else if($_REQUEST['action'] == 'final'){

    $response = array();

    $stmt = $controller->finalize($_POST['id'], $_POST['status_voyage']);

    if($stmt){
        $response['results'] = null;
        $response['message'] = "voyage terminé";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);


}else if($_REQUEST['action'] == 'annulation'){

    $response = array();

    $stmt = $controller->annulation($_POST['id'], $_POST['annulation']);

    if($stmt){
        $response['results'] = null;
        $response['message'] = "voyage annulé";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);


}else if($_REQUEST['action'] == 'permut'){

    $response = array();

    $query = "UPDATE voyage SET PERMUTATION=".$_POST['permutation'].",
    DESCRIPTION_VOYAGE='".$_POST['desc_voyage']."', DATE_MODIFICATION='".Date('Y-m-d')."' WHERE ID_VOYAGE=".$_POST['id'];

    $stmt = $controller->execute($query);

    if($stmt){
        $response['results'] = null;
        $response['message'] = "Enregistré";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);


}else if($_REQUEST['action'] == 'avance'){

    $response = array();

    $query = "UPDATE voyage SET AVANCE_PAIEMENT=".$_POST['avance'].", DATE_MODIFICATION='".Date('Y-m-d')."' WHERE ID_VOYAGE=".$_POST['id'];

    $stmt = $controller->execute($query);

    if($stmt){
        $response['results'] = null;
        $response['message'] = "Enregistré";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);


}else if($_REQUEST['action'] == 'autre_depense'){

    $response = array();

    $query = "UPDATE voyage SET AUTRE_DEPENSE=".$_POST['autre'].", DATE_MODIFICATION='".Date('Y-m-d')."' WHERE ID_VOYAGE=".$_POST['id'];

    $stmt = $controller->execute($query);

    if($stmt){
        $response['results'] = null;
        $response['message'] = "Enregistré";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);


}else if($_REQUEST['action'] == 'terminate'){

    $response = array();

    $query = "UPDATE voyage SET TONNAGE_DEPART=".$_POST['ton_depart'].",
    TONNAGE_ARRIVE=".$_POST['ton_arrive'].", NOMBRE_SAC=".$_POST['nombre_sac'].",
    DIFFERENCE_POIDS=".$_POST['dif_poids'].", FACTURATION_TRANSPORTEUR=".$_POST['facturation_trans'].",
    DEPENSE_JUBENROS=".$_POST['depense_jubenros'].", FACTURATION_CHAUFFEUR=".$_POST['facturation_chauffeur'].",
    TONNAGE_TRANS=".$_POST['tonnage_trans'].", NUM_BE='".$_POST['num_be']."',
    FINAL=".$_POST['final'].", DATE_MODIFICATION='".Date('Y-m-d')."'
    WHERE ID_VOYAGE=".$_POST['id'];

    $stmt = $controller->execute($query);

    if($stmt){
        $response['results'] = null;
        $response['message'] = "Enregistré";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);


}else if($_REQUEST['action'] == 'incident'){

    $response = array();

    $query = "UPDATE voyage SET INCIDENT_SURVENU='".$_POST['incident']."', DATE_MODIFICATION='".Date('Y-m-d')."' WHERE ID_VOYAGE=".$_POST['id'];

    $stmt = $controller->execute($query);

    if($stmt){
        $response['results'] = null;
        $response['message'] = "Enregistré";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);


}else if($_REQUEST['action'] == 'update_min'){

    $response = array();

    $st = $controller->dispo($_POST['id_chauf']);

    $exist = $st->fetchAll(PDO::FETCH_ASSOC);

    if(!$exist) {
        $query = "UPDATE voyage SET ID_CHAUFFEUR=".$_POST['id_chauf'].",
                   ID_SITE=".$_POST['id_site'].", SIT_ID_SITE=".$_POST['sit_id_site'].",
                    ID_CLIENT=".$_POST['id_client'].", ID_PRODUIT=".$_POST['id_prod'].",
                    TONNAGE_DEPART=".$_POST['ton_depart'].", NUM_RECU='".$_POST['num_recu']."',
                     DATE_CREATION='".$_POST['date_creation']."', DATE_MODIFICATION='".Date('Y-m-d')."' WHERE ID_VOYAGE = " . $_POST['id'];
    }else{
        $query = "UPDATE voyage SET ID_CHAUFFEUR=".$_POST['id_chauf'].",
                   ID_SITE=".$_POST['id_site'].", SIT_ID_SITE=".$_POST['sit_id_site'].",
                    ID_CLIENT=".$_POST['id_client'].", ID_PRODUIT=".$_POST['id_prod'].",
                    TONNAGE_DEPART=".$_POST['ton_depart'].", NUM_RECU='".$_POST['oldnum_recu']."',
                     DATE_CREATION='".$_POST['date_creation']."', DATE_MODIFICATION='".Date('Y-m-d')."' WHERE ID_VOYAGE = " . $_POST['id'];
    }

    $stmt = $controller->execute($query);

    if($stmt){
        $response['results'] = null;
        $response['message'] = "voyage modifié";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}
else if($_REQUEST['action'] == 'suppr'){
    $response = array();

    $stmt = $controller->delete($_GET['id']);

    if($stmt){
        $response['results'] = null;
        $response['message'] = "voyage supprimé";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}
