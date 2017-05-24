<?php
/*
Projet: Site de déménagement
Auteur:     Maurice Dinh
Classe:     I.IN-P4B
Titre:      devis.php
Description: Page d'affichage des devis de l'utilisateur connecté
 * Uniquement disponible lorsque l'on est connecté
Date:       24/05/2017
 */

require_once 'quotation.php';
if (!isset($_SESSION['name'])) {
    session_start();
    $mode = $_SESSION['mode'];
}
if (!isset($_SESSION['name'])) {
    header('Location:connexion.php?msg=1');
    exit();
}
$devis = GetQuotation($_SESSION['idUser']);

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id',FILTER_VALIDATE_INT);
    echo $id;
    if ($id != null) {
        $result = DeleteQuotation($id);
        if($result == false){
            $msg = "Impossible de supprimer le devis!";
        }
        else{
            $msg = "Suppression réussie!";
        }
            header("Location:devis.php");
            exit;
    }
    
}
if(isset($_GET['msg'])){
    $code = $_GET['msg'];
    if($code = 17){
        $msg = "Modification réussie!";
    }
    elseif($code = 99){
        $msg = "Erreure lors de la modification!";
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
                <li><a href="inscription.php">S'inscrire</a></li>
                <li><a href="devis.php" class="active">Mes devis</a></li>
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
            <?php echo "<h1>Bienvenue sur vos devis " . $_SESSION['name'] . '</h1>'; ?>
            <?php if(isset($msg)){
                echo $msg;
            }
?>
            <table border="1" width="100%">
                <th>N°</th>
                <th>Date du devis</th>
                <th>M<sup>3</sup> Total</th>
                <th>Coût total</th>
                <th colspan="2">Action</th>
                <?php
                $persoCounter = 1;
                foreach ($devis as $devi):
                    ?>
                    <tr>
                        <td style="text-align: center"><?php echo $persoCounter ?></td>
                        <td style="text-align: center"><?php echo $devi['DateDevis'] ?></td>
                        <td style="text-align: center"><?php echo $devi['TotalM3'] ?></td>
                        <td style="text-align: center"><?php echo $devi['Montant'] ?></td>
                        <td style="text-align: center"><a href="devis.php?id=<?php echo $devi['idDevis'] ?>">Supprimer</a></td>
                        <td style="text-align: center"><a href="modifier.php?id=<?php echo $devi['idDevis'] ?>">Modifier</a></td>
                    </tr>
                    <?php $persoCounter++;
                endforeach;
                ?>
            </table>
        </div>
        <?php
        // put your code here
        ?>
    </center>
</body>
</html>
