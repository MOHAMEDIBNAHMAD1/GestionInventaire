<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php include "./meta.php"; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/login.css">
    <title>Login</title>
</head>

<body class="login">
    <div class="login-box">
        <img src="./imgs/Logo.png" alt="img">
        <form action="./process.php" method="post">
            <div class="inputs">
                <?php if (isset($_GET["error"])) {
                    if ($_GET["error"] === 'notset')
                        echo "Please fill all fields!!!</br>";
                    else if ($_GET["error"] === 'cin')
                        echo "Cin incorrect!!!</br>";
                    else if ($_GET["error"] === 'pass')
                        echo "Password incorrect!!!</br>";
                } ?>
                <div class="aftercin">
                    <input type="text" name="cin" id="cin" required autocomplete="off">
                    <label>Cin</label>
                </div>
                <div class="afterpass">
                    <input type="password" name="pass" id="pass" required>
                    <label>Password</label>
                </div>
            </div>
            <div class="emptyp">
                <input type="radio" name="role" id="maga" value="magasinier" checked> <label for="maga">Magasinier</label>
                <input type="radio" name="role" id="admin" value="admin"> <label for="admin">Admin</label>
            </div>
            <input type="submit" value="Connexion">
            <p class="oblie">Mot de passe oublié?</p>
        </form>
    </div>
    <div class="imgd">
        <img src="./imgs/imag-loign.png" alt="img">
    </div>

</body>

</html>