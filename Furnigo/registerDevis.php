<?php

/*
Projet:     Site de déménagement
Auteur:     Maurice Dinh
Classe:     I.IN-P4B
Titre:      registerDevis.php
Description: Page de redirection des données du formulaire de création d'un devis.
Date:       24/05/2017
 */

if($_POST['optionTotal']!=0){
    

session_start();
if (isset($_SESSION['name'])) {
    require_once 'quotation.php';
    //Données des options
    $nbOption = filter_input(INPUT_POST, 'nbOption', FILTER_SANITIZE_NUMBER_INT);
    $nbOption = intval($nbOption);
    $pricetotal = filter_input(INPUT_POST, 'optionTotal', FILTER_VALIDATE_FLOAT);
    $idUser = $_SESSION['idUser'];
    $idUser = intval($idUser);
    
    //Données du formulaire de détail
    $lieu = filter_input(INPUT_POST,'lieu', FILTER_SANITIZE_STRING);
    $poids = filter_input(INPUT_POST,'poid', FILTER_VALIDATE_INT);
    $surface = filter_input((INPUT_POST), 'surface', FILTER_VALIDATE_INT);
    $distance = filter_input(INPUT_POST, 'distance',FILTER_VALIDATE_INT);
    
    $totalm3 = 0;
    
    for ($i = 1; $i <= $nbOption; $i++) {
    $totalm3 += $_POST['qtOption' . $i];
}
    $idDevis = CreateQuotation($pricetotal,$totalm3,$idUser);
    
    
    $detail = AddDetails($lieu,$totalm3,$surface,$poids,$distance,$idDevis);
    if($idDevis != FALSE){
        
    $request = "INSERT INTO r_ajouter (idDevis,idOption,M3) VALUES";
    for ($i = 1; $i <= $nbOption; $i++) {
        $m3 = $_POST['qtOption' . $i];
        $request .= "($idDevis," . $i . "," . $m3 . ")";
        if($i != $nbOption){
            $request .= ",";
        }
        else{
            $request .= ";";
        }
    }
    $result = SendQuotation($request);
    if($result == true){
        header("Location:devis.php");
    }
    else{
        header("Location:calculateur.php");
    }
    }
    else{
        header("Location:calculateur.php");
    }
    if(isset($_GET['id']) && CheckQuotation($_SESSION['idUser'], $_GET['id'])){
        DeleteQuotation($_GET['id']);
}
}
else{
    header("Location:connexion.php?msg=4");
}
}
else{
    header("Location:calculateur.php");
}

