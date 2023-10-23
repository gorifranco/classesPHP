<?php
session_start();
if (isset($_SESSION['usuari'])) {
    // Hay una sesión en curso, muestra un mensaje
    echo "¡Bienvenido, " . $_SESSION['usuari'] . "!";
} else {
    header("Location: login.php");
    exit;
}
