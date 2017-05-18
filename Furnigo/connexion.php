<?php
if (!isset($_SESSION['name'])) {
    session_start();
    if (isset($_SESSION['mode'])) {
        $mode = $_SESSION['mode'];
    }
}
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 1) {
        $msg = "Veuillez vous connecter pour accéder à cette page!";
    } else if ($_GET['msg'] == 2) {
        $msg = "Vous n'êtes pas connecté!";
    } else if ($_GET['msg'] == 3) {
        $msg = "Pseudo ou mot de passe erroné";
    } else if ($_GET['msg'] == 4) {
        $msg = "Vous devez vous connecter pour enregister un devis!";
    } else if ($_GET['msg'] == 5) {
        $msg = "Seul l'admin peut accéder à cette page!";
    } else if ($_GET['msg'] == 9) {
        $msg = "Impossible de créer le compte!";
    }
} else {
    $msg = "";
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
<?php if (isset($_SESSION['name']) && $mode == 1) { ?>
                    <li><a href="admin.php">Administration</a></li>
<?php } ?>
<?php if (isset($_SESSION['name'])) { ?>
                    <li><a href="logout.php">Déconnexion</a></li>
<?php } ?>
            </ul>
        </nav>
        <div id="content">
            <fieldset>
                <legend>Connexion</legend>
                <form action="login.php" method="post">
                    <table>
                        <tr>
                            <td><label for="pseudo">Pseudo:</label></td>
                            <td><input type="text" name="pseudo" required><br></td>
                        </tr>
                        <tr>
                            <td><label for="pwd">Mot de passe:</label></td>
                            <td><input type="password" name="pwd"><br></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?php echo $msg . '<br>' ?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" name="send"></td>
                        </tr>
                    </table>
                </form>
            </fieldset>
        </div>
    </center>
</body>
</html>
