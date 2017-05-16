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