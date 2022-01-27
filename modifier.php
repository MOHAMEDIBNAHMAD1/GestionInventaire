<?php
session_start();
if (!isset($_SESSION["cin"]) || empty($_SESSION["cin"]) || strlen(trim($_SESSION["cin"])) === 0) header("Location: login.php?error=cin");

include './credentials.php';
$cin = $_SESSION["cin"];

$id = $_GET["id"];

$res = mysqli_query($conn, "SELECT nom FROM magasinier WHERE cin like '$cin';");
$emp = mysqli_fetch_assoc($res);

$results = mysqli_query($conn, "SELECT * FROM categorie;");
$check = mysqli_num_rows($res);

$pr = mysqli_query($conn, "SELECT * FROM produit WHERE id = $id;");
$productCheck = mysqli_num_rows($res);
$product = mysqli_fetch_assoc($pr);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php include "./meta.php"; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./styles/style.css" />
    <script src="./js/resAside.js" defer></script>
    <title>Modifier produit</title>
</head>

<body>
    <div class="container">
        <?php include './aside.php'; ?>
        <main>
            <h1 style="text-align: center;">Modifier produit</h1>
            <form class="form" action="./operations.php" method="POST" enctype="multipart/form-data">
                <div class="data-input"> <label>Intitule</label><input value="<?= $product["intitule"] ?>" type="text" name="intitule" id=""></div>

                <div class="data-input">
                    <label>Categorie</label>
                    <select name="categorie" id="categorie" required>
                        <option value="" disabled selected>--Choisir une categorie--</option>
                        <?php if ($check > 0) :
                            while ($row = mysqli_fetch_assoc($results)) : ?>
                                <option value="<?= $row["id"]; ?>"><?= $row["intitule"]; ?></option>
                        <?php endwhile;
                        endif; ?>
                    </select>
                </div>

                <div class="data-input"> <label>Prix</label><input value="<?= $product["prix"] ?>" type="number" step="0.01" name="prix" id=""></div>
                <div class="data-input"> <label>Quantite</label><input type="number" name="qtt" value="<?= $product["qtt"] ?>" id=""></div>
                <div class="data-input"> <label>Image</label><input type="file" name="img" value="<?= $product["img"] ?>" id="" accept="image/*"></div>
                <div class="data-input"> <label>Description</label><textarea name="desc" id="" cols="30" rows="10"><?= $product["description"] ?></textarea></div>
                <div class="data-input btns"> <a class="an" href="./index.php">Annuler</a><button class="sub" type="submit">Modifier</button></div>
                <div class="data-input btns"> <input type="text" name="op" id="" value="mod" hidden></div>
                <div class="data-input btns"> <input type="text" name="id" id="" value="<?= $id ?>" hidden></div>
                <!-- <div class="data-input"><a href="./index.php">Annuler</a><input type="submit" value="Modifier"></div> -->

            </form>
            <footer>footer</footer>
        </main>
    </div>
</body>

</html>