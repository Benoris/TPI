<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'dbconnect.php';
require_once 'quotation.php';

function ifAdmin($mode){
    if ($mode == 1) {
        
    }
    else{
        header("Location: connexion.php?msg=5");
        die;
    }
}

function CheckUserId($Login,$pwd){
    $db = connectdb();
    $sql = $db->prepare("SELECT idClient,Login,UserMode FROM t_clients WHERE Login = :pseudo AND Password = :pwd");
    $sql->bindParam(':pseudo', $Login, PDO::PARAM_STR);
    $sql->bindParam(':pwd', $pwd, PDO::PARAM_STR);
    if($sql->execute()) {
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $result = null;
    }
    return $result; 
}

function AddUser($pseudo,$mail,$pwd){
    $db = connectdb();
    $sql = $db->prepare("INSERT INTO `t_clients`(`Login`, `Email`, `Password`) VALUES (:pseudo,:mail,:pwd)");
    $sql->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $sql->bindParam(':mail', $mail, PDO::PARAM_STR);
    $sql->bindParam(':pwd', $pwd, PDO::PARAM_STR);
    if($sql->execute()){
        return true;
    }
    else{
        return false;
    }
}

function GetUsers(){
    $db = connectdb();
    $sql = $db->prepare("SELECT idClient,Login,Email FROM t_clients WHERE UserMode != 1");
    if($sql->execute()){
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        return null;
    }
}

function DeleteUser($idUser){
    $devis = GetQuotation($idUser);
    $db = connectdb();
    foreach($devis as $devi){
        $sql = $db->prepare("DELETE FROM r_ajouter WHERE idDevis = :idDevi");
        $sql->bindParam(":idDevi", $devi['idDevis']);
        $sql->execute();
        $sql = $db->prepare("DELETE FROM `t_detail` WHERE `idDevis` = :idDevis");
        $sql->bindParam(":idDevis", $devi['idDevis']);
        $sql->execute();
    }
    
    $sql = $db->prepare("DELETE FROM t_devis WHERE idClient = :idUser");
    $sql->bindParam(":idUser", $idUser, PDO::PARAM_STR);
    $sql->execute();
    
    
    $sql = $db->prepare("DELETE FROM t_clients WHERE idClient = :idUser");
    $sql->bindParam(":idUser", $idUser,PDO::PARAM_STR);
    if($sql->execute()){
        return true;
    }
    else{
        return false;
    }
}