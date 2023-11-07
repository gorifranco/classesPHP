<?php
session_start();

if(isset($_POST["nou"])){
    session_unset();
    echo "Alumne nou";
}

if(!isset($_SESSION["moduls"]))
$_SESSION["moduls"] = 1;

if(!isset($_SESSION["notes"])) $_SESSION["notes"] = [];

if(isset($_POST["afegirModul"])) ++$_SESSION["moduls"];

$_SESSION["valornota"] = ["Deficient" => 2, "Insuficient" => 4, "Suficient" => 5, "Bé" => 6, "Notable" => 8, "Excelent" => 9, "Matrícula" => 10];

if(isset($_POST["Enviar"])){

    if(!isset($_SESSION["alumne"])) $_SESSION["alumne"] = $_POST["nom_alumne"];

    if($_POST["nom_alumne"] != $_SESSION["alumne"]){
        echo "error, has canviat d'alumne";
    }else if($_POST["nom_modul"] == "" && isset($_POST["nom_modul"])){
        echo "error, no s'ha guardat.";
    }else{
        array_push($_SESSION["notes"], [$_POST["nom_modul"], $_POST["nota"]]);
        echo "guardat";
    }

}

function generarRadioButtons(){
    echo "<label>Nota:";
    foreach ($_SESSION["valornota"] as $key => $value){
        echo " <input type=radio value={$key} name=nota>{$key}({$value})";
    }
    echo "</label>";
}

?>
<form action="entranota.php" method="post">
    <label>Nom de l'alumne:
        <input type="text" name="nom_alumne"  style="margin-bottom: 5px" <?php if(isset($_SESSION["alumne"])) echo "value={$_SESSION["alumne"]}"?>>
    </label>
    <br/>
    <label>Nom del mòdul:
        <input type=text name=nom_modul style='margin-right: 5px'>
        </label>
<?php generarRadioButtons();?>
    <br/>
    <input type="submit" value="Enviar" name="Enviar">
</form>
<br/>
<form action="bulleti.php">
    <input type="submit" name="anarBulleti" value="anar al bulleti">
</form>

