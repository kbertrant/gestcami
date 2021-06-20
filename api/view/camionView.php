<?php

include_once "../controller/camionCrtl.php";
include_once "../model/camion.php";
include_once "../database.php";

$base = new Database();
$conn = $base->getConnection();
$controller = new CamionCrtl($conn);


if($_REQUEST['action'] == "getAll"){
    $response = array();

    $stmt = $controller->get();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows) > 0){
        $response['results'] = $rows;
        $response['message'] = "camion trouvés";
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
        $response['message'] = "camion trouvés";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}else if($_REQUEST['action'] == 'insert'){
    $response = array();

    $st = $controller->getByMatricule($_POST['matricule']);

    $exist = $st->fetchAll(PDO::FETCH_ASSOC);

    if(!$exist){
        $camion = new Camion(null, $_POST['id_trans'], $_POST['matricule'], $_POST['tonnage'], $_POST['couleur'], $_POST['marque'], $_POST['photo'], date('Y-m-d'), date('Y-m-d'));

        $stmt = $controller->insert($camion);

        $nbr = $conn->lastInsertId();

        if(count($nbr) > 0){
            $response['results'] = null;
            $response['message'] = "camion inséré";
            $response['status'] = "success";
        }else {
            $response['results'] = null;
            $response['message'] = "aucune réponse";
            $response['status'] = "error";
        }
    }else{
        $response['results'] = null;
        $response['message'] = "deja existant";
        $response['status'] = "error";
    }
    echo json_encode($response);
}else if($_REQUEST['action'] == 'update'){
    $response = array();

    $st = $controller->getByMatricule($_POST['matricule']);

    $exist = $st->fetchAll(PDO::FETCH_ASSOC);

    if(!$exist){
        $camion = new Camion($_POST['id'], $_POST['id_trans'], $_POST['matricule'], $_POST['tonnage'], $_POST['couleur'], $_POST['marque'],
            $_POST['photo'], $_POST['datecreation'], date('Y-m-d'));
    }else{
        $camion = new Camion($_POST['id'], $_POST['id_trans'], $_POST['oldMatricule'], $_POST['tonnage'], $_POST['couleur'], $_POST['marque'],
            $_POST['photo'], $_POST['datecreation'], date('Y-m-d'));
    }
    
    $stmt = $controller->update($camion);
    
    if($stmt){
        $response['results'] = null;
        $response['message'] = "camion modifié";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}else if($_REQUEST['action'] == 'suppr'){
    $response = array();

    $stmt = $controller->delete($_GET['id']);

    if($stmt){
        $response['results'] = null;
        $response['message'] = "camion supprimé";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}
