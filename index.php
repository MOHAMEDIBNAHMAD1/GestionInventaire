<?php
session_start();
if (!isset($_SESSION["cin"]) || empty($_SESSION["cin"]) || strlen(trim($_SESSION["cin"])) === 0) header("Location: login.php?error=cin");

include './credentials.php';
$cin = $_SESSION["cin"];

$res = mysqli_query($conn, "SELECT nom FROM magasinier WHERE cin like '$cin';");
$emp = mysqli_fetch_assoc($res);

$products = mysqli_query($conn, "SELECT produit.id, categorie.intitule as intCa, produit.intitule, prix, qtt, description, img FROM produit, categorie WHERE categorie.id = produit.idCat;");
$rescheck = mysqli_num_rows($products);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./styles/style.css" />
    <title>Home</title>
</head>

<body>
    <div class="container">
        <aside>
            <div class="infos">
                <img src="./imgs/user-img.png" alt="user img" />
                <p><?= $emp['nom']; ?></p>
            </div>
            <div class="menu">
                <a href="#"><i class="fas fa-home"></i>Accueil</a>
                <a href="#"><i class="fas fa-plus-circle"></i>Ajouter produit</a>
                <a href="#"><i class="fas fa-file-invoice-dollar"></i>Effecuter achat</a>
                <a href="./process.php?decon"><i class="fas fa-sign-out-alt"></i>Se déconnecter</a>
            </div>
        </aside>
        <main>
            <header>
                <div>
                    <input type="text" name="rechercher id=" recherche" placeholder="Rechercher..." />
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
                        <td>Intitule</td>
                        <td>Prix</td>
                        <td>Categorie</td>
                        <td>Quantite</td>
                        <td>Edit</td>
                        <td></td>
                    </tr>
                    <?php
                    if ($rescheck > 0) :
                        while ($row = mysqli_fetch_assoc($products)) : ?>
                            <tr>
                                <td>#<?= $row["id"]; ?></td>
                                <td><?= $row["intitule"]; ?></td>
                                <td><?= $row["prix"]; ?></td>
                                <td><?= $row["intCa"]; ?></td>
                                <td><?= $row["qtt"]; ?></td>
                                <td class="edit">
                                    <a href="./modifier.php?id=<?= $row["id"]; ?>">
                                        <i class="fas fa-lg fa-edit"></i>
                                    </a>
                                    <a href="./supprimer.php?id=<?= $row["id"]; ?>">
                                        <i class="fas fa-lg fa-trash"></i>
                                    </a>
                                </td>
                                <td>
                                    <button class="voir">
                                        <p>Voir</p><i class="far fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                    <?php endwhile;
                    endif; ?>
                </table>
            </section>
            <footer>footer</footer>
        </main>
    </div>
</body>

</html>