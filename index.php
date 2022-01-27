<?php
session_start();
if (!isset($_SESSION["cin"]) || empty($_SESSION["cin"]) || strlen(trim($_SESSION["cin"])) === 0) header("Location: login.php?error=cin");

include './credentials.php';


$cin = $_SESSION["cin"];
$res = mysqli_query($conn, "SELECT id, nom FROM magasinier WHERE cin like '$cin';");
$emp = mysqli_fetch_assoc($res);
$idmag = $emp['id'];

$maxSell = mysqli_query($conn, "SELECT produit.intitule, SUM(achat.qtt) as qtt FROM achat, produit WHERE produit.id = achat.idPr GROUP BY produit.intitule ORDER by qtt desc LIMIT 1;");
$minStock = mysqli_query($conn, "SELECT intitule, qtt FROM produit ORDER by qtt asc LIMIT 1;");

if (isset($_POST['achat'])) {

    $id = $_POST['prod'];
    $qtt = $_POST['quant'];


    $query = "SELECT intitule ,qtt FROM produit WHERE id = $id;";

    $res = mysqli_query($conn, $query);
    $produit = mysqli_fetch_assoc($res);

    if ($qtt > $produit['qtt']) {
        echo "<script>alert('Quantie disponible " . $produit['qtt'] . "')</script>";
    } else {

        mysqli_query($conn, "UPDATE produit SET qtt = qtt - $qtt WHERE id = $id");
        mysqli_query($conn, "INSERT INTO `achat`(`idPr`, `idmag`, `qtt`) VALUES ($id, $idmag,$qtt)");
    }
}



$products = mysqli_query($conn, "SELECT produit.id, categorie.intitule as intCa, produit.intitule, prix, qtt, produit.description, img FROM produit, categorie WHERE categorie.id = produit.idCat;");
$rescheck = mysqli_num_rows($products);
$prs = mysqli_query($conn, "SELECT id, intitule ,qtt FROM produit;");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./styles/style.css" />
    <script src="./js/main.js" defer></script>
    <script src="./js/voir.js" defer></script>
    <script src="./js/resAside.js" defer></script>
    <title>Home</title>
</head>

<body>
    <div class="container">
        <div id="modal">
            <form class="achat" action="./index.php" method="POST">
                <div class="data-input">
                    <label for="">Produit</label>
                    <select name="prod" id="" required>
                        <option value="" disabled selected>--Choisir un prouduit--</option>
                        <?php if ($rescheck > 0) :
                            while ($pr = mysqli_fetch_assoc($prs)) : ?>
                                <option value="<?= $pr['id'] ?>"><?= $pr['intitule'] ?></option>
                        <?php endwhile;
                        endif; ?>
                    </select>
                </div>
                <div class="data-input">
                    <label for="">Quantite</label>
                    <input type="number" name="quant" required>
                </div>
                <div class="data-input bbtns">
                    <input class="ann" type="button" value="Annuler">
                    <input class="conf" type="submit" name="achat" value="Confirmer">
                </div>
            </form>
        </div>

        <?php include './aside.php'; ?>
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
                    <p>
                    </p>
                </div>
                <div><i class="fas fa-5x fa-sort-amount-down"></i>
                    <p>
                        <?php if (mysqli_num_rows($minStock) > 0) :
                            $min = mysqli_fetch_assoc($minStock) ?>
                            <?= $min['intitule']; ?>
                            <br>
                            <?= $min['qtt']; ?>
                        <?php endif; ?>
                    </p>
                </div>
                <div><i class="fas fa-5x fa-sort-amount-up"></i>
                    <p>
                        <?php if (mysqli_num_rows($maxSell) > 0) :
                            $max = mysqli_fetch_assoc($maxSell) ?>
                            <?= $max['intitule']; ?>
                            <br>
                            <?= $max['qtt']; ?>
                        <?php endif; ?>
                    </p>
                </div>
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
                            <div class="voir-prod">
                                <i class="fas fa-2x fa-times"></i>
                                <div class="voir-content">
                                    <img src="./imgs/products/<?= $row['img'] ?>" alt="img">
                                    <p><?= $row['description'] ?></p>
                                </div>
                            </div>
                    <?php endwhile;
                    endif; ?>
                </table>
            </section>
            <footer>footer</footer>
        </main>
    </div>
</body>

</html>