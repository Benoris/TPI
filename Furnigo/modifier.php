<?php
if (!isset($_SESSION['name'])) {
    session_start();
    if (isset($_SESSION['mode'])) {
        $mode = $_SESSION['mode'];
    }
}
require_once 'command.php';
$optionForfait = GetForfait();
$options = GetOptions();
if (isset($_GET['id'])) {
    $idDevi = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $deviClient = GetOption($idDevi);
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
                <?php if (isset($_SESSION['name']) && $mode == 1) { ?>
                    <li><a href="admin.php">Administration</a></li>
                <?php } ?>
                <?php if (isset($_SESSION['name'])) { ?>
                    <li><a href="logout.php">Déconnexion</a></li>
                <?php } ?>
            </ul>
        </nav>
        <div id="content">
            <label for="selforfait">Sélectionnez votre forfait: </label>
            <select name="selforfait" id="forfait">
                <?php foreach ($optionForfait as $forfait) : ?>
                    <option value="<?= $forfait['idForfait'] ?>"> <?= $forfait['Forfait'] ?></option><br>
                <?php endforeach; ?>

            </select>
            <br>
            <form action="update.php" method="post">
                <table border="1" width="100%">
                    <col style="width:8%">
                    <col style="width: 72%">
                    <col style="width: 5%">
                    <col style="width: 5%">
                    <col style="width: 10%">
                    <tr>
                        <th>M<sup>3</sup></th>
                        <th>Description</th>
                        <th>Supplément de base</th>
                        <th>Prix au M<sup>3</sup></th>
                        <th>Total</th>
                    </tr>
                    <tr>
                        <td colspan="5" style="text-align: center">Au départ: Préparation et conditionnement</td>
                    </tr>
                    <?php
                    $i = 0;
                    foreach ($options as $opt) :
                        ?>
                        <tr>
                            <td style="text-align: center"><input type="number" value="<?php echo $deviClient[$i]['M3'] ?>" min="0" style="width: 50px" id="qt<?php echo $opt['idOption'] ?>" name="qtOption<?php echo $opt['idOption'] ?>" onchange="ShowResult(<?php echo $opt['idOption'] ?>)"></td>
                            <td><?= $opt['DescriptionDetaillee'] ?></td>
                            <td style="text-align: center" id="supplement<?php echo $opt['idOption'] ?>"><?= $opt['PrixSupplementDeBase'] ?></td>
                            <td style="text-align: center" id="pm3<?php echo $opt['idOption'] ?>"><?= $opt['PrixAuM3'] ?></td>
                            <td style="text-align: center" id="total<?php echo $opt['idOption'] ?>" value="">0</td>
                        </tr>
                        <?php
                        if ($i == 11) {
                            echo '<tr>
                    <td colspan="5" style="text-align: center">Travaux spéciaux</td>
                </tr>';
                        } elseif ($i == 13) {
                            echo '<tr>
                    <td colspan="5" style="text-align: center">Manutention et transport de votre mobilier</td>
                </tr>';
                        } elseif ($i == 16) {
                            echo '<tr>
                    <td colspan="5" style="text-align: center">Vos pièces annexes</td>
                </tr>';
                        } elseif ($i == 18) {
                            echo '<tr>
                    <td colspan="5" style="text-align: center">A l’arrivée : détail des prestations</td>
                </tr>';
                        } elseif ($i == 26) {
                            echo '<tr>
                    <td colspan="5" style="text-align: center">Travaux en dérogation des conditions générales de vente</td>
                </tr>';
                        }
                        $i++;
                        ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="2"></td>
                        <td><input type="submit" name="sendOption"></td>
                        <td>Total</td>
                        <td id="totaldevis"></td>
                    </tr>
                </table>
                <input type="hidden" name="nbOption" id="nbOption" value="<?= $i ?>">
                <input type="hidden" value="0" id="optionTotal" name="optionTotal">
                <input type="hidden" value="<?php echo $_GET['id'] ?>" name="idDevis">

            </form>
        </div>
    </center>
    <script type="text/javascript">
            var nbOpt = parseInt(document.getElementById("nbOption").value);
            //S'il y a un bug, set le i de la boucle à 1
            for (i = 1; i < nbOpt; i++) {
                var qt = parseInt(document.getElementById("qt" + i).value);
                if (qt != 0) {
                    var supp = parseInt(document.getElementById("supplement" + i).textContent);
                    var pq = parseInt(document.getElementById("pm3" + i).textContent);
                    var tot = qt * pq + supp;
                    document.getElementById("total" + i).innerHTML = tot.toString();
                }
                else {
                    document.getElementById("total" + i).textContent = "0";
                }
            }

            document.getElementById("optionTotal").value = CalculTotal().toString();
            document.getElementById("totaldevis").textContent = CalculTotal().toString();
            document.getElementById("optionTotal").value = CalculTotal().toString();
            console.log(CalculTotal().toString());





            function CalculTotal() {
                var total = 0;
                for (var i = 1; i < nbOpt + 1; i++)
                {
                    total += parseInt(document.getElementById("total" + i.toString()).textContent);
                }
                var forfait = document.getElementById("forfait");
                var selectedforfait = parseInt(forfait.options[forfait.selectedIndex].value);
                if (selectedforfait === 1) {
                    total += 1500;
                }
                else if (selectedforfait === 2) {
                    total += 1000;
                }
                else if (selectedforfait === 3) {
                    total += 750;
                }
                else if (selectedforfait === 4) {
                    total += 500;
                }
                return total;
            }
        function ShowResult(id) {
            if (document.getElementById("qt" + id).value == "") {
                document.getElementById("qt" + id).value = "0";
                document.getElementById("total" + id).textContent = "0";
            }
            else if (document.getElementById("qt" + id).value == "0") {
                document.getElementById("total" + id).textContent = "0";
                document.getElementById("totaldevis").innerHTML = CalculTotal().toString();
            }
            else {
                var quantity = parseInt(document.getElementById("qt" + id).value);
                if (quantity != 0) {
                    var unityPrice = parseInt(document.getElementById("pm3" + id).textContent);
                    var supplement = parseInt(document.getElementById("supplement" + id).textContent);
                    //console.log(quantity + " " + unityPrice + " " + supplement)

                    document.getElementById("total" + id).textContent = QtTotal(quantity, unityPrice, supplement).toString();
                    console.log(CalculTotal().toString());
                    document.getElementById("totaldevis").innerHTML = CalculTotal().toString();
                    document.getElementById("optionTotal").value = CalculTotal().toString();
                }
            }
        }
        function QtTotal(qt, unit, supp) {
            if (qt === 0) {
                return 0;
            }
            else {
                return qt * unit + supp;
            }
        }
    </script>
</body>
</html>
