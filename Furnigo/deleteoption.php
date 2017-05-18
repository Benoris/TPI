<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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