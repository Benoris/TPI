<?php
require_once 'quotation.php';
require_once 'message.php';
session_start();
    if(!isset($_SESSION['name'])){
        SetMessage("Veuillez vous connecter pour accéder à cette page!");
        header('Location:connexion.php?msg=1');
        exit();
    }
    $devis = GetQuotation($_SESSION['idUser']);
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
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="inscription.php">S'inscrire</a></li>
                <li><a href="devis.php" class="active">Mes devis</a></li>
                <li><a href="calculateur.php">Calculateur de devis</a></li>
                <?php if(isset($_SESSION['name'])){?>
                <li><a href="logout.php">Déconnexion</a></li>
                <?php } ?>
            </ul>
        </nav>
        <div id="content">
            <?php echo "<h1>Bienvenue sur vos devis ".$_SESSION['name'].'</h1>'; ?>
            <table border="1" width="100%">
                <th>N°</th>
                <th>Date du devis</th>
                <th>M<sup>3</sup> Total</th>
                <th>Coût total</th>
            <?php
            $persoCounter = 1;
            foreach($devis as $devi): ?>
                <tr>
                    <td style="text-align: center"><?php echo $persoCounter ?></td>
                    <td style="text-align: center"><?php echo $devi['DateDevis'] ?></td>
                    <td style="text-align: center"><?php echo $devi['TotalM3'] ?></td>
                    <td style="text-align: center"><?php echo $devi['Montant'] ?></td>
                </tr>
            <?php $persoCounter++;
            endforeach; ?>
                </table>
        </div>
        <?php
        // put your code here
        ?>
    </center>
</body>
</html>
