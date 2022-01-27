<?php
session_start();
if (!isset($_SESSION["admin"]) || empty($_SESSION["admin"]) || strlen(trim($_SESSION["admin"])) === 0) header("Location: login.php?error=cin");

include './credentials.php';
$cin = $_SESSION["admin"];

$res = mysqli_query($conn, "SELECT nom FROM admin WHERE cin like '$cin';");
$emp = mysqli_fetch_assoc($res);
$id = $_GET["id"];
$pr = mysqli_query($conn, "SELECT * FROM magasinier WHERE id = $id;");
$productCheck = mysqli_num_rows($res);
$product = mysqli_fetch_assoc($pr);

// $results = mysqli_query($conn, "SELECT * FROM categorie;");
// $check = mysqli_num_rows($res);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php include "./meta.php"; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./styles/styleadmin.css" />
    <title>Modifier magasinier</title>
</head>

<body>
    <div class="container">
        <?php include './asideadmin.php'; ?>
        <main>
            <h1 style="text-align: center;">Ajouter magasinier</h1>
            <form class="form" action="./operationAdmin.php" method="POST">


                <div class="data-input"> <label>Nom</label><input type="text" name="nommag" id="" value="<?= $product["nom"] ?>"></div>
                <div class="data-input"> <label>Cin</label><input type="text" name="CINm" id="" value="<?= $product["CIN"] ?>"></div>
                <div class="data-input"> <label>Password</label><input type="text" name="pwd" id="" value="<?= $product["PASSWORD"] ?>"></div>


                <div class="data-input btns"> <a class="an" href="./admin.php">Annuler</a><button class="sub" type="submit">Ajouter</button></div>
                <div class="data-input btns"> <input type="text" name="op" id="" value="mod" hidden></div>
                <div class="data-input btns"> <input type="text" name="id" id="" value="<?= $id ?>" hidden></div>
                <!-- <div class="data-input"><a href="./index.php">Annuler</a><input type="submit" value="Modifier"></div> -->

            </form>
            <footer>Copyright 2022 all rights reserved</footer>
        </main>
    </div>
</body>

</html>