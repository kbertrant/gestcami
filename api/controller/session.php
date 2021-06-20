<?php

class Session{

    public function getSession(){
        if (!isset($_SESSION)) {
            session_start();
        }
        $sess = array();
        if(isset($_SESSION['uid']))
        {
            $sess["uid"] = $_SESSION['uid'];
            $sess["nom"] = $_SESSION['nom'];
            $sess["prenom"] = $_SESSION['prenom'];
            $sess["pseudo"] = $_SESSION['pseudo'];
        }
        else
        {
            $sess["uid"] = '';
            $sess["nom"] = 'Geekles';
            $sess["prenom"] = '';
            $sess["pseudo"] = '';
        }
        return $sess;
    }

    public function destroySession(){
        if (!isset($_SESSION)) {
            session_start();
        }
        if(isSet($_SESSION['uid']))
        {
            unset($_SESSION['uid']);
            unset($_SESSION['nom']);
            unset($_SESSION['prenom']);
            unset($_SESSION['pseudo']);
            $info='info';
            $msg="Aurevoir...";
        }
        else
        {
            $msg = "Echec de déconnexion";
        }
        return $msg;
    }
}