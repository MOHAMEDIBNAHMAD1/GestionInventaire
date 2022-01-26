<?php
session_start();
if (!isset($_SESSION["admin"]) || empty($_SESSION["admin"]) || strlen(trim($_SESSION["admin"])) === 0) header("Location: login.php?error=cin");

include './credentials.php';
$cin = $_SESSION["admin"];

$res = mysqli_query($conn, "SELECT nom FROM admin WHERE cin like '$cin';");
$emp = mysqli_fetch_assoc($res);

$magsiniers = mysqli_query($conn, "SELECT * FROM `magasinier`");
$rescheck = mysqli_num_rows($magsiniers);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./styles/styleadmin.css" />
    <title>Home</title>
</head>

<body>
    <div class="container">
        <?php include './asideadmin.php'; ?>
        <main>
            <header>
                <div>
                    <input type="text" name="rechercher" id=" recherche" placeholder="Rechercher..." />
                    <i class="fas fa-search"></i>
                </div>
                <img src="./imgs/Logo.png" alt="img" />
            </header>
            <section class="stats">
                <div><i class="fas fa-5x fa-layer-group"></i>
                    <p>item on stock</p>
                </div>
                <div><i class="fas fa-5x fa-sort-amount-down"></i></div>
                <div><i class="fas fa-5x fa-sort-amount-up"></i></div>
            </section>
            <section class="products">
                <table class="products-list" cellspacing="0">
                    <tr>
                        <td>Id</td>
                        <td>Nom</td>
                        <td>CIN</td>
                        <td>password</td>
                        <!-- <td>Quantite</td> -->
                        <td>Edit</td>
                        <td></td>
                    </tr>
                    <?php
                    if ($rescheck > 0) :
                        while ($row = mysqli_fetch_assoc($magsiniers)) : ?>
                            <tr>
                                <td>#<?= $row["id"]; ?></td>
                                <td><?= $row["nom"]; ?></td>''
                                <td><?= $row["CIN"]; ?></td>
                                <td><?= $row["PASSWORD"]; ?></td>
                                <td class="edit">
                                    <a href="./modifiermag.php?id=<?= $row["id"]; ?>">
                                    <i class="fas fa-lg fa-user-edit"></i>
                                    </a>
                                    <a href="./supprimerMag.php?id=<?= $row["id"]; ?>">
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
            <footer>Copyright 2022 all rights reserved </footer>
        </main>
    </div>
</body>

</html>