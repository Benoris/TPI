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