<?php
session_start();
if (!isset($_SESSION["cin"]) || empty($_SESSION["cin"]) || strlen(trim($_SESSION["cin"])) === 0) header("Location: login.php?error=cin");

include './credentials.php';
$cin = $_SESSION["cin"];

// if($_SERVER["HTTP_REQUEST"])
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $intitule = $_POST['intitule'];
    $cat = $_POST['categorie'];
    $prix = $_POST['prix'];
    $qtt = $_POST['qtt'];
    $img = $_FILES['img']['name'];
    $imgname = time() . "$img";
    $dest = "imgs/products/$imgname";
    $desc = $_POST['desc'];
    move_uploaded_file($_FILES['img']['tmp_name'], $dest);
    if ($_POST['op'] === 'mod') {
        $id = $_POST['id'];
        mysqli_query($conn, "UPDATE `produit` SET `idCat`=$cat ,`intitule`='$intitule',`prix`=$prix,`description`='$desc', `qtt` = $qtt, `img` = '$imgname' WHERE id = $id;") or die(mysqli_error($conn));
    } else if ($_POST['op'] === 'ajt') {
        mysqli_query($conn, "INSERT INTO `produit`(`idCat`, `intitule`, `prix`, `description`, `qtt`, `img`) VALUES ($cat,'$intitule',$prix,'$desc',$qtt,'$imgname');") or die(mysqli_error($conn));
    }
}
header("Location: ./index.php");

// $res = mysqli_query($conn, "SELECT nom FROM magasinier WHERE cin like '$cin';");
// $emp = mysqli_fetch_assoc($res);
