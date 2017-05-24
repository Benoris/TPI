<?php

/*
Projet:     Site de déménagement
Auteur:     Maurice Dinh
Classe:     I.IN-P4B
Titre:      deleteoption.php
Description: Page de suppression d'une option et de redirection
Date:       24/05/2017
 */

require_once 'quotation.php';

$idOption = filter_input(INPUT_GET, 'id',FILTER_SANITIZE_STRING);

if(DeleteOption($idOption)){
    header("Location:adminoptions.php?msg=1");
    exit;
}
else{
    header("Location:adminoptions.php?msg=2");
}