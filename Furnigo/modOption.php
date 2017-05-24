<?php

/*
Projet: Site de déménagement
Auteur:     Maurice Dinh
Classe:     I.IN-P4B
Titre:      modOption.php
Description: Page d'appel de fonction de modification d'une option et de redirection à adminoptions.php avec un code de message
Date:       24/05/2017
 */
require_once 'quotation.php';

$desc = filter_input(INPUT_POST, 'Desc',FILTER_SANITIZE_STRING);
$prix = filter_input(INPUT_POST, 'supp', FILTER_SANITIZE_NUMBER_INT);
$pm3 = filter_input(INPUT_POST, 'pm3',FILTER_SANITIZE_NUMBER_INT);
$idOption = filter_input(INPUT_POST, 'idOption', FILTER_SANITIZE_NUMBER_INT);

if(UpdateOption($idOption, $desc, $prix, $pm3)){
    header("Location:adminoptions.php?msg=1");
    exit;
}
else{
    header("Location:adminoptions.php?msg=2");
    exit;
}