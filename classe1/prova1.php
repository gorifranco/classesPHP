<?php
echo "<table style='text-align: center; font-size: 15pt;'>";
for ($i = 0; $i <= 10; $i++) {
    echo "<tr>";
    for ($j = 49; $j <= 60; $j++) {
        $linea = "<td style='background: ";
        if($j == 49 && $i == 0){
            $linea .= "mediumpurple'/>";
        }
        else if($j == 49){
            $linea .= "aquamarine'> $i </td>";
        }
        else if($i == 0){
            $linea .= "aquamarine'> $j </td>";
        }
        else if($j % 2 == 0){
            $linea .= "lightgreen'>".(($j % $i == 0) ? "*" : "-" ). "</td>";
        }
        else{
            $linea .= "lemonchiffon'>".(($j % $i == 0) ? "*" : "-" )."</td>";
        }
        echo $linea;
    }
    echo "</tr>";
}
echo "</table>";
?>