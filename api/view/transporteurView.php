<?php

include_once "../controller/transporteurCtrl.php";
include_once"../model/transporteur.php";
include_once"../database.php";

$base = new database;
$conn = $base->getconnection();
$controller = new transporteurCtrl($conn);

if($_REQUEST['action'] =="getAll")
{
	$response = array();
    $df = array();
    $tmps = array();

	$stmt = $controller->get();

	$rows = $stmt->fetchAll(PDO:: FETCH_ASSOC);

	for($i = 0; $i < count($rows); $i++) {
			$rows[$i]['fiscs'] = explode('--', $rows[$i]['DOSSIER_FISCALE']);
	}

	if(count($rows) >0){
		$response['results'] = $rows;
        $response['message'] = "transporteur trouvé";
        $response['status'] = "success";
	}
	else {
		$response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
	}
	echo json_encode($response);
}
elseif ($_REQUEST['action'] =="getById" ) {
    $response = array();
    $df = array();
    $tmps = array();

    $stmt = $controller->getById($_GET['id']);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($rows as $r){
        $df = explode('--', $r['DOSSIER_FISCALE']);
        $tmps = explode('--', $r['TMP']);
        $rows[0]['listImage'] = $df;
        $rows[0]['tmps'] = $tmps;
    }

    if(count($rows) > 0){
        $response['results'] = $rows;
        $response['message'] = "transporteur trouvés";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
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
        $transporteur = new Transporteur(null, $_POST['nom'], $_POST['contact'], trim($_POST['fiscale'], '--'), $_POST['nameinterne'], Date('y-m-d'), Date('y-m-d'), $_POST['orange'], trim($_POST['tmp'], '--'));

        $stmt = $controller->insert($transporteur);

        $nbr = $conn->lastInsertId();

        if($nbr > 0)
        {
            $response['results'] = null;
            $response['message'] = "transporteur inséré";
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

    $st = $controller->getBynom($_POST['nom']);

    $exist = $st->fetchAll(PDO::FETCH_ASSOC);

    if(!$exist)
    {
        $transporteur = new Transporteur($_POST['id'], $_POST['nom'], $_POST['contact'], trim($_POST['fiscale'], '--'), $_POST['nameinterne'], $_POST['Datecreation'], Date('y-m-d'), $_POST['orange'], trim($_POST['tmp'], '--'));
    }
    else
    {
        $transporteur = new Transporteur($_POST['id'], $_POST['oldnom'], $_POST['contact'], trim($_POST['fiscale'], '--'), $_POST['nameinterne'], $_POST['Datecreation'], Date('y-m-d'), $_POST['orange'], trim($_POST['tmp'], '--'));
    }

    $stmt = $controller->update($transporteur);

    if($stmt)
    {
        $response['results'] = null;
        $response['message'] = "transporteur modifié";
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

    $stmt = $controller->delete($_GET['Id']);

    rmdir('../../upload/fiscales/fisc_' . $_GET['nom']);

    if($stmt){
        $response['results'] = null;
        $response['message'] = "transporteur supprimé";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}
