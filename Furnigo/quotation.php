<?php

/*
  Auteur:     Maurice Dinh
  Classe:     I.IN-P4B
  Titre:      quotation.php
  Description:
 * Bibliothèque de fonction du site web Furnigo.
 * Ce fichier gère toutes les requêtes concernant les devis, donc les détais et les options inclus
  Date:       23/05/2017
 */

require_once 'dbconnect.php';

/**
 * Cette fonction créer une requête
 * @param type $pricetotal : La valeure total du devis
 * @param type $m3total : Le volume total du devis
 * @param type $idClient : L'id du client qui est lié au devis
 * @return boolean : Réponse de la fonction false si la requête ne s'exécute pas, sinon return l'id du devis qui vient d'être créer.
 */
function CreateQuotation($pricetotal, $m3total, $idClient) {
    $db = connectdb();
    $sql = $db->prepare("INSERT INTO t_devis (Montant,DateDevis,TotalM3,idClient) VALUES (:pricetotal,NOW(),:m3total,:idClient)");
    $sql->bindParam(':pricetotal', $pricetotal);
    $sql->bindParam(':m3total', $m3total, PDO::PARAM_INT);
    $sql->bindParam(':idClient', $idClient, PDO::PARAM_INT);
    if ($sql->execute()) {
        return $db->lastInsertId();
    } else {
        return false;
    }
}

/**
 * Cette fonction qui exécute une requête passé en paramètre
 * @param type $requete : String de la requête à exécuter
 * @return boolean : Réponse si la requête à pu être exécuter ou pas
 */
function SendQuotation($requete) {
    $db = connectdb();
    $sql = $db->prepare($requete);
    if ($sql->execute()) {
        return true;
    } else {
        return false;
    }
}

/**
 * Cette requête récupère les devis lié à un utilisateur.
 * @param type $idUser : L'id de l'utilisateur à qui on veut récupérer ses devis
 * @return boolean : Si la requête réussie, elle retourne les données sinon, la fonction return false
 */
function GetQuotation($idUser) {
    $db = connectdb();
    $sql = $db->prepare("SELECT * FROM t_devis WHERE idClient = :idUser");
    $sql->bindParam(':idUser', $idUser, PDO::PARAM_INT);
    if ($sql->execute()) {
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}

/**
 * Vérifie si un certain devis appartient à un certain utilisateur. Cette fonction est utilisé pour vérifier si le devis à supprimer appartient à l'utilisateur connecté
 * @param type $idUser : L'id de l'utilisateur à tester
 * @param type $idQuotation : L'id du devis à vérifier
 * @return boolean : Return la réponse de la vérification
 */
function CheckQuotation($idUser, $idQuotation) {
    $db = connectdb();
    $sql = $db->prepare("SELECT * FROM t_devis WHERE idClient = :idUser AND idDevis = :idQuotation");
    $sql->bindParam(":idUser", $idUser, PDO::PARAM_INT);
    $sql->bindParam(":idQuotation", $idQuotation, PDO::PARAM_INT);
    $sql->execute();
    $content = $sql->fetchAll(PDO::FETCH_ASSOC);
    if ($content == NULL) {
        return false;
    } else {
        return true;
    }
}

/**
 * Cette fonction supprime un devis, ses détails et les options qui est déterminé grâce à l'id que l'on passe en paramètre
 * @param type $idQuotation : L'id du devis à supprimer
 * @return boolean : return si toutes les requêtes ont été réussite.
 */
function DeleteQuotation($idQuotation) {
    $db = connectdb();
    $sql = $db->prepare("DELETE FROM r_ajouter WHERE idDevis = :idQuotation");
    $sql->bindParam(":idQuotation", $idQuotation, PDO::PARAM_INT);
    if ($sql->execute()) {
        $sql = $db->prepare("DELETE FROM t_detail WHERE idDevis = :idQuotation");
        $sql->bindParam(":idQuotation", $idQuotation, PDO::PARAM_INT);
        if ($sql->execute()) {
            $sql = $db->prepare("DELETE FROM t_devis WHERE idDevis = :idQuotation");
            $sql->bindParam(":idQuotation", $idQuotation, PDO::PARAM_INT);
            if ($sql->execute()) {
                return true;
            }
        }
    } else {
        return false;
    }
}

/**
 * Cette fonction modifie les données des options d'un devis que l'on passe en paramètre
 * @param type $idQuot : id du devis à modifier
 * @param type $tot : Nouvelle somme totale du devis
 * @return boolean : return si la requête s'est exécuté avec succès
 */
function UpdateQuotation($idQuot, $tot) {
    $db = connectdb();
    $sql = $db->prepare("UPDATE `t_devis` SET DateDevis = NOW(), `TotalM3`= (SELECT SUM(M3) FROM r_ajouter WHERE r_ajouter.idDevis = :idQuot), Montant=:tot WHERE idDevis = :idQuot");
    $sql->bindParam(":idQuot", $idQuot, PDO::PARAM_INT);
    $sql->bindParam(":tot", $tot, PDO::PARAM_INT);
    if ($sql->execute()) {
        return true;
    } else {
        return false;
    }
}

/**
 * Récupère toutes les options disponibles et les retournes
 * @return type FETCH_ASSOC t_options
 */
function GetOptions() {
    $db = connectdb();
    $sql = $db->prepare("SELECT * FROM t_options");
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Cette fonction sert à modifier une option dans la table t_option
 * @param type $idOption : id de l'option à modifier
 * @param type $desc : Nouvelle description à remplacer
 * @param type $prix : Nouveau prix
 * @param type $pm3 : Nouveau prix par M3
 * @return boolean : Réponse de la base de donnée
 */
function UpdateOption($idOption, $desc, $prix, $pm3) {
    $db = connectdb();
    $sql = $db->prepare("UPDATE t_options SET DescriptionDetaillee = :desc, PrixSupplementDeBase = :prix, PrixAuM3 = :pm3 WHERE idOption = :idOption");
    $sql->bindParam(":desc", $desc, PDO::PARAM_STR);
    $sql->bindParam(":prix", $prix, PDO::PARAM_INT);
    $sql->bindParam(":pm3", $pm3, PDO::PARAM_INT);
    $sql->bindParam(":idOption", $idOption, PDO::PARAM_INT);
    if ($sql->execute()) {
        return true;
    } else {
        return false;
    }
}

/**
 * Récupère les informations d'une option selon son id
 * @param type $idOption : id de l'option à récupérer
 * @return boolean : retourne les donnée de l'option ou false
 */
function GetOptionById($idOption) {
    $db = connectdb();
    $sql = $db->prepare("SELECT * FROM t_options WHERE idOption = :idOption");
    $sql->bindParam(":idOption", $idOption, PDO::PARAM_INT);
    if ($sql->execute()) {
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}

/**
 * Supprime une option à l'aide de son id
 * @param type $idOption : L'id de l'option à supprimer
 * @return boolean : Réponse de la base de donnée
 */
function DeleteOption($idOption) {
    $db = connectdb();
    $sql = $db->prepare("DELETE FROM t_options WHERE idOption = :idoption");
    $sql->bindParam(":idoption", $idOption, PDO::PARAM_INT);
    if ($sql->execute()) {
        return true;
    } else {
        return false;
    }
}

/**
 * Créer une nouvelle option
 * @param type $description : Description de la nouvelle option
 * @param type $supp : Prix supplémentaire de la nouvelle option
 * @param type $pm3 : Prix par M carré de la nouvelle option
 * @return boolean : retourne si la requête s'est bien exécuté
 */
function CreateOption($description, $supp, $pm3) {
    $db = connectdb();
    $sql = $db->prepare("INSERT INTO t_options (DescriptionDetaillee,PrixSupplementDeBase,PrixAuM3) VALUE(:desc,:supp,:pm3)");
    $sql->bindParam(":desc", $description, PDO::PARAM_STR);
    $sql->bindParam(":supp", $supp, PDO::PARAM_INT);
    $sql->bindParam(":pm3", $pm3, PDO::PARAM_INT);
    if ($sql->execute()) {
        return true;
    } else {
        return false;
    }
}

/**
 * Ajoute les détails du nouveau devis à la table t_detail
 * @param type $lieu : Lieu à déménager
 * @param type $volume : Volume total du meubilier à déménager
 * @param type $surface : Surface total du lieu à déménager
 * @param type $poids : Poids total des meubiliers
 * @param type $distance : Distance jusqu'à la destination en Km
 * @param type $idDevis : id du devis lié au détail à créer
 * @return boolean return si la requête a pu être exécuté
 */
function AddDetails($lieu, $volume, $surface, $poids, $distance, $idDevis) {
    $db = connectdb();
    $sql = $db->prepare("INSERT INTO t_detail (DescriptionObjetOuLieu,VolumeApproxM3,SurfaceApproxM2,PoidsKg,Distance,idDevis) VALUE(:lieu,:volume,:surface,:poids,:distance,:idDevis)");
    $sql->bindParam(":lieu", $lieu, PDO::PARAM_STR);
    $sql->bindParam(":volume", $volume, PDO::PARAM_INT);
    $sql->bindParam(":surface", $surface, PDO::PARAM_INT);
    $sql->bindParam(":poids", $poids, PDO::PARAM_INT);
    $sql->bindParam(":distance", $distance, PDO::PARAM_INT);
    $sql->bindParam(":idDevis", $idDevis, PDO::PARAM_INT);
    if ($sql->execute()) {
        return true;
    } else {
        return false;
    }
}

/**
 * Cette fonction sert à modifier des détails d'un devis
 * @param type $lieu : Nouveau lieu
 * @param type $totalm3 : Nouvelle valeur du volume total du devis
 * @param type $surface : Nouvelle valeur de la surface total du devis
 * @param type $poids : Nouvelle valeur du poids total du devis
 * @param type $distance : Nouvelle valeur pour la distance du déménagement
 * @param type $idDevis : id du devis à modifier
 * @return boolean : Retourne la réponse de la base de donnée si la requête s'est exécuté avec succès
 */
function UpdateDetails($lieu, $totalm3, $surface, $poids, $distance, $idDevis) {
    $db = connectdb();
    $sql = $db->prepare("UPDATE t_detail SET DescriptionObjetOuLieu = :desc, VolumeApproxM3 = :totalm3, SurfaceApproxM2 = :surface, PoidsKg = :poids, Distance = :distance WHERE idDevis = :idDevis");
    $sql->bindParam(":desc", $lieu, PDO::PARAM_STR);
    $sql->bindParam(":totalm3", $totalm3, PDO::PARAM_INT);
    $sql->bindParam(":surface", $surface, PDO::PARAM_INT);
    $sql->bindParam(":poids", $poids, PDO::PARAM_INT);
    $sql->bindParam(":distance", $distance, PDO::PARAM_INT);
    $sql->bindParam(":idDevis", $idDevis, PDO::PARAM_INT);
    if ($sql->execute()) {
        return true;
    } else {
        return false;
    }
}
