<?php
session_start();
//$_SESSION["llista"] = [];
if (isset($_SESSION["llista"])) {
    if (isset($_POST["item"]) && $_POST["item"] != '') array_push($_SESSION["llista"], $_POST["item"]);
}
if(count($_SESSION["llista"]) > 0){
    for ($i = 0; $i < count($_SESSION["llista"]); $i++) {
        if (isset($_POST[$_SESSION["llista"][$i]])) {
            unset($_SESSION["llista"][$i]);
        }
    }
}

if (isset($_SESSION["llista"]) && count($_SESSION["llista"]) > 0) {
    echo "<ul>";
    foreach ($_SESSION["llista"] as $value) {
        echo "<li>$value<form action='#' method='post'><input type='submit' name='$value'>borrar</input></form></li>";

    }
    echo "</ul>";
}

?>
<form method="post" action="#">
    <label>
        <input type="text" name="item" placeholder="Item">
        <input type="submit" value="Afegir">
    </label>
</form>
