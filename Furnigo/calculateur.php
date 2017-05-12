<?php
session_start();
require_once 'command.php';
$optionForfait = GetForfait();
$options = GetOptions();
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
                <?php foreach ($optionForfait as $forfait) : ?>
                    <option value="<?= $forfait['idForfait'] ?>"> <?= $forfait['Forfait'] ?></option><br>
                <?php endforeach; ?>

            </select>
            <br>
            <table border="1" width="100%">
                <col style="width:8%">
                <col style="width: 72%">
                <col style="width: 5%">
                <col style="width: 5%">
                <col style="width: 10%">
                <tr>
                    <th>Quantité</th>
                    <th>Description</th>
                    <th>Supplément de base</th>
                    <th>Prix au M3</th>
                    <th>Total</th>
                </tr>
                <tr>
                    <td colspan="5" style="text-align: center">Au départ: Préparation et conditionnement</td>
                </tr>
                <?php
                $i = 0;
                foreach ($options as $opt) :
                    $i++;
                    ?>
                    <tr>
                        <td style="text-align: center"><input type="number" value="0" style="width: 50px" id="qt<?php echo $opt['idOption'] ?>" name="qtOption<?php echo $opt['idOption'] ?>" onchange="ShowResult(<?php echo $opt['idOption'] ?>)"></td>
                        <td><?= $opt['DescriptionDetaillee'] ?></td>
                        <td style="text-align: center" id="supplement<?php echo $opt['idOption'] ?>"><?= $opt['PrixSupplementDeBase'] ?></td>
                        <td style="text-align: center" id="pm3<?php echo $opt['idOption'] ?>"><?= $opt['PrixAuM3'] ?></td>
                        <td style="text-align: center" id="total<?php echo $opt['idOption'] ?>">0</td>
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
                    ?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="2"></td>
                    <td><input type="submit" name="sendOption"></td>
                    <td>Total</td>
                    <td id="totaldevis"></td>
                </tr>
            </table>

            <input type="hidden" id="nbOption" value="<?= $i ?>">
        </div>
        <input type="hidden" value="" id="optionTotal" name="optionTotal">
    </center>
    <script type="text/javascript">
                function ShowResult(id) {
                if (document.getElementById("qt" + id).value == ""){
                document.getElementById("qt" + id).value = "0";
                }
                let quantity = parseInt(document.getElementById("qt" + id).value);
                        if (quantity != 0){
                let unityPrice = parseInt(document.getElementById("pm3" + $id).textContent);
                        let supplement = parseInt(document.getElementById("supplement" + id).textContent);
                        //console.log(quantity + " " + unityPrice + " " + supplement)
                        document.getElementById("total" + id).textContent = QtTotal(quantity, unityPrice, supplement).toString();
                        console.log(CalculTotal().toString());
                        document.getElementById("totaldevis").textContent = CalculTotal().toString();
                }
                else{
                document.getElementById("total" + $id).textContent = "0";
                }
                }
        function QtTotal(qt, unit, supp) {
        return qt * unit + supp;
        }

        function CalculTotal(){
        var total = 0;
                var nbOpt = parseInt(document.getElementById("nbOption").textContent);
                for (i = 0; i < nbOpt; i++)
        {
        total += parseInt(document.getElementById("total" + i.toString()).textContent);
        }
        return total;
        }
    </script>
</body>
</html>
