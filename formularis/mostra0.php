<?php
echo 'GET<hr/>';
if (isset($_GET["NOM"])){
    echo "NOM: ".$_GET['NOM'];
}else{
    echo "NOM: no hi ha ningu";
}
echo "<br>";

if (!isset($_GET["EMAIL"]) || $_GET["EMAIL"] == ""){
    echo "EMAIL: no hi ha ningu";
}else{
    echo "EMAIL: ".$_GET['EMAIL'];
}
echo "<br>";

if (!isset($_GET["COMENTARI"]) || $_GET["COMENTARI"] == ""){
    echo "COMENTARI: no hi ha ningu";
}else{
    echo "COMENTARI: ".$_GET['COMENTARI'];
}
echo "<br>";

if (!isset($_GET["SEXE"]) || $_GET["SEXE"] == ""){
    echo "SEXE: no hi ha ningu";
}else{
    echo "SEXE: ".$_GET['SEXE'];
}
echo "<br>";

if (!isset($_GET["CICLE"]) || $_GET["CICLE"] == ""){
    echo "CICLE: no hi ha ningu";
}else{
    echo "CICLE: ".$_GET['CICLE'];
}
echo "<br>";

if (!isset($_GET["LLENGUATGES"]) || $_GET["LLENGUATGES"] == ""){
    echo "LLENGUATGES: no hi ha ningu";
}else{
    echo "LLENGUATGES:";
    foreach ($_GET["LLENGUATGES"] as $item => $ss)
    echo "<br>$item: $ss";
}
echo "<br><hr/>";

echo 'POST<hr/>';
echo '<pre>';
print_r($_POST);
echo '</pre>';
echo 'REQUEST<hr/>';
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';