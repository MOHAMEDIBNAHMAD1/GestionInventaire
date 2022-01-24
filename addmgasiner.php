<?php
session_start();
if (!isset($_SESSION["admin"]) || empty($_SESSION["admin"]) || strlen(trim($_SESSION["admin"])) === 0) header("Location: login.php?error=cin");

include './credentials.php';
$cin = $_SESSION["admin"];

$res = mysqli_query($conn, "SELECT nom FROM admin WHERE cin like '$cin';");
$emp = mysqli_fetch_assoc($res);

// $results = mysqli_query($conn, "SELECT * FROM categorie;");
// $check = mysqli_num_rows($res);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge" /> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./styles/styleadmin.css" />
    <title>Home</title>
</head>

<body>
    <div class="container">
        <?php include './asideadmin.php'; ?>
        <main>
            <h1 style="text-align: center;">Ajouter magasinier</h1>
            <form class="form" action="./operationAdmin.php" method="POST">
                <!-- <div class="data-input"> <label>Intitule</label><input type="text" name="intitule" id=""></div> -->

                <!-- <div class="data-input">
                    <label>Categorie</label>
                    <select name="categorie" id="categorie" required>
                        <option value="" disabled selected>--Choisir une categorie--</option>
                        <?php if ($check > 0) :
                            while ($row = mysqli_fetch_assoc($results)) : ?>
                                <option value="<?= $row["id"]; ?>"><?= $row["intitule"]; ?></option>
                        <?php endwhile;
                        endif; ?>
                    </select>
                </div> -->

                <div class="data-input"> <label>Nom</label><input type="text" name="nommag" id=""></div>
                <div class="data-input"> <label>Cin</label><input type="text" name="CINm" id=""></div>
                <div class="data-input"> <label>Password</label><input type="text" name="pwd" id=""></div>
                <!-- <div class="data-input"> <label>Image</label><input type="file" name="img" id="" accept=".png,.jpg,.jpeg"></div> -->
                <!-- <div class="data-input"> <label>Description</label><textarea name="desc" id="" cols="30" rows="10"></textarea></div> -->
                <div class="data-input btns"> <a class="an" href="./admin.php">Annuler</a><button class="sub" type="submit">Ajouter</button></div>
                <div class="data-input btns"> <input type="text" name="op" id="" value="ajt" hidden></div>
                <div class="data-input btns"> <input type="text" name="id" id="" value="<?= $id ?>" hidden></div>
                <!-- <div class="data-input"><a href="./index.php">Annuler</a><input type="submit" value="Modifier"></div> -->

            </form>
            <footer>Copyright 2022 all rights reserved</footer>
        </main>
    </div>
</body>

</html>