<?php

/*
  Projet: Site de déménagement
  Auteur:     Maurice Dinh
  Classe:     I.IN-P4B
  Titre:      login.php
  Description: Page de connexion et de redirection
  Date:       24/05/2017
 */


require_once 'users.php';

if (isset($_POST['send'])) {
    //Filtrage des données reçu en POST avant de les stocker dans des variables pour être utilisé comme paramètre
    $pseudo = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING));
    $pwd = trim(filter_input(INPUT_POST, 'pwd', FILTER_SANITIZE_STRING));
    $hashpwd = sha1($pwd);
    $sess = CheckUserId($pseudo, $hashpwd);
    if ($sess) {
        session_start();
        $_SESSION['name'] = $sess[0]['Login'];
        $_SESSION['idUser'] = $sess[0]['idClient'];
        $_SESSION['mode'] = $sess[0]['UserMode'];
        header("Location: index.php");
    } else {
        header("Location: connexion.php?msg=3");
    }
}
