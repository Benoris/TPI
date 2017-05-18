<?php
require_once 'users.php';

session_start();
ifAdmin($_SESSION['mode']);
if(isset($_SESSION['mode'])){
    $mode = $_SESSION['mode'];
    if(isset($_GET['msg'])){
        if($_GET['msg'] == 1){
            $msg = "Suppression réussie!";
        }
        elseif($_GET['msg'] == 2){
            $msg = "Erreure lors de la suppression!";
        }
    }
    $users = GetUsers();
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
                <th>idClient</th>
                <th>Login</th>
                <th>E-mail</th>
                <th>Action</th>
            <?php foreach($users as $user): ?>
                <tr>
                    <td style="text-align: center"><?php echo $user['idClient'] ?></td>
                    <td style="text-align: center"><?php echo $user['Login'] ?></td>
                    <td style="text-align: center"><?php echo $user['Email'] ?></td>
                    <td style="text-align: center"><a href="delete.php?id=<?php echo $user['idClient'] ?>">Supprimer</a></td>
                </tr>
            <?php endforeach; ?>
                </table>
        </div>
        <?php
        // put your code here
        ?>
    </center>
</body>
</html>
