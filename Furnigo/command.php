<?php

/*
  Projet: Site de déménagement
  Auteur:     Maurice Dinh
  Classe:     I.IN-P4B
  Titre:      command.php
  Description: Page qui gère la modifications de données du site
  Date:       24/05/2017
 */

require_once 'dbconnect.php';

function GetForfait() {
    $db = connectdb();
    $sql = $db->prepare("SELECT * FROM t_forfait");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

function GetOption($idDevis) {
    $db = connectdb();
    $sql = $db->prepare("SELECT * FROM r_ajouter WHERE idDevis = :idDevis");
    $sql->bindParam(":idDevis", $idDevis, PDO::PARAM_INT);
    if ($sql->execute()) {
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}

function GetDetail($idDevis) {
    $db = connectdb();
    $sql = $db->prepare("SELECT * FROM t_detail WHERE idDevis = :idDevis");
    $sql->bindParam(":idDevis", $idDevis, PDO::PARAM_INT);
    if ($sql->execute()) {
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}
