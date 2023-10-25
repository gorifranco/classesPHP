<?php
session_start();
if (isset($_SESSION["mail"])) {
    echo "Uep, com va " . $_SESSION["mail"] . "?<br/>";
    echo "<a href='logout.php'>logout</a><br/>";
} else {
    header("Location: login.php");
}

$productes = ["0000" => ["cireres", "gut shit", 5], "0001" => ["llom", "llom de trutja", 2], "0002" => ["colquers", "venenplens", 7],
    "0003" => ["curry", "Lo més bo de sa llista", 1], "0004" => ["pomes", "d'un pomer", 1.5]];

if(isset($_POST["submit"])){
    $_SESSION["carrito"] = [];
    foreach ($productes as $key => $producte){
        if($_POST[$key] > 0){
            array_push([$producte[0], ]);
            $_SESSION["carrito"]
        }
    }
}

?>
<html>
<head>
</head>
<body>
<form method="post" action="#">
    <?php
    echo '<ul>';
    foreach ($productes as $key => $producte) {
        echo '<li><label>' . ucfirst($producte[0]) . ':';
        echo '<input type="number" value="0" min="0" name="' . $key . '">';
        echo 'Descripció: ' . $producte[1] . ' ';
        echo 'Preu: ' . $producte[2];
        echo "</label></li>";
    }
    echo '</ul>';
    ?>
<input type="submit" value="Enviar" name="submit">
</form>
</body>
</html>


