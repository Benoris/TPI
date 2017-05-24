<?php
/*
  Auteur:     Maurice Dinh
  Classe:     I.IN-P4B
  Titre:      index.php
  Description:Fichier index (Accueil) du site web Furnigo
  Date:       10/05/2017
 */
if (!isset($_SESSION['name'])) {
    session_start();
    if (isset($_SESSION['mode'])) {
        $mode = $_SESSION['mode'];
    }
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
                <li><a href="index.php" class="active">Accueil</a></li>
                <?php if (!isset($_SESSION['name'])): ?>
                    <li><a href="connexion.php">Connexion</a></li>
                <?php endif; ?>
                <li><a href="inscription.php">S'inscrire</a></li>
                <li><a href="devis.php">Mes devis</a></li>
                <li><a href="calculateur.php">Calculateur de devis</a></li>
                <?php if (isset($_SESSION['name']) && $mode == 1) { ?>
                    <li><a href="adminuser.php">Administration</a></li>
                <?php } ?>
                <?php if (isset($_SESSION['name'])) { ?>
                    <li><a href="logout.php">Déconnexion</a></li>
                <?php } ?>
            </ul>
        </nav>
        <div id="content">
            <h2>Bienvenu sur furnigo</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin euismod pharetra interdum. Mauris fringilla lorem purus, nec maximus mi dapibus a. Proin pharetra dolor congue risus pulvinar aliquam. Aliquam erat volutpat. Morbi sed faucibus felis, a tempor ligula. Morbi lobortis viverra nisi, semper consectetur urna cursus eu. Cras vitae congue dui. Donec eu arcu eu nulla dictum bibendum at ut augue. Sed posuere eget ipsum non mattis. Etiam sagittis, libero nec volutpat ornare, dui justo venenatis risus, porttitor varius libero diam ut velit. Phasellus lobortis tortor faucibus nulla rutrum, ac varius elit malesuada.</p>
            <p>Donec libero ante, lacinia in mauris sed, bibendum euismod ipsum. Vivamus luctus varius nulla id efficitur. Duis cursus dignissim nulla, id feugiat velit. In eu dapibus felis, sed porttitor odio. Phasellus et nunc ipsum. Integer sit amet pulvinar risus, aliquam ullamcorper ipsum. Ut molestie pellentesque nunc eget congue. Vestibulum egestas vestibulum odio. Suspendisse luctus mattis porta. Phasellus dignissim dignissim hendrerit. Suspendisse velit dolor, tempor aliquam lobortis ac, congue at justo. Curabitur risus odio, posuere vel tortor in, sagittis semper augue.</p>
        </div>
    </center>
</body>
</html>
