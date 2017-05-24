<?php

/*
  Projet: Site de déménagement
  Auteur:     Exemple fonctionel de déconnection du site php
  Classe:     I.IN-P4B
  Titre:      logout.php
  Description: http://php.net/manual/fr/function.session-destroy.php
  Date:       24/05/2017
 */

session_start();
if ($_SESSION['name'] != '') {


// Détruit toutes les variables de session
    $_SESSION = array();

// Si vous voulez détruire complètement la session, effacez également
// le cookie de session.
// Note : cela détruira la session et pas seulement les données de session !
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
        );
    }

// Finalement, on détruit la session.
    session_destroy();
    header("Location:index.php");
} else if ($_SESSION['name'] == '') {
    header("Location:connexion.php?msg=2");
    exit();
}