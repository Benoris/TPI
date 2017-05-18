<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'quotation.php';

$nbOption = filter_input(INPUT_POST, 'nbOption', FILTER_SANITIZE_NUMBER_INT);
$nbOption = intval($nbOption);

$requete = "UPDATE r_ajouter SET M3 = ( CASE idOption";

for($i = 1;$i<=$nbOption;$i++){
    $requete .= " WHEN ".$i." THEN ".$_POST['qtOption'.$i];
}
$requete .= " END ) WHERE idDevis IN (".$_POST['idDevis'].")";

if(SendQuotation($requete)){
    if(UpdateQuotation($_POST['idDevis'],$_POST['optionTotal'])){
        header("Location: devis.php?msg=17");
    }
    else{
        header("Location: devis.php?msg=99");
    }
}
else{
    header("Location: devis.php?msg=99");
}