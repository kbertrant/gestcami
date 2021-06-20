<?php

include_once "../controller/siteCrtl.php";
include_once "../model/site.php";
include_once "../database.php";

$base = new Database();
$conn = $base->getConnection();
$controller = new SiteCrtl($conn);


if($_REQUEST['action'] == "getAll"){
    $response = array();

    $stmt = $controller->get();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows) > 0){
        $response['results'] = $rows;
        $response['message'] = "site trouvés";
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
        $response['message'] = "site trouvés";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}else if($_REQUEST['action'] == 'insert'){
    $response = array();

    $st = $controller->getByNomSite($_POST['nom']);
    

    $exist = $st->fetchAll(PDO::FETCH_ASSOC);

    if(!$exist){
        $site = new Site(null, $_POST['nom'],$_POST['region'],date('Y-m-d'),date('Y-m-d'),$_POST['pfacture'],$_POST['ptransport']);

        $stmt = $controller->insert($site);

        $nbr = $conn->lastInsertId();

        if($nbr > 0){
            $response['results'] = null;
            $response['message'] = "site inséré";
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

    $st = $controller->getByNomSite($_POST['nom']);
   

    $exist = $st->fetchAll(PDO::FETCH_ASSOC);

    if(!$exist){
        $site = new Site($_POST['id'], $_POST['nom'],$_POST['region'],date('Y-m-d'),$_POST['datecreation'],$_POST['pfacture'],$_POST['ptransport']);
    }else{
        $site = new Site($_POST['id'], $_POST['oldnom'],$_POST['region'],date('Y-m-d'),$_POST['datecreation'],$_POST['pfacture'],$_POST['ptransport']);
    }

    $stmt = $controller->update($site);

    if($stmt){
        $response['results'] = null;
        $response['message'] = "site modifié";
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
        $response['message'] = "site supprimé";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}