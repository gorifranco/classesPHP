<?php
session_start();
if (isset($_SESSION["username"])) {
    echo "Uep, com va " . $_SESSION["username"] . "?<br/>";
    echo "<a href='logout.php'>logout</a><br/>";
} else {
    header("Location: login.php");
}

