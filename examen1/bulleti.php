<?php
session_start();

if(!isset($_SESSION["alumne"])){
    header("Location: entranota.php");
}
echo $_SESSION["alumne"];

asort($_SESSION["notes"]);

echo "<ul>";
foreach ($_SESSION["notes"] as $val){
    echo "<li>Mòdul: {$val[0]}. Nota: {$val[1]}</li>";
}
echo "</ul>";
function calcularMitjana(){
    $total = 0;
    foreach ($_SESSION["notes"] as $nota){
        $total += $_SESSION["valornota"][$nota[1]];
    }
    $mitjana = $total / count($_SESSION["notes"]);
    echo "Nota mitja: {$mitjana}";
}
calcularMitjana();


?>
<form action="entranota.php" method="post">
    <input type="submit" name="nou" value="Nou bulleti">
</form>