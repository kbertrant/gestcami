<?php

include_once "../controller/chauffeurCtrl.php";
include_once"../model/chauffeur.php";
include_once"../database.php";

$base = new database;
$conn = $base->getconnection();
$controller = new ChauffeurCtrl($conn);

if($_REQUEST['action'] =="getAll")
{

	$reponse = array();

	$stmt = $controller->get();

	$rows = $stmt->fetchAll(PDO:: FETCH_ASSOC);

	if(count($rows) >0){
		$response['results'] = $rows;
        $response['message'] = "chauffeur trouvé";
        $response['status'] = "success";
	}
	else {
		$response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
	}
	echo json_encode($response);
}
else if ($_REQUEST['action'] =="getById" ) {

    $response = array();

    $stmt = $controller->getById($_GET['id']);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows) > 0){
        $response['results'] = $rows;
        $response['message'] = "chauffeur trouvés";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}else if ($_REQUEST['action'] =="getAllByTrans" ) {

    $response = array();

    $stmt = $controller->getByIdTransp($_GET['id']);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows) > 0){
        $response['results'] = $rows;
        $response['message'] = "chauffeur trouvés";
        $response['status'] = "success";
    }else {
        $response['results'] = [];
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}
else if($_REQUEST['action'] =='insert')
{
    $response = array();

    $st = $controller->getByNom($_POST['nom']);

    $exist = $st->fetchAll(PDO::FETCH_ASSOC);

    if(!$exist)
    {
        $Chauffeur = new Chauffeur(null, $_POST['camion'], $_POST['nom'], $_POST['cni'], $_POST['statut'], $_POST['contact'], Date('Y-m-d'), Date('Y-m-d'));

        $stmt = $controller->insert($Chauffeur);

        $nbr = $conn->lastInsertId();

        if($nbr > 0)
        {
            $response['results'] = null;
            $response['message'] = "chauffeur inséré";
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

    if(!$exist)
    {
        $chauffeur = new Chauffeur($_POST['id'], $_POST['camion'], $_POST['nom'], $_POST['cni'], $_POST['statut'], $_POST['contact'], $_POST['datecreate'], Date('Y-m-d'));
    }
    else
    {
        $chauffeur = new Chauffeur($_POST['id'], $_POST['camion'], $_POST['oldnom'], $_POST['cni'], $_POST['statut'], $_POST['contact'], $_POST['datecreate'], Date('Y-m-d'));
    }

    $stmt = $controller->update($chauffeur);

    if($stmt)
    {
        $response['results'] = null;
        $response['message'] = "chauffeur modifié";
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
        $response['message'] = "chauffeur supprimé";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}