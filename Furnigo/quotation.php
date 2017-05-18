<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'dbconnect.php';

function CreateQuotation($pricetotal,$m3total,$idClient){
    $db = connectdb();
    $sql = $db->prepare("INSERT INTO t_devis (Montant,DateDevis,TotalM3,idClient) VALUES (:pricetotal,NOW(),:m3total,:idClient)");
    $sql->bindParam(':pricetotal',$pricetotal,PDO::PARAM_INT);
    $sql->bindParam(':m3total',$m3total,PDO::PARAM_INT);
    $sql->bindParam(':idClient',$idClient,PDO::PARAM_INT);
    if($sql->execute()){
        return $db->lastInsertId();
    }
    else{
        return false;
    }
}

function SendQuotation($requete){
    $db = connectdb();
    $sql = $db->prepare($requete);
    if($sql->execute()){
        return true;
    }
    else{
        return false;
    }
}

function GetQuotation($idUser){
    $db = connectdb();
    $sql = $db->prepare("SELECT * FROM t_devis WHERE idClient = :idUser");
    $sql->bindParam(':idUser',$idUser,PDO::PARAM_INT);
    if($sql->execute()){
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        return false;
    }
}

function CheckQuotation($idUser,$idQuotation){
    $db = connectdb();
    $sql = $db->prepare("SELECT * FROM t_devis WHERE idClient = :idUser AND idDevis = :idQuotation");
    $sql->bindParam(":idUser", $idUser,PDO::PARAM_INT);
    $sql->bindParam(":idQuotation", $idQuotation,PDO::PARAM_INT);
    $sql->execute();
    $content = $sql->fetchAll(PDO::FETCH_ASSOC);
    if($content == NULL){
        return false;
    }
    else{
        return true;
    }
}

function DeleteQuotation($idQuotation){
    $db = connectdb();
    $sql = $db->prepare("DELETE FROM r_ajouter WHERE idDevis = :idQuotation");
    $sql->bindParam(":idQuotation", $idQuotation,PDO::PARAM_INT);
    if($sql->execute()){
        $sql = $db->prepare("DELETE FROM t_devis WHERE idDevis = :idQuotation");
        $sql->bindParam(":idQuotation", $idQuotation,PDO::PARAM_INT);
        $sql->execute();
    }
 else {
        return false;
    }
}

function UpdateQuotation($idQuot,$tot){
    $db = connectdb();
    $sql = $db->prepare("UPDATE `t_devis` SET DateDevis = NOW(), `TotalM3`= (SELECT SUM(M3) FROM r_ajouter WHERE r_ajouter.idDevis = :idQuot), Montant=:tot WHERE idDevis = :idQuot");
    $sql->bindParam(":idQuot", $idQuot,PDO::PARAM_INT);
    $sql->bindParam(":tot", $tot,  PDO::PARAM_INT);
    if($sql->execute()){
        return true;
    }
 else {
        return false;
    }
}
function GetOptions(){
    $db = connectdb();
    $sql = $db->prepare("SELECT * FROM t_options");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

function UpdateOption($idOption,$desc,$prix,$pm3){
    $db = connectdb();
    $sql = $db->prepare("UPDATE t_options SET DescriptionDetaillee = :desc, PrixSupplementDeBase = :prix, PrixAuM3 = :pm3 WHERE idOption = :idOption");
    $sql->bindParam(":desc", $desc, PDO::PARAM_STR);
    $sql->bindParam(":prix", $prix, PDO::PARAM_INT);
    $sql->bindParam(":pm3", $pm3, PDO::PARAM_INT);
    $sql->bindParam(":idOption", $idOption, PDO::PARAM_INT);
    if($sql->execute()){
        return true;
    }
    else{
        return false;
    }
}

function GetOptionById($idOption){
    $db = connectdb();
    $sql = $db->prepare("SELECT * FROM t_options WHERE idOption = :idOption");
    $sql->bindParam(":idOption", $idOption,  PDO::PARAM_INT);
    if($sql->execute()){
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        return false;
    }
}

function DeleteOption($idOption){
    $db = connectdb();
    $sql = $db->prepare("DELETE FROM t_options WHERE idOption = :idoption");
    $sql->bindParam(":idoption", $idOption,PDO::PARAM_INT);
    if($sql->execute()){
        return true;
    }
    else {
        return false;
    }
}

function CreateOption($description, $supp, $pm3){
    $db = connectdb();
    $sql = $db->prepare("INSERT INTO t_options (DescriptionDetaillee,PrixSupplementDeBase,PrixAuM3) VALUE(:desc,:supp,:pm3)");
    $sql->bindParam(":desc", $description, PDO::PARAM_STR);
    $sql->bindParam(":supp", $supp, PDO::PARAM_INT);
    $sql->bindParam(":pm3", $pm3, PDO::PARAM_INT);
    if($sql->execute()){
        return true;
    }
    else{
        return false;
    }
}
