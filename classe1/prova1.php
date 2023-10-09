<?php
$CIUTATS = array("Alcúdia"=>array("Habitants"=>19172, "Illa"=>"Mallorca"), "Formentera"=>array("Habitants"=>9962, "Illa"=>"Formentera"),
    "Alaior"=>array("Habitants"=>9399, "Illa"=>"Menorca"), "Ciutadella"=>array("Habitants"=>29247, "Illa"=>"Menorca"));

echo "Exercici a)<br>";
echo "Ordenat per Poble<br/><br/>";
ksort($CIUTATS);
$total = 0;
echo "<table>";
foreach ($CIUTATS as $item => $cc){
    $total += $cc["Habitants"];
    echo "<tr><td>$item</td><td>".$cc["Habitants"]."</td><td>".$cc["Illa"]."</td></tr>";
}
echo "</table>";

echo "<br/>Ordenat per Població<br/><br/>";
asort($CIUTATS);
$total = 0;
echo "<table>";
foreach ($CIUTATS as $item => $cc){
    $total += $cc["Habitants"];
    echo "<tr><td>$item</td><td>".$cc["Habitants"]."</td><td>".$cc["Illa"]."</td></tr>";
}
echo "</table>";

echo "<br>Exercici b)<br>";

array_multisort(array_column($CIUTATS, 'Illa'),  SORT_ASC,
    array_column($CIUTATS, 'Habitants'), SORT_ASC,
    $CIUTATS);

$last = array_key_first($CIUTATS);
$t = 0;

echo "<table>";
foreach ($CIUTATS as $item => $cc){
    if($last !== $cc["Illa"]){
        echo "<tr><td style='row-span: 2;'>Suma de $last: $t</td></tr>";
        $t = 0;
    }
    echo "<tr><td>$item</td><td>".$cc["Habitants"]."</td><td>".$cc["Illa"]."</td></tr>";
    $t += $cc["Habitants"];
    $last = $cc["Illa"];
}
echo "<tr><td style='row-span: 2;'>Suma de $last: $t</td></tr>";
echo "</table>";
?>