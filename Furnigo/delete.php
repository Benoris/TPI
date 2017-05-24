<?php

/*
  Projet: Site de déménagement
  Auteur:     Maurice Dinh
  Classe:     I.IN-P4B
  Titre:      delete.php
  Description: Page de suppression d'un utilisateur et de redirection avec message
  Date:       24/05/2017
 */

if (!isset($_SESSION['name'])) {
    session_start();
}
require_once 'users.php';
ifAdmin($_SESSION['mode']);

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$result = DeleteUser($id);

if ($result) {
    header("Location: adminoptions.php?msg=1");
    exit;
} else {
    header("Location: adminoptions.php?msg=2");
    exit;
}