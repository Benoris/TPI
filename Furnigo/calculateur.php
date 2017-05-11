<?php
session_start();
require_once 'command.php';
$optionForfait = GetForfait();
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
        <title>Furnigo</title>
    </head>
    <body>
    <center>
        <div id="title"><h1>Furnigo</h1></div>

        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="inscription.php">S'inscrire</a></li>
                <li><a href="devis.php">Mes devis</a></li>
                <li><a href="calculateur.php" class="active">Calculateur de devis</a></li>
                <?php if (isset($_SESSION['name'])) { ?>
                    <li><a href="logout.php">Déconnexion</a></li>
                <?php } ?>
            </ul>
        </nav>
        <div id="content">
            <label for="selforfait">Sélectionnez votre forfait: </label>
            <select name="selforfait">
                <?php foreach($optionForfait as $forfait) : ?>
                <option value="<?= $forfait['idForfait'] ?>"> <?= $forfait['Forfait'] ?></option><br>
            <?php endforeach; ?>
                
            </select>
            <br>
                <?php foreach($optionForfait as $forfait) : ?>
                <input type="number" name="<?= $forfait['idForfait'] ?>"><br>
            <?php endforeach; ?>
        </div>
    </center>
</body>
</html>
