<?php
session_start();
if (!isset($_SESSION["admin"]) || empty($_SESSION["admin"]) || strlen(trim($_SESSION["admin"])) === 0) header("Location: login.php?error=cin");

include './credentials.php';
$cin = $_SESSION["admin"];

$res = mysqli_query($conn, "SELECT nom FROM admin WHERE cin like '$cin';");
$emp = mysqli_fetch_assoc($res);

$magsiniers = mysqli_query($conn, "SELECT `id`, `intitule`, `Description` FROM `categorie`");
$rescheck = mysqli_num_rows($magsiniers);
?>
<!-- 
// $results = mysqli_query($conn, "SELECT * FROM categorie;");
// $check = mysqli_num_rows($res);
?> -->

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
            <h1 style="text-align: center;">Ajouter catégorie</h1>
            <form class="form" action="./operationAdmin.php" method="POST">
                        <!-- <?php if ($check > 0) :
                            while ($row = mysqli_fetch_assoc($results)) : ?>
                                <option value="<?= $row["id"]; ?>"><?= $row["intitule"]; ?></option>
                        <?php endwhile;
                        endif; ?>
                    </select>
                </div> -->

                <div class="data-input"> <label>intitulé</label><input type="text" name="intitulé" id=""></div>
                <div class="data-input"> <label>Description</label><textarea name="desccription" id="" cols="30" rows="10"></textarea></div>
                <div class="data-input btns"> <a class="an" href="./admin.php">Annuler</a><button class="sub" type="submit">Ajouter</button></div>
                <div class="data-input btns"> <input type="text" name="op" id="" value="ajtuE" hidden></div>
                <div class="data-input btns"> <input type="text" name="id" id="" value="<?= $id ?>" hidden></div>
                <!-- <div class="data-input"><a href="./index.php">Annuler</a><input type="submit" value="Modifier"></div> -->
            </form>
            <section class="products">
                <table class="products-list" cellspacing="0">
                    <tr>
                        <td>Id</td>
                        <td>intitulé</td>
                        <td>desccription</td>
                        <!-- <td>Quantite</td> -->
                        <td>Edit</td>
                        <td></td>
                    </tr>
                    <?php
                    if ($rescheck > 0) :
                        while ($row = mysqli_fetch_assoc($magsiniers)) : ?>
                            <tr>
                                <td><?= $row["id"]; ?></td>
                                <td><?= $row["intitule"]; ?></td>
                                <td><?= $row["Description"]; ?></td>
                               
                                <!-- <td><?= $row["qtt"]; ?></td> -->
                                <td class="edit">
                                    <a href="./modifiercatégorie.php?id=<?= $row["id"]; ?>">
                                        <i class="fas fa-lg fa-edit"></i>
                                    </a>
                                    <a href="./supprimercatégory.php?id=<?= $row["id"]; ?>">
                                        <i class="fas fa-lg fa-trash"></i>
                                    </a>
                                </td>
                                <!-- <td>
                                    <button class="voir">
                                        <p>Voir</p><i class="far fa-eye"></i>
                                    </button>
                                </td> -->
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