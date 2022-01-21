<?php
session_start();
if (!isset($_SESSION["cin"]) || empty($_SESSION["cin"]) || strlen(trim($_SESSION["cin"])) === 0) header("Location: login.php?error=cin");

include './credentials.php';
$cin = $_SESSION["cin"];

// if($_SERVER["HTTP_REQUEST"])
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['op'] === 'mod') {
        $id = $_POST['id'];
        $intitule = $_POST['intitule'];
        $cat = $_POST['categorie'];
        $prix = $_POST['prix'];
        $qtt = $_POST['qtt'];
        $img = $_POST['img'];
        $desc = $_POST['desc'];
        mysqli_query($conn, "UPDATE `produit` SET `idCat`=$cat ,`intitule`='$intitule',`prix`=$prix,`description`='$desc', `qtt` = $qtt, `img` = '$img' WHERE id = $id;") or die(mysqli_error($conn));
    } else if ($_POST['op'] === 'ajt') {
        $intitule = $_POST['intitule'];
        $cat = $_POST['categorie'];
        $prix = $_POST['prix'];
        $qtt = $_POST['qtt'];
        $img = $_POST['img'];
        $desc = $_POST['desc'];
        mysqli_query($conn, "INSERT INTO `produit`(`idCat`, `intitule`, `prix`, `description`, `qtt`, `img`) VALUES ($cat,'$intitule',$prix,'$desc',$qtt,'$img');") or die(mysqli_error($conn));
    }
}
header("Location: ./index.php");

// $res = mysqli_query($conn, "SELECT nom FROM magasinier WHERE cin like '$cin';");
// $emp = mysqli_fetch_assoc($res);
