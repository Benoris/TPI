<?php
/*
  Projet: Site de déménagement
  Auteur:     Maurice Dinh
  Classe:     I.IN-P4B
  Titre:      modifieroption.php
  Description: Formulaire de modification d'une option
  Date:       24/05/2017
 */

require_once 'quotation.php';

$option = GetOptionById($_GET['id']);

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
                <li><a href="index.php">Accueil</a></li>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="inscription.php">S'inscrire</a></li>
                <li><a href="devis.php">Mes devis</a></li>
                <li><a href="calculateur.php">Calculateur de devis</a></li>
                <?php if (isset($_SESSION['name']) && $mode == 1) { ?>
                    <li class="active"><a href="adminuser.php">Administration</a></li>
                <?php } ?>
                <?php if (isset($_SESSION['name'])) { ?>
                    <li><a href="logout.php">Déconnexion</a></li>
                <?php } ?>
            </ul>
        </nav>
        <div id="content">
            <table>
                <form action="modOption.php" method="post">
                    <tr>   
                        <td><label for="DescriptionDetaillee">Description detaillé</label></td>
                        <td><textarea rows="10" cols="60" name="Desc" placeholder="Description de l'option"><?php echo $option[0]['DescriptionDetaillee'] ?></textarea></td>
                    </tr>
                    <tr>
                        <td><label for="supp">Prix du supplément de base</label></td>
                        <td><input type="number" name="supp" min="0" value="<?php echo $option[0]['PrixSupplementDeBase'] ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="pm3">Prix au M<sup>3</sup></label></td>
                        <td><input type="number" name="pm3" min="0" value="<?php echo $option[0]['PrixAuM3'] ?>"></td>
                    </tr>
                    <tr>
                        <td><input type="hidden" name="idOption" value="<?php echo $option[0]['idOption'] ?>"></td>
                        <td><input type="submit" name="send"></td>
                    </tr>
                </form>
            </table>
        </div>
    </center>
</body>
</html>
