<?php
$CIUTATS = array("Alcúdia"=>array("Habitants"=>19172, "Illa"=>"Mallorca"), "Formentera"=>array("Habitants"=>9962, "Illa"=>"Formentera"),
    "Alaior"=>array("Habitants"=>9399, "Illa"=>"Menorca"), "Ciutadella"=>array("Habitants"=>29247, "Illa"=>"Menorca"));

echo "Exercici a)<br>";
ksort($CIUTATS);
$total = 0;
echo "<table>";
foreach ($CIUTATS as $item => $cc){
    $total += $cc["Habitants"];
    echo "<tr><td>$item</td><td>".$cc["Habitants"]."</td><td>".$cc["Illa"]."</td></tr>";
}
echo "<tr><td>Total</td><td>$total</td></tr>";
echo "</table>";

echo "<br>Exercici b)<br>";
asort($CIUTATS);
foreach ($CIUTATS as $item => $cc){
    echo "<tr><td>$item</td><td>".$cc["Habitants"]."</td><td>".$cc["Illa"]."</td></tr>";
}
?>