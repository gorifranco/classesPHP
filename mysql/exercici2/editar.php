<?php
session_start();

dadesLlibre();

if(isset($_POST["submit"])){
    $connexio = new Mysqli();
    $connexio->connect("localhost", "root", "1234", "biblioteca", 3306);
    $sql1 = "select id_edit from editors where nom_edit = {$_POST["editorial"]}";
    $nom_editor = (($connexio->query($sql1))->fetch_assoc())["id_edit"];

    $sql = "update llibres set titol=?, fkidedit=?, fk_departament=?, llocedicio=? where id_llib = {$_GET["id"]}";
    $prepared = $connexio->prepare($sql);

    if (!$prepared) {
        die("Error en la preparación de la consulta: " . $connexio->error);
    }

    $prepared->bind_param("siss", $_POST["titol"], $nom_editor, $_POST["departament"], $_POST["llocedicio"]);

    if ($prepared->execute() === TRUE) {
        echo "Tupla actualizada correctamente";
    } else {
        echo "Error al actualizar la tupla: " . $connexio->error;
    }
}

function dadesLlibre(){
    $connexio = new Mysqli();
    $connexio->connect("localhost", "root", "1234", "biblioteca", 3306);

    $sql = "select id_llib as id, titol, nom_edit, fk_departament, llocedicio from llibres
        inner join editors on editors.id_edit = llibres.fk_idedit where id_llib = {$_GET["id"]}";

    $prepared = $connexio->prepare($sql);

    $prepared->execute();
    $_SESSION["dades"] = ($prepared->get_result())->fetch_assoc();
    $prepared->close();
    $connexio->close();
}

function optionsDepartament(){
    $connexio = new Mysqli();
    $connexio->connect("localhost", "root", "1234", "biblioteca", 3306);

    $sql = "select departament from departaments";

    $prepared = $connexio->prepare($sql);

    $prepared->execute();
    $result_set = $prepared->get_result();

    $array = array();

    while ($row = $result_set->fetch_assoc()) {
        $array[] = $row;
    }

    $prepared->close();
    $result_set->close();
    $connexio->close();

    foreach ($array  as $dep){
        if($dep["departament"] == $_SESSION["dades"]["fk_departament"]){
        echo "<option selected='selected'>{$dep["departament"]}</option>";
        }else{
            echo "<option>{$dep["departament"]}</option>";
        }
    }
}

function optionsEditorial(){

    $connexio = new Mysqli();
    $connexio->connect("localhost", "root", "1234", "biblioteca", 3306);

    $sql = "select nom_edit as editor from editors";

    $prepared = $connexio->prepare($sql);

    $prepared->execute();
    $result_set = $prepared->get_result();

    $array = array();

    while ($row = $result_set->fetch_assoc()) {
        $array[] = $row;
    }

    $prepared->close();
    $result_set->close();
    $connexio->close();

    foreach ($array  as $edit){
        if($edit["editor"] == $_SESSION["dades"]["nom_edit"]){
            echo "<option selected='selected'>{$edit["editor"]}</option>";
        }else{
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
    <form action="editar.php?id=<?=$_GET["id"]?>" method="post">
        <div class="text-center"><h2>Llibres</h2></div>
    <div class="row form-row">
        <div class="form-group col-md-4">
            <label for="id_llib">ID</label>
            <input type="number" class="form-control" id="id_llib" disabled="disabled" value="<?=$_SESSION["dades"]["id"]?>">
        </div>
        <div class="form-group col-md-8">
            <label for="titol">Títol</label>
            <input name="titol" type="text" class="form-control" id="titol" placeholder="titol" value="<?=$_SESSION["dades"]["titol"]?>">
        </div>
    </div>
    <div class="row form-row">
        <div class="form-group col-md-4">
            <label for="lloc_edicio">Lloc Edició</label>
            <input name="llocedicio" type="text" class="form-control" id="lloc_edicio" placeholder="Lloc edició" value="<?=$_SESSION["dades"]["llocedicio"]?>">
        </div>
        <div class="form-group col-md-4">
            <label for="departament">Departament</label>
            <select name="departament" id="departament" class="form-control">
                <?php optionsDepartament();?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="editorial">Editorial</label>
            <select name="editorial" id="editorial" class="form-control">
                <?php optionsEditorial();?>
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