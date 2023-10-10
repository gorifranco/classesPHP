<?php
$error=false;
if ($nom=='') {
    echo "Error. Nom requerit<br/>";
    echo "<a href=\"formulari.php\">Torna al formulari</a>";
    $error=true;
}
If (!$error) {
    echo "<h2>He rebut les dades:</h2>";
    echo "Nom: $nom";
    echo "<br/>";

    echo "email: $email";
    echo "<br/>";

    echo "Comentari: $comentari";
    echo "<br/>";

    echo "Sexe: $sexe";
    echo "<br/>";

    $coma='';
    echo "Llenguatges:";
    foreach ($llenguatges as $ll) {
        echo "$coma $ll";
        $coma=',';
    }
}
?>