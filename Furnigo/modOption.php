<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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