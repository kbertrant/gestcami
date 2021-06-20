<?php

include_once "../controller/clientCtrl.php";
include_once"../model/client.php";
include_once"../database.php";

$base = new database;
$conn = $base->getconnection();
$controller = new ClientCtrl($conn);

if($_REQUEST['action'] =="getAll")
{

    $reponse = array();

    $stmt = $controller->get();

    $rows = $stmt->fetchAll(PDO:: FETCH_ASSOC);

    if(count($rows) >0){
        $response['results'] = $rows;
        $response['message'] = "produit trouvé";
        $response['status'] = "success";
    }
    else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}else if($_REQUEST['action'] == "getById") {

    $response = array();

    $stmt = $controller->getById($_GET['id']);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows) > 0){
        $response['results'] = $rows;
        $response['message'] = "produit trouvés";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}
else if($_REQUEST['action'] == "insert"){
    $response = array();

    $st = $controller->getByNom($_POST['nom']);


    $exist = $st->fetchAll(PDO::FETCH_ASSOC);

    if(!$exist)
    {
        $client = new Client(null, $_POST['nom'], Date('Y-m-d'), Date('Y-m-d'));

        $stmt = $controller->insert($client);

        $nbr = $conn->lastInsertId();

        if($nbr > 0)
        {
            $response['results'] = null;
            $response['message'] = "Client inséré";
            $response['status'] = "success";
        }
        else
         {
            $response['results'] = null;
            $response['message'] = "aucune réponse";
            $response['status'] = "error";
        }
    }
    else
    {
        $response['results'] = null;
        $response['message'] = "deja existant";
        $response['status'] = "error";
    }
    echo json_encode($response);
}
else if($_REQUEST['action'] == 'update')
{
    $response = array();

    $st = $controller->getByNom($_POST['nom']);

    $exist = $st->fetchAll(PDO::FETCH_ASSOC);

    if(!$exist){
        $client = new Client($_POST['id'], $_POST['nom'], $_POST['datecreate'], Date('Y-m-d'));
    }else{
        $client = new Client($_POST['id'], $_POST['oldnom'], $_POST['datecreate'], Date('Y-m-d'));
    }


    $stmt = $controller->update($client);

    if($stmt)
    {
        $response['results'] = null;
        $response['message'] = "Client modifié";
        $response['status'] = "success";
    }
    else
    {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);

}
else if($_REQUEST['action'] == 'suppr')
{
    $response = array();

    $stmt = $controller->delete($_GET['id']);

    if($stmt){
        $response['results'] = null;
        $response['message'] = "Client supprimé";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}
