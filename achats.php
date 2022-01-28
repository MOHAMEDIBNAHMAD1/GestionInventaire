<?php
session_start();
if (!isset($_SESSION["admin"]) || empty($_SESSION["admin"]) || strlen(trim($_SESSION["admin"])) === 0) header("Location: login.php?error=cin");

include './credentials.php';
$cin = $_SESSION["admin"];

$res = mysqli_query($conn, "SELECT nom FROM admin WHERE cin like '$cin';");
$emp = mysqli_fetch_assoc($res);

$achats = mysqli_query($conn, "SELECT `produit`.`intitule`, `magasinier`.`nom`, achat.`qtt`, `dateAchat` FROM `achat`, `produit`, `magasinier` WHERE `produit`.`id` = idPr AND magasinier.id = `idmag`");
$rescheck = mysqli_num_rows($achats);

// $magasin=mysqli_query($conn,"SELECT `id`, `nom` FROM `magasinier`");

?>
<!-- 
// $results = mysqli_query($conn, "SELECT * FROM categorie;");
// $check = mysqli_num_rows($res);
?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php include "./meta.php"; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./styles/styleadmin.css" />
    <title>Achat</title>
</head>

<body>
    <div class="container">
        <?php include './asideadmin.php'; ?>
        <main>
            <h1 style="text-align: center;">Les Achats</h1>

            <section class="products">
                <table class="products-list" cellspacing="0">
                    <tr>
                        <td>Produit</td>
                        <td>Quantite</td>
                        <td>Magasinier</td>
                        <td>date</td>
                    </tr>
                    <?php
                    if ($rescheck > 0) :
                        while ($row = mysqli_fetch_assoc($achats)) : ?>
                            <tr>
                                <td><?= $row["intitule"]; ?></td>
                                <td><?= $row["qtt"]; ?></td>
                                <td><?= $row["nom"]; ?></td>
                                <td><?= $row["dateAchat"]; ?></td>
                            </tr>
                    <?php endwhile;
                    endif; ?>
                </table>
            </section>
            <footer>Copyright 2022 all rights reserved</footer>
        </main>
    </div>
</body>

</html>