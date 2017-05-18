<?php

/*
Auteur:     Maurice Dinh
Classe:     I.IN-P4B
Titre:      index.php
Description: Fichier de redirection d'ajout d'une option
Date:       10/05/2017
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