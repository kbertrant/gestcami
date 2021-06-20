<?php

    header("content-type: application/json");

    function getExt($name){
        $array = explode(".", $name);
        $ext = strtolower(end($array));
        return $ext;
    }

    $allowed = ["png", "jpeg", "jpg"];
    $response = array();

for($j = 0; $j < $_POST['length']; $j++) {
    if (isset($_FILES["file-" . $j]) && !empty($_FILES['file-' . $j])) {
        foreach ((array)$_FILES['file-' . $j]['name'] as $key => $name) {
            $tmp = $_FILES['file-' . $j]['tmp_name'];
            $size = $_FILES['file-' . $j]['size'];
            $ext = getExt($name);
            if (in_array($ext, $allowed) === true) {
                if ($size <= 2097152) {
                    $filename = md5($name) . '.' . $ext;
                    if (isset($_POST['nom'])) {
                        $rpt = '../../upload/fiscales/fisc_' . $_POST['nom'];
                        if (!is_dir($rpt)) {
                            if (!mkdir($rpt, 0755, true)) {
                                $response['results'] = null;
                                $response['message'] = "Echec lors de la création des répertoires...";
                                $response['status'] = "error";
                            } else {
                                if (move_uploaded_file($tmp, $rpt . '/' . $filename) === true) {
                                    $response['results'] = null;
                                    $response['message'] = "Téléchargement réussi";
                                    $response['status'] = "success";
                                } else {
                                    $response['results'] = null;
                                    $response['message'] = "Echec de la procédure";
                                    $response['status'] = "error";
                                }
                            }
                        } else {
                            if (move_uploaded_file($tmp, $rpt . '/' . $filename) === true) {
                                $response['results'] = null;
                                $response['message'] = "Téléchargement réussi";
                                $response['status'] = "success";
                            } else {
                                $response['results'] = null;
                                $response['message'] = "Echec de la procédure";
                                $response['status'] = "error";
                            }
                        }
                    } else {
                        $response['results'] = null;
                        $response['message'] = "Veillez entrer le nom du transporteur";
                        $response['status'] = "error";
                    }
                } else {
                    $response['results'] = null;
                    $response['message'] = "Fichier trop grand";
                    $response['status'] = "error";
                }
            } else {
                $response['results'] = null;
                $response['message'] = "Impossible d'ajouter un fichier de ce type.";
                $response['status'] = "error";
            }
        }
    }
}

    echo json_encode($response);