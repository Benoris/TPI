<?php 
/*
Projet: Site de déménagement
Auteur:     Maurice Dinh
Classe:     I.IN-P4B
Titre:      inscription.php
Description: Page d'inscription au site Furnigo
Date:       24/05/2017
 */
if(!isset($_SESSION['name'])){
    session_start();
    if(isset($_SESSION['mode'])){
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
                <li><a href="index.php">Accueil</a></li>
                <?php if(!isset($_SESSION['name'])): ?>
                <li><a href="connexion.php">Connexion</a></li>
                <?php endif; ?>
                <li><a href="inscription.php" class="active">S'inscrire</a></li>
                <li><a href="devis.php">Mes devis</a></li>
                <li><a href="calculateur.php">Calculateur de devis</a></li>
                <?php if(isset($_SESSION['name']) && $mode == 1){ ?>
                <li><a href="adminuser.php">Administration</a></li>
                <?php } ?>
                <?php if(isset($_SESSION['name'])){?>
                <li><a href="logout.php">Déconnexion</a></li>
                <?php } ?>
            </ul>
        </nav>
        <div id="content">
            <fieldset>
                <legend>Inscription</legend>
                <form action="adduser.php" method="post">
                    <label for="mail">E-mail: </label><br/>
                    <input type="email" name="mail" required=""><br/>
                    <label for="pseudo">Pseudo: </label><br/>
                    <input type="text" name="pseudo" required=""><br/>
                    <label for="pwd">Mot de passe: </label><br/>
                    <input type="password" name="pwd" id="password" required=""><br/>
                    <label for="confirmpwd">Confirmez votre mot de passe:</label><br/>
                    <input type="password" name="confirmpwd" id="confirm_password" required=""><br/>
                    <input type="submit" name="send">
                </form>
            </fieldset>
        </div>
    </center>
    <script type="text/javascript">

        var password = document.getElementById("password")
                , confirm_password = document.getElementById("confirm_password");

        function validatePassword() {
            if (password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;

    </script>
</body>
</html>
