<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'dbconnect.php';

function GetForfait(){
    $db = connectdb();
    $sql = $db->prepare("SELECT * FROM t_forfait");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}
function GetOptions(){
    $db = connectdb();
    $sql = $db->prepare("SELECT * FROM t_options");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

function GetOption($idDevis){
    $db = connectdb();
    $sql = $db->prepare("SELECT * FROM r_ajouter WHERE idDevis = :idDevis");
    $sql->bindParam(":idDevis", $idDevis,  PDO::PARAM_INT);
    if($sql->execute()){
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        return false;
    }
}