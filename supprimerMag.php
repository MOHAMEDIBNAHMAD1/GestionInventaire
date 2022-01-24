<?php
session_start();
if (!isset($_SESSION["cin"]) || empty($_SESSION["cin"]) || strlen(trim($_SESSION["cin"])) === 0) header("Location: login.php?error=cin");
include './credentials.php';
$id = $_GET["id"];
$magasiniers = mysqli_query($conn, "DELETE FROM magasinier WHERE id = $id;");
header("Location: ./admin.php");
