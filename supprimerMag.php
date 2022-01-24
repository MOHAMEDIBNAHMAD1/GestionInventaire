<?php
session_start();
if (!isset($_SESSION["admin"]) || empty($_SESSION["admin"]) || strlen(trim($_SESSION["admin"])) === 0) header("Location: login.php?error=cin");
include './credentials.php';
$id = $_GET["id"];
$magasiniers = mysqli_query($conn, "DELETE FROM magasinier WHERE id = $id;");
header("Location: ./admin.php");
