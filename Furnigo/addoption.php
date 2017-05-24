<?php

/*
Projet: Site de déménagement
Auteur:     Maurice Dinh
Classe:     I.IN-P4B
Titre:      addoption.php
Description: Fichier d'ajout d'une option suivie d'une redirection avec un message
Date:       24/05/2017
 */

require_once 'quotation.php';

$description = filter_input(INPUT_POST, 'description',FILTER_SANITIZE_STRING);
$supp = filter_input(INPUT_POST, 'prix',FILTER_VALIDATE_INT);
$pm3 = filter_input(INPUT_POST, 'pm3',FILTER_VALIDATE_INT);

if(CreateOption($description, $supp, $pm3)){
    header("Location:adminoptions.php?msg=1");
    exit;
}
else{
    header("Location:adminoptions.php?msg=2");
    exit;
}