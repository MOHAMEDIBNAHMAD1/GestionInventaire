<?php
session_start();
if (!isset($_SESSION["cin"]) || empty($_SESSION["cin"]) || strlen(trim($_SESSION["cin"])) === 0) header("Location: login.php?error=cin");

include './credentials.php';
$cin = $_SESSION["cin"];

// if($_SERVER["HTTP_REQUEST"])
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST['op'] === 'mod') {
        $id=$_POST['id'];
        $cin = $_POST['CINm'];
        $nom = $_POST['nommag'];
        $pwd = $_POST['pwd'];
       
        mysqli_query($conn, "UPDATE `magasinier` SET `cin`='$cin' ,`nom`='$nom',`PASSWORD`='$pwd' WHERE id = $id;") or die(mysqli_error($conn));
        header("Location: ./admin.php");
    } else if ($_POST['op'] === 'ajt') {
        $id=$_POST['id'];
        $cin = $_POST['CINm'];
        $nom = $_POST['nommag'];
        $pwd = $_POST['pwd'];
        mysqli_query($conn, " INSERT INTO `magasinier`(`nom`, `CIN`, `PASSWORD`) VALUES ('$cin','$nom','$pwd');") or die(mysqli_error($conn));
        header("Location: ./admin.php");
    }
    if ($_POST['op'] == 'modc') {
        $intitule = $_POST['intitulé'];
        $id=$_POST['id'];
        $description = $_POST['desccription'];
     mysqli_query($conn, "UPDATE `categorie` SET `intitule`='$intitule',`Description`='$description' WHERE id=$id") or die(mysqli_error($conn));
     header("Location: ./ajoutercatégorie.php");

    } else if ($_POST['op'] === 'ajtuE') {
        $intitule = $_POST['intitulé'];
        $description = $_POST['desccription'];
        mysqli_query($conn,"INSERT INTO `categorie`( `intitule`, `Description`) VALUES ('$intitule','$description');"); 
        header("Location: ./ajoutercatégorie.php");
    }

    
}

    // if ($_POST['op'] == 'modef') {
    //     die('HHHH');
    //     $intitule = $_POST['intitulé'];
    //     $id=$_GET['id'];
    //     $description = $_POST['desccription'];
    //     die($id);
    //  mysqli_query($conn, "UPDATE `categorie` SET `intitule`='$intitule',`Description`='$description' WHERE id=$id") or die(mysqli_error($conn));

    // } else if ($_POST['op'] === 'ajtE') {
    //     $intitule = $_POST['intitulé'];
    //     $description = $_POST['desccription'];
    //     mysqli_query($conn,"INSERT INTO `categorie`( `intitule`, `Description`) VALUES ('$intitule','$description');"); 
    // }
    //header("Location: ./ajoutercatégorie.php");



// $res = mysqli_query($conn, "SELECT nom FROM magasinier WHERE cin like '$cin';");
// $emp = mysqli_fetch_assoc($res);