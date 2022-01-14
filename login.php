<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/main.css">
    <title>Login</title>
</head>

<body class="login">
    <div class="login-box">
        <img src="./imgs/Logo.png" alt="img">
        <form action="login.php" method="post">
            <div class="inputs">
                <?php if (isset($_GET["error"])) echo "cin required!!!</br>"; ?>
                <input type="text" name="cin" id="cin" placeholder="CIN">
                <input type="password" name="pass" id="pass" placeholder="Password">
            </div>
            <div class="emptyp">
                <input type="radio" name="typeemp" id="maga" value="magasinier"> <label for="maga">magasinier</label>
                <input type="radio" name="typeemp" id="admin" value="admin"> <label for="admin">Admin</label>
            </div>
            <input type="submit" value="submit">
        </form>
    </div>
    <img src="./imgs/imag-loign.png" alt="img">
    <?php
    if (isset($_POST["cin"])) {
        $cin = $_POST["cin"];
        $results = mysqli_query(mysqli_connect("localhost", "root", "", "gestioninventaire"), "SELECT * FROM magasinier WHERE cin like '$cin';");
        $resCheck = mysqli_num_rows($results);
        if ($resCheck > 0) {
            $row = mysqli_fetch_assoc($results);
            if ($_POST["pass"] === $row["PASSWORD"]) {
                echo $row["pass"];
                $_SESSION["cin"] = $_POST["cin"];
                header("Location:index.php");
            }
        }
    }

    ?>
</body>

</html>