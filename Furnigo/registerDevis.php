<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if (isset($_SESSION['name'])) {
    require_once 'quotation.php';
    
    $nbOption = filter_input(INPUT_POST, 'nbOption', FILTER_SANITIZE_NUMBER_INT);
    $nbOption = intval($nbOption);
    $pricetotal = filter_input(INPUT_POST, 'optionTotal', FILTER_SANITIZE_NUMBER_INT);
    $pricetotal = intval($pricetotal);
    $idUser = $_SESSION['idUser'];
    $idUser = intval($idUser);
    $totalm3 = 0;
    
    for ($i = 1; $i < $nbOption; $i++) {
        $totalm3 += $_POST['qtOption' . $i];
    }
    $idDevis = CreateQuotation($pricetotal,$totalm3,$idUser);
    if($idDevis != FALSE){
        
    $request += "INSERT INTO r_ajouter (idDevis,idOption,M3) VALUES";
    for ($i = 1; $i <= $nbOption; $i++) {
        $m3 = trim(filter_input(INPUT_POST, 'qt' . $i, FILTER_SANITIZE_NUMBER_INT));
        $request += "(ajouterIdDevis," . $i . "," . $m3 . ")";
    }

    SendQuotation($request, $idDevis);
    header("Location:devis.php");
    }
    else{
        header("Location:calculateur.php");
    }
}
else{
    header("Location:connexion.php?msg=4");
}