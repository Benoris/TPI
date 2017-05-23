<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'quotation.php';

$nbOption = filter_input(INPUT_POST, 'nbOption', FILTER_SANITIZE_NUMBER_INT);
$nbOption = intval($nbOption);

$lieu = filter_input(INPUT_POST, 'lieu', FILTER_SANITIZE_STRING);
$poids = filter_input(INPUT_POST, 'poid', FILTER_VALIDATE_INT);
$surface = filter_input(INPUT_POST, 'surface', FILTER_VALIDATE_INT);
$distance = filter_input(INPUT_POST, 'distance', FILTER_VALIDATE_INT);
$idDevis = filter_input(INPUT_POST, 'idDevis', FILTER_VALIDATE_INT);
$total = filter_input(INPUT_POST, 'optionTotal', FILTER_VALIDATE_FLOAT);
$totalm3 = 0;


for ($i = 1; $i <= $nbOption; $i++) {
    $totalm3 += $_POST['qtOption' . $i];
}

$requete = "UPDATE r_ajouter SET M3 = ( CASE idOption";

for ($i = 1; $i <= $nbOption; $i++) {
    $requete .= " WHEN " . $i . " THEN " . $_POST['qtOption' . $i];
}
$requete .= " END ) WHERE idDevis IN (" . $idDevis . ")";

if (SendQuotation($requete)) {
    if (UpdateQuotation($idDevis, $total)) {
        if (UpdateDetails($lieu, $totalm3, $surface, $poids, $distance, $idDevis))
            header("Location: devis.php?msg=17");
        exit;
    }
    else {
        header("Location: devis.php?msg=99");
        exit;
    }
} else {
    header("Location: devis.php?msg=99");
    exit;
}