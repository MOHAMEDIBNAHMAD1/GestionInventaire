<?php
session_start();
if (!isset($_SESSION["cin"]) || empty($_SESSION["cin"]) || strlen(trim($_SESSION["cin"])) === 0) header("Location: login.php?error=cin");
include './credentials.php';
$id = $_GET["id"];
$products = mysqli_query($conn, "DELETE FROM categorie WHERE id = $id;");
header("Location: ./ajoutercatégorie.php");
