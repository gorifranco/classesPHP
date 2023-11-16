<?php
session_start();
require_once __DIR__ . "/DBConnection.php";

if(!isset($_GET["id"]) || $_GET["id"] == ""){
    header("Location: index.php");
    exit();
}

if (isset($_POST["submit"])) {
    if(DBConnection::updateLlibre($_GET["id"], $_POST["titol"],
        DBConnection::id_edit_where_nom_edit($_POST["editorial"]) , $_POST["departament"], $_POST["llocedicio"])){
        echo "<script>alert('Upate realitzat amb èxit')</script>";
    }else{
        echo "<script>alert('Error canviant les dades')</script>";
    }
}

if(isset($_POST["delete"])){
    echo (DBConnection::eliminarLlibre($_GET["id"]))?"<script>alert('Llibre eliminat')</script>":"<script>alert('Error eliminant el llibre')</script>";
}

$_SESSION["dades"] =DBConnection::dadesLlibre($_GET["id"]);

function optionsDepartament()
{
$array = DBConnection::departments();
    foreach ($array as $dep) {
        if ($dep["departament"] == $_SESSION["dades"]["fk_departament"]) {
            echo "<option selected='selected'>{$dep["departament"]}</option>";
        } else {
            echo "<option>{$dep["departament"]}</option>";
        }
    }
}

function optionsEditorial()
{
    $array = DBConnection::editorials();
    foreach ($array as $edit) {
        if ($edit["editor"] == $_SESSION["dades"]["nom_edit"]) {
            echo "<option selected='selected'>{$edit["editor"]}</option>";
        } else {
            echo "<option>{$edit["editor"]}</option>";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Editar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
<div class="container mt-5 border p-4">
    <form action="editar.php?id=<?= $_GET["id"] ?>" method="post">
        <div class="text-center"><h2>Llibres</h2></div>
        <div class="row form-row">
            <div class="form-group col-md-4">
                <label for="id_llib">ID</label>
                <input type="number" name="id_llib" class="form-control" id="id_llib" disabled="disabled"
                       value="<?= $_SESSION["dades"]["id"] ?>">
            </div>
            <div class="form-group col-md-8">
                <label for="titol">Títol</label>
                <input name="titol" type="text" class="form-control" id="titol" placeholder="titol"
                       value="<?= $_SESSION["dades"]["titol"] ?>">
            </div>
        </div>
        <div class="row form-row">
            <div class="form-group col-md-4">
                <label for="lloc_edicio">Lloc Edició</label>
                <input name="llocedicio" type="text" class="form-control" id="lloc_edicio" placeholder="Lloc edició"
                       value="<?= $_SESSION["dades"]["llocedicio"] ?>">
            </div>
            <div class="form-group col-md-4">
                <label for="departament">Departament</label>
                <select name="departament" id="departament" class="form-control">
                    <?php optionsDepartament(); ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="editorial">Editorial</label>
                <select name="editorial" id="editorial" class="form-control">
                    <?php optionsEditorial(); ?>
                </select>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-3" name="submit">Guardar</button>
            <button type="button" class="btn btn-danger mt-3" name="delete">Eliminar</button>
        </div>
    </form>
</div>
</body>
</html>