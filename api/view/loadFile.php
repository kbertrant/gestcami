<?php

header("content-type: application/json");

function getExt($name){
    $array = explode(".", $name);
    $ext = strtolower(end($array));
    return $ext;
}

$allowed = ["png", "jpeg", 'jpg'];
$response = array();
for($j = 0; $j < $_POST['length']; $j++){
    if(isset($_FILES["file-".$j]) && !empty($_FILES['file-'.$j])){
        foreach((array)$_FILES['file-'.$j]['name'] as $key => $name){
            $tmp = $_FILES['file-'.$j]['tmp_name'];
            $size = $_FILES['file-'.$j]['size'];
            $ext = getExt($name);
            if(in_array($ext, $allowed) === true){
                if(isset($_POST['nom'])){
                    if($size <= 2097152){
                        $filename = md5($name).'.'.$ext;
                        $response[$j]['tmp'] = $tmp;
                        $response[$j]['size'] = $size;
                        $response[$j]['extension'] = $ext;
                        $response[$j]['name'] = $filename;
                        $response[$j]['chemin'] = 'upload/fiscales/fisc_'.$_POST['nom'].'/'.$filename;
                        $response[$j]['message'] = "fichier récupéré";
                        $response[$j]['status'] = "success";
                    }else{
                        $response['results'] = null;
                        $response['message'] = "Fichier trop grand";
                        $response['status'] = "error";
                    }
                }else{
                    $response['results'] = null;
                    $response['message'] = "Veillez entrer le nom du transporteur";
                    $response['status'] = "error";
                }
            }else{
                $response['results'] = null;
                $response['message'] = "Impossible d'ajouter un fichier de ce type.";
                $response['status'] = "error";
            }
        }
    }
}


echo json_encode($response);