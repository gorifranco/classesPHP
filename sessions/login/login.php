<?php

if (isset($_POST['submit'])) {
    if (validar($_POST["usuari"], $_POST["password"])) {
        session_start();
        $_SESSION["username"] = $_POST["usuari"];
        header("Location: comprova.php");
        exit();
    } else {
        echo "Error de login";
    }
}
?>

    <html lang="ca">
    <head>
        <style>
            label {
                display: inline-block;
            }
        </style>
    </head>
    <body>
    <form method="post" action="login.php">
        <label>Nom d'usuari:
            <input type="text" name="usuari">
        </label>
        <label>Contrassenya:
            <input type="password" name="password">
        </label>
        <label>
            <input type="submit" value="Login" name="submit">
        </label>
    </form>
    </body>
    </html>


<?php
function validar($username, $password)
{
    $authFile = file("users");
    return (in_array("$username:$password\r\n", $authFile));
}
