<?php

/*
  Auteur:     Maurice Dinh
  Classe:     I.IN-P4B
  Titre:      users.php
  Description:
 * Bibliothèque de fonction des utilisateurs du site web Furnigo.
 * Ce fichier gère toutes les requêtes concernant les utilisateurs, la création, la connexion, la vérification et suppression
  Date:       23/05/2017
 */

require_once 'dbconnect.php';
require_once 'quotation.php';

function ifAdmin($mode) {
    if ($mode == 1) {
        
    } else {
        header("Location: connexion.php?msg=5");
        die;
    }
}

/**
 * Vérifie la validité des informations d'un formulaire pour connexion
 * @param type $Login : Pseudo de l'utilisateur à loguer
 * @param type $pwd : Mot de passe de l'utilisateur à loguer
 * @return type : Si la connexion réussie, retourne les information de l'utilisateur.
 */
function CheckUserId($Login, $pwd) {
    $db = connectdb();
    $sql = $db->prepare("SELECT idClient,Login,UserMode FROM t_clients WHERE Login = :pseudo AND Password = :pwd");
    $sql->bindParam(':pseudo', $Login, PDO::PARAM_STR);
    $sql->bindParam(':pwd', $pwd, PDO::PARAM_STR);
    if ($sql->execute()) {
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $result = null;
    }
    return $result;
}

/**
 * Fonction d'ajout d'un utilisateur
 * @param type $pseudo : Pseudo de l'utilisateur à créer
 * @param type $mail : Adresse email de l'utilisateur à créer
 * @param type $pwd : Mot de passe de l'utilisaateur à créer
 * @return boolean : Retourne si la requête s'est exécutée avec succès
 */
function AddUser($pseudo, $mail, $pwd) {
    $db = connectdb();
    $sql = $db->prepare("INSERT INTO `t_clients`(`Login`, `Email`, `Password`) VALUES (:pseudo,:mail,:pwd)");
    $sql->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $sql->bindParam(':mail', $mail, PDO::PARAM_STR);
    $sql->bindParam(':pwd', $pwd, PDO::PARAM_STR);
    if ($sql->execute()) {
        return true;
    } else {
        return false;
    }
}

/**
 * Fonction de récupèration des utilisateur non admin
 * @return type retourne la liste des utilisateurs
 */
function GetUsers() {
    $db = connectdb();
    $sql = $db->prepare("SELECT idClient,Login,Email FROM t_clients WHERE UserMode != 1");
    if ($sql->execute()) {
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return null;
    }
}

/**
 * Fonction de suppression d'un utilisateur
 * @param type $idUser : L'id de l'utilisateur à supprimmer
 * @return boolean : Retourn le résultat de la requête
 */
function DeleteUser($idUser) {
    $devis = GetQuotation($idUser);
    $db = connectdb();
    foreach ($devis as $devi) {
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
    $sql->bindParam(":idUser", $idUser, PDO::PARAM_STR);
    if ($sql->execute()) {
        return true;
    } else {
        return false;
    }
}
