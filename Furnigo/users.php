<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'dbconnect.php';

function CheckUserId($Login,$pwd){
    $db = connectdb();
    $sql = $db->prepare("SELECT Login FROM t_clients WHERE Login = :pseudo AND Password = :pwd");
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