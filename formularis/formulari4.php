<?php
$nom = null;
$dni = null;
$mail = null;
$nota = null;
$errorNom = "";
$errorDni = "";
$errorMail = "";
$errorNota = "";
$dicplayC2 = "display: none;";
$dicplayC1 = "display: block;";
$desconte = 0;
$error = false;

if(isset($_POST["nom"])){
    $nom = $_POST["nom"];
    if($nom == ""){
        $errorNom = "<small> (*) Camp obligatori</small>";
        $error = true;
    }
}else{
    $nom = "";
    $error = true;
}

if(isset($_POST["dni"])){
    $dni = $_POST["dni"];
    if($dni == ""){
        $errorDni = "<small> (*) Camp obligatori</small>";
        $error = true;
    }
}else{
    $dni = "";
    $error = true;
}

if(isset($_POST["mail"])){
    $mail = $_POST["mail"];
    if($mail == ""){
        $errorMail = "<small> (*) Camp obligatori</small>";
        $error = true;
    }
}else{
    $mail = "";
    $error = true;
}

if(isset($_POST["nota"])){
    $nota = $_POST["nota"];
    if($nota == ""){
        $errorNota = "<small> (*) Camp obligatori</small>";
        $error = true;
    }
}else{
    $nota = "";
    $error = true;
}
if($error === false){
    $dicplayC1 = "display: none;";
    $dicplayC2 = "display: block;";
    if(isset($_POST["nota"]) and $_POST["nota"] >= 9.5) $desconte += 0.1;
    if(isset($_POST["germans"]) and $_POST["germans"] >= 3) $desconte += 0.2;

}



?>

<!doctype html>
<html lang="es">
<head>
    <title>PHP Formularis</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style>
    #container2{
        <?=$dicplayC2?>
    }
    #container1{
    <?=$dicplayC1?>
    }
    small{
        margin-left: 4px;
        color: red;
    }
</style>
</head>

<body>

<div id="container1"">
    <div class="container">
        <form method = "post" action="#">
            <p class="h4">Exemple formularis. Responsive.</p>

            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="nom">Nom</label><?=$errorNom?>
                    <input type="text" id="nom" name = "nom" value="<?=$nom?>" class="form-control" placeholder="Nom">
                </div>
                <div class="form-group col-md-4">
                    <label for="dni">DNI</label><?=$errorDni?>
                    <input type="text" id="dni" name = "dni" value="<?=$dni?>" class="form-control" placeholder="dni">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="direccio">Adreça</label>
                    <input type="text" id="direccio" name = "adr" value="" class="form-control" placeholder="Nom">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">EMAIL</label><?=$errorMail?>
                    <input type="text" id="email" name = "mail" value="<?=$mail?>" class="form-control" placeholder="email">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="telefon">Telefon</label>
                    <input type="text" id="telefon" name = "TELEFON" value="" class="form-control" placeholder="Telefon">
                </div>
                <div class="form-group col-md-5">
                    <label for="localitat">Localitat</label>
                    <input type="text" id="localitat" name = "LOCALITAT" value="" class="form-control" placeholder="localitat">
                </div>
                <div class="form-group col-md-2">
                    <label for="cp">CP</label>
                    <input type="text" id="cp" name = "CP" value="" class="form-control" placeholder="cp">
                </div>
                <div class="form-group col-md-3">
                    <label for="provincia">Província</label>
                    <input type="text" id="provincia" name = "TELEFON" value="" class="form-control" placeholder="telefon">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="titulacio">Titulacio</label>
                    <input type="text" id="titulacio" name = "tit" value="" class="form-control" placeholder="Titulació">
                </div>
                <div class="form-group col-md-2">
                    <label for="nota">Nota</label><?=$errorNota?>
                    <input type="number" id="nota" name="nota" value="<?=$nota?>" class="form-control" placeholder="nota">
                </div>
                <div class="col-md-2">
                    <label for="mes18">Major 18 anys</label>
                    <input type="checkbox" id="mes18" class="form-control"  name="MES18">
                </div>
                <div class="form-group col-md-2">
                    <label for="germans">Germans</label>
                    <input type="number" id="germans" name = "germans" value="" class="form-control" placeholder="germans">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                </div>
                <div class="form-group col-md-6">
                    <button type = "submit"  class="btn btn-info" name = "BOTOENVIAR">Enviar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="container2">
    <p>Matrícula realitzada amb èxit</p>
    <p>S'aplicarà un <?=$desconte * 100?>% de descompte. Total a pagar: <?php echo 50*(1-$desconte)?> euros</p>
</div>
</body>
</html>