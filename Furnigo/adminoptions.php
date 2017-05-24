<?php
/*
Projet: Site de déménagement
Auteur:     Maurice Dinh
Classe:     I.IN-P4B
Titre:      adminoptions.php
Description: Page de gestion d'options accessible seulement en administrateur
Date:       24/05/2017
 */

require_once 'quotation.php';
require_once 'users.php';

session_start();
ifAdmin($_SESSION['mode']);
if(isset($_SESSION['mode'])){
    $mode = $_SESSION['mode'];
    if(isset($_GET['msg'])){
        if($_GET['msg'] == 1){
            $msg = "Action réussie!";
        }
        elseif($_GET['msg'] == 2){
            $msg = "Erreure lors de l'exécution!";
        }
    }
    $options = GetOptions();
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" type="image/png" href="img/favicon.ico">
        <title>Furnigo</title>
    </head>
    <body>
    <center>
        <div id="title"><h1>Furnigo</h1></div>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <?php if(!isset($_SESSION['name'])): ?>
                <li><a href="connexion.php">Connexion</a></li>
                <?php endif; ?>
                <li><a href="inscription.php">S'inscrire</a></li>
                <li><a href="devis.php">Mes devis</a></li>
                <li><a href="calculateur.php">Calculateur de devis</a></li>
                <?php if(isset($_SESSION['name']) && $mode == 1){ ?>
                <li class="active"><a href="adminuser.php">Administration</a></li>
                <?php } ?>
                <?php if(isset($_SESSION['name'])){?>
                <li><a href="logout.php">Déconnexion</a></li>
                <?php } ?>
            </ul>
        </nav>
        <div id="content">
            <a href="adminuser.php">Utilisateurs </a>
            <a href="adminoptions.php">Options</a>
            <?php if(isset($msg)){
                echo $msg;
            } ?>
            <table border="1" width="100%">
                <th>idOption</th>
                <th>DescriptionDetaillee</th>
                <th>Prix supplément de base</th>
                <th>Prix au M<sup>3</sup></th>
                <th colspan="2">Actions</th>
            <?php foreach($options as $option): ?>
                <tr>
                    <td style="text-align: center"><?php echo $option['idOption'] ?></td>
                    <td><?php echo $option['DescriptionDetaillee'] ?></td>
                    <td style="text-align: center"><?php echo $option['PrixSupplementDeBase'] ?></td>
                    <td style="text-align: center"><?php echo $option['PrixAuM3'] ?></td>
                    <td><a href="modifieroption.php?id=<?php echo $option['idOption'] ?>">Modifier</a></td>
                    <td><a href="deleteoption.php?id=<?php echo $option['idOption'] ?>">Supprimer</a></td>
                </tr>
                <?php endforeach; ?>
                <form action="addoption.php" method="post">
                    <tr>
                        <td></td>
                        <td><textarea name="description" cols="49" required=""></textarea></td>
                        <td><input type="number" name="prix" placeholder="Prix en supplément" required=""></td>
                        <td><input type="number" name="pm3" placeholder="Prix au Mètre carré" required=""></td>
                        <td colspan="2"><input type="submit" name="add" value="Créer" style="width: 125px"></td>
                    </tr>
                </form>
                </table>
        </div>
    </center>
</body>
</html>
