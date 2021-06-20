<?php

include_once "../controller/userCtrl.php";
include_once "../controller/session.php";
include_once "../model/user.php";
include_once "../database.php";

$base = new Database();
$conn = $base->getConnection();
$controller = new userCtrl($conn);

if($_REQUEST['action'] == "session"){
    $db = new Session();
    $response = array();
    $session = $db->getSession();
    if(isset($session) && $session['uid'] != ''){
        $response["uid"] = $session['uid'];
        $response["pseudo"] = $session['pseudo'];
        $response["nom"] = $session['nom'];
        $response["prenom"] = $session['prenom'];
        $response['status'] = 'success';
    }else{
        $response['status'] = 'error';
    }
    echo json_encode($response);
}
else if($_REQUEST['action'] == "logout"){
    $db = new Session();
    $session = $db->destroySession();
    $response["status"] = "success";
    $response["message"] = "Aurevoir";
    echo json_encode($response);
}
else if($_REQUEST['action'] == "auth"){
    if(isset($_POST['pseudo']) && $_POST['password']){
        $response = array();

        $stmt = $controller->auth($_POST['pseudo'], md5($_POST['password']));

        $user2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($user2 != null){
            $user = $user2[0];
            $response['status'] = "success";
            $response['message'] = 'Bienvenue ' . $user['NOM_USER'];
            $response['nom'] = $user['NOM_USER'];
            $response['prenom'] = $user['PRENOM_USER'];
            $response['uid'] = $user['ID_USER'];
            $response['pseudo'] = $user['PSEUDO_USER'];
            $response['dateins'] = $user['DATE_CREAT_USER'];
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['uid'] = $user['ID_USER'];
            $_SESSION['pseudo'] = $user['PSEUDO_USER'];
            $_SESSION['nom'] = $user['NOM_USER'];
            $_SESSION['prenom'] = $user['PRENOM_USER'];
            $_SESSION['dateins'] = $user['DATE_CREAT_USER'];
        } else {
            $response['status'] = "error";
            $response['message'] = 'Compte ou mot de passe incorrecte.';
        }
    }else{
        $response['status'] = "error";
        $response['message'] = 'Veillez remplir tous les champs SVP';
    }
    echo json_encode($response);
}
else if($_REQUEST['action'] == "getAll"){
    $response = array();

    $stmt = $controller->get();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows) > 0){
        $response['results'] = $rows;
        $response['message'] = "Utilisateurs trouvés";
        $response['status'] = "success";
    }else {
        $response['results'] = null;
        $response['message'] = "aucune réponse";
        $response['status'] = "error";
    }
    echo json_encode($response);
}
else if($_REQUEST['action'] == "getOne"){
    $response = array();

    $stmt = $controller->getById(($_GET['id']));

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($rows) > 0){
        $response['results'] = $rows;
        $response['message'] = "Utilisateurs trouvés";
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

    $res = $controller->getByPseudo($_POST['pseudo']);

    $content = $res->fetchAll(PDO::FETCH_ASSOC);

    if($content == null){
        $user = new User(null, $_POST['nom'], $_POST['prenom'], $_POST['pseudo'],
            MD5($_POST['password']), $_POST['poste'], Date('Y-m-d'), Date('Y-m-d'));

        $stmt = $controller->insert($user);

        $number = $conn->lastInsertId();

        if($number > 0){
            $response['results'] = null;
            $response['message'] = "Insertion réussi";
            $response['status'] = "success";
        }else{
            $response['results'] = null;
            $response['message'] = "Erreur lors de l'insertion de l'utilisateur.";
            $response['status'] = "error";
        }
    }else{
        $response['results'] = null;
        $response['message'] = "Cet utilisateur existe déjà.";
        $response['status'] = "error";
    }

    echo json_encode($response);
}
else if($_REQUEST['action'] == "update"){
    $response = array();

    $res = $controller->getByPseudo($_POST['pseudo']);

    $content = $res->fetchAll(PDO::FETCH_ASSOC);

    if(is_null($content)){
        $user = new User($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['pseudo'],
            MD5($_POST['password']), $_POST['poste'], $_POST['date_create'], Date('Y-m-d'));
    }else{
        $user = new User($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['oldpseudo'],
            MD5($_POST['password']), $_POST['poste'], $_POST['date_create'], Date('Y-m-d'));
    }

    $stmt = $controller->update($user);

    if($stmt){
        $response['results'] = null;
        $response['message'] = "Utilisateur modifié avec succès";
        $response['status'] = "success";
    }else{
        $response['results'] = null;
        $response['message'] = "Erreur lors de la modification de l'utilisateur.";
        $response['status'] = "error";
    }
    echo json_encode($response);
}
else if($_REQUEST['action'] == "suppr"){
    $response = array();

    $stmt = $controller->delete($_GET['id']);

    if($stmt){
        $response['results'] = null;
        $response['message'] = "Utilisateur supprimé avec succès.";
        $response['status'] = "success";
    }else{
        $response['results'] = null;
        $response['message'] = "Erreur lors de la suppression de l'utilisateur.";
        $response['status'] = "error";
    }
    echo json_encode($response);
}