<?php

include_once "../controller/produitCtrl.php";
include_once"../model/produit.php";
include_once"../database.php";

$base = new database;
$conn = $base->getconnection();
$controller = new ProduitCtrl($conn);

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
}
else if($_REQUEST['action'] == "getById") {

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
        $produit = new Produit(null, $_POST['nom'], $_POST['description'], Date('Y-m-d'), Date('Y-m-d'));

        $stmt = $controller->insert($produit);

        $nbr = $conn->lastInsertId();

        if($nbr > 0)
        {
            $response['results'] = null;
            $response['message'] = "Produit inséré";
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
        $Produit = new Produit($_POST['id'], $_POST['nom'], $_POST['description'], $_POST['datecreate'], Date('Y-m-d'));
    }else{
        $Produit = new Produit($_POST['id'], $_POST['oldnom'], $_POST['description'], $_POST['datecreate'], Date('Y-m-d'));
    }

    
    $stmt = $controller->update($Produit);

    if($stmt)
    {
        $response['results'] = null;
        $response['message'] = "Produit modifié";
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
        $response['message'] = "produit supprimé";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}