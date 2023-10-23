<?php

//Exercici a
function rectangle($altura, $amplada){
    return "Un rectangle amb una altura de $altura i una amplada de $amplada té una àrea de " .($altura * $amplada). ". I un perímetre
de " . (2*$altura+2*$amplada) . ".";
}

//Exercici b
function ambFormulari(){
$altura = $_POST["altura"];
$amplada = $_POST["amplada"];

    echo '<p>Introdueixi els valors de la longitud i l\'amplada del seu rectangle.</p>';
    echo '<form method = "post" action = "#">';
    echo '<label>Altura: ';
    echo '<input type = "number" name = "altura" value="0">';
    echo '</label>';
    echo '<label>Amplada: ';
    echo '<input type = "text" name = "amplada" value="0">';
    echo '</label>';
    echo '<input type = "submit" name = "calcular" value = "Calcular">';

    return "Un rectangle amb una altura de $altura i una amplada de $amplada té una àrea de " .($altura * $amplada). ". I un perímetre
de " . (2*$altura+2*$amplada) . ".";
}

//Exercici c
function montarSelect($array, $nomSelect,$fraseLabel, $valorInicial, $multivalue){

    echo '<label for="'.$nomSelect.'">'.$fraseLabel.'</label>';
    echo '<select name="'.$nomSelect.'[ ]"'.(($multivalue)?' multiple="multiple"':'').'>';

    foreach ($array as $value) {
    echo ' <option value="'.$value.(($valorInicial == $value)?' selected':'').'">'.$value.'</option>';
    }
    echo '</select>';
    echo '</label>';
}

