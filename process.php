<?php
session_start();
if (isset($_GET["decon"])) {
    session_unset();
    header("Location: ./login.php");
} else {
    if (!isset($_POST["cin"]) || empty($_POST["cin"]) || strlen(trim($_POST["cin"])) === 0)
        header("Location: ./login.php?error=notset");
    else {

        $cin = $_POST["cin"];
        $role = $_POST["role"];

        include './credentials.php';

        $res = mysqli_query($conn, "SELECT * FROM $role WHERE cin like '$cin';");

        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);

            $pass = $_POST["pass"];
            if ($pass === $row["PASSWORD"]) {
                $_SESSION["cin"] = $cin;
                if ($role === "magasinier") header("Location: ./index.php");
            } else {
                header("Location: ./login.php?error=pass");
            }
            // echo $row["PASSWORD"] . "<br>";
            // echo $cin . "<br>";
            // echo $role . "<br>";
        } else {
            header("Location: ./login.php?error=cin");
        }
    }
}
