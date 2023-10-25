<?php
session_start();
if (isset($_POST['login'])) {
    if (validar($_POST["mail"], $_POST["password"])) {
        $_SESSION["mail"] = $_POST["mail"];
        header("Location: comprova.php");
        exit();
    } else {
        echo "Error de login";
    }
}
if (isset($_POST["register"])) {
    if (registrar()) {
        echo "Registre amb èxit";
    } else {
        echo "Error de registre";
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
    <br>
    Log-In:<br>
    <form method="post" action="login.php">
        <label>Email:
            <input type="text" name="mail">
        </label>
        <label>Contrassenya:
            <input type="password" name="password">
        </label>
        <label>
            <input type="submit" value="Login" name="login">
        </label>
    </form>
    <br>
    Register:<br>
    <form method="post" action="login.php">
        <label>Email:
            <input type="email" name="mailr">
        </label>
        <label>Contrassenya:
            <input type="password" name="passwordr">
        </label>
        <label>Repeteix la contrassenya:
            <input type="password" name="passwordr2">
        </label>
        <label>
            <input type="submit" value="Register" name="register">
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

function registrar()
{
    if ($_POST["mailr"] != "" && ($_POST["passwordr"] == $_POST["passwordr2"])) {
        $file = fopen('users', 'a');
        fwrite($file, $_POST["mailr"] . ':' . $_POST["passwordr"] . PHP_EOL);
        fclose($file);
        return true;
    }
    return false;
}
