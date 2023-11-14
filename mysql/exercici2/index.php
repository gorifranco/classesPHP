<?php
session_start();


$_SESSION["selected"] = (isset($_GET["sentit"]))?$_GET["ordre"].$_GET["sentit"]:"idasc";
$_SESSION["sentit"] = (isset($_GET["sentit"]))?$_GET["sentit"]:"asc";
$_SESSION["ordre"] = (isset($_GET["ordre"]))?$_GET["ordre"]:"id";

if(isset($_GET["ordre"]) && $_GET["ordre"] == "editor") $_SESSION["ordre"] = "nom_edit";
if(isset($_SESSION["filtre"])){
    if(isset($_GET["filtre"])){
        $_SESSION["filtre"] = $_GET["filtre"];
    }
}else{
    $_SESSION["filtre"] = "";
}

$_SESSION["arrayFiles"] = treureLlibres();

function treureLlibres()
{
    $connexio = new Mysqli();
    $connexio->connect("localhost", "root", "1234", "biblioteca", 3306);

    $sql = "select id_llib as id, titol, nom_edit from llibres
        inner join editors on editors.id_edit = llibres.fk_idedit
        where id like %'{$_SESSION["filtre"]}'% or titol like %'{$_SESSION["filtre"]}'% or nom_edit like %'{$_SESSION["filtre"]}'% 
        order by {$_SESSION["ordre"]} {$_SESSION["sentit"]} limit 10 offset 0";



    $prepared = $connexio->prepare($sql);


    $prepared->execute();
    $result_set = $prepared->get_result();


    $array = array();

    while ($row = $result_set->fetch_assoc()) {
        $array[] = $row;
    }

    $connexio->close();
    $result_set->close();
    return $array;
}

function imprimirFilesTabla($arrayFiles)
{
    foreach ($arrayFiles as $fila) {
        echo "<tr><td>{$fila["id"]}</td><td>{$fila["titol"]}</td><td>{$fila["nom_edit"]}</td>
        <td style='text-align: center;'><a href='editar.php?id={$fila["id"]}' class='btn btn-warning'>Editar</a></td></tr>";
    }
}

?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Tabla llibres</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    th:first-of-type {
        width: 140px;
    }

    thead {
        text-align: center;
    }


</style>

<body>
<div class="container">
    <div class="row text-center mt-4">
        <form method="get" action="index.php">
            <label style="vertical-align: middle"><input type="text" name="filtre"></label>
            <input type="submit" value="Filtrar" name="submit" class="btn btn-primary">
        </form>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID<a href="index.php?sentit=asc&ordre=id" class="btn <?php echo($_SESSION["selected"]=="idasc")?"btn-primary":"btn-secundary"?>" style="margin-left: 5px;">&#8593</a>
                <a href="index.php?sentit=desc&ordre=id" class="btn <?php echo($_SESSION["selected"]=="iddesc")?"btn-primary":"btn-secundary"?>">&#8595</a></th>

            <th>Titol<a href="index.php?sentit=asc&ordre=titol" class="btn <?php echo($_SESSION["selected"]=="titolasc")?"btn-primary":"btn-secundary"?>"
                        style="margin-left: 5px">&#8593</a>
                <a href="index.php?sentit=desc&ordre=titol" class="btn <?php echo($_SESSION["selected"]=="titoldesc")?"btn-primary":"btn-secundary"?>">&#8595</a></th>

            <th>Editorial<a href="index.php?sentit=asc&ordre=editor" class="btn <?php echo($_SESSION["selected"]=="editorasc")?"btn-primary":"btn-secundary"?>" style="margin-left: 5px">&#8593</a>
                <a href="index.php?sentit=desc&ordre=editor" class="btn <?php echo($_SESSION["selected"]=="editordesc")?"btn-primary":"btn-secundary"?>">&#8595</a></th>
            <th style="vertical-align: middle">Acció</th>

        </tr>
        </thead>
        <tbody>
        <?php imprimirFilesTabla($_SESSION["arrayFiles"]) ?>
        </tbody>
    </table>
</div>
</body>
</html>