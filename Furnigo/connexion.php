<?php 
session_start();
require_once 'message.php';
if(isset($_GET['msg'])){
    if($_GET['msg']==1){
        $msg = "Veuillez vous connecter pour accéder à cette page!";
    }
    else if($_GET['msg']==2){
        $msg = "Vous n'êtes pas connecté!";
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
        <title>Furnigo</title>
        <link rel="icon" type="image/png" href="img/favicon.ico">
    </head>
    <body>
    <center>
        <div id="title"><h1>Furnigo</h1></div>

        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="connexion.php" class="active">Connexion</a></li>
                <li><a href="inscription.php">S'inscrire</a></li>
                <li><a href="devis.php">Mes devis</a></li>
                <li><a href="calculateur.php">Calculateur de devis</a></li>
                <?php if(isset($_SESSION['name'])){?>
                <li><a href="logout.php">Déconnexion</a></li>
                <?php } ?>
            </ul>
        </nav>
        <div id="content">
            <fieldset>
                <legend>Connexion</legend>
                <form action="login.php" method="post">
                    <label for="pseudo">Pseudo:</label>
                    <input type="text" name="pseudo" required><br>
                    <label for="pwd">Mot de passe:</label>
                    <input type="password" name="pwd"><br>
                    <?php echo $msg.'<br>'?>
                    <input type="submit" name="send">
                </form>
            </fieldset>
        </div>
        <?php
        // put your code here
        ?>
    </center>
</body>
</html>
