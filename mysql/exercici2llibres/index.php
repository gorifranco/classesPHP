<?php
session_start();

require_once __DIR__ . "/DBConnection.php";

$_SESSION["selected"] = (isset($_GET["sentit"])) ? $_GET["ordre"] . $_GET["sentit"] : "idasc";
$_SESSION["sentit"] = (isset($_GET["sentit"])) ? $_GET["sentit"] : "asc";
$_SESSION["ordre"] = (isset($_GET["ordre"])) ? $_GET["ordre"] : "id";
$_SESSION["limit"] = 10;
if (!isset($_SESSION["offset"])) $_SESSION["offset"] = 0;
if (isset($_GET["pg"])) {
    if ($_GET["pg"] == "darrera") {
        $_SESSION["offset"] = floor($_SESSION["totalTuples"] / $_SESSION["limit"]) * $_SESSION["limit"];
    } else {
        $_SESSION["offset"] = ($_GET["pg"] - 1) * $_SESSION["limit"];
    }
}

if (isset($_GET["ordre"]) && $_GET["ordre"] == "editor") $_SESSION["ordre"] = "nom_edit";
if (isset($_SESSION["filtre"])) {
    if (isset($_GET["filtre"])) {
        $_SESSION["filtre"] = $_GET["filtre"];
        $_SESSION["offset"] = 0;
    }
} else {
    $_SESSION["filtre"] = "";
}

$_SESSION["totalTuples"] = DBConnection::totalTuples($_SESSION["filtre"]);
$_SESSION["arrayFiles"] = DBConnection::treureLlibres($_SESSION["filtre"], $_SESSION["ordre"], $_SESSION["sentit"], $_SESSION["limit"], $_SESSION["offset"]);

function imprimirFilesTabla($arrayFiles)
{
    foreach ($arrayFiles as $fila) {
        echo "<tr><td>{$fila["id"]}</td><td>{$fila["titol"]}</td><td>{$fila["nom_edit"]}</td>
        <td style='text-align: center;'><a href='editar.php?id={$fila["id"]}' class='btn btn-warning'>Editar</a></td></tr>";
    }
}

function imprimirPaginacio()
{
    if ($_SESSION["offset"] == 0 || $_SESSION["offset"] == $_SESSION["limit"]) {
        $valors = [1, 2, 3];
    } else if ($_SESSION["offset"] >= $_SESSION["totalTuples"] - (2 * $_SESSION["limit"])) {
        $valors = [ceil($_SESSION["totalTuples"] / $_SESSION["limit"]) - 2, ceil($_SESSION["totalTuples"] / $_SESSION["limit"]) - 1, ceil($_SESSION["totalTuples"] / $_SESSION["limit"])];
    } else {
        $valors = [$_SESSION["offset"] / $_SESSION["limit"], $_SESSION["offset"] / $_SESSION["limit"] + 1, $_SESSION["offset"] / $_SESSION["limit"] + 2];
    }

    echo "<li class=page-item><a class=page-link href=index.php?pg=1 aria-label='first page' style='vertical-align: middle'>&laquo;</a></li>";
    echo "<li class=page-item><a class=page-link href=index.php?pg={$valors[0]} aria-label='first page' style='vertical-align: middle'>{$valors[0]}</a></li>";
    echo "<li class=page-item><a class=page-link href=index.php?pg={$valors[1]} aria-label='first page' style='vertical-align: middle'>{$valors[1]}</a></li>";
    echo "<li class=page-item><a class=page-link href=index.php?pg={$valors[2]} aria-label='first page' style='vertical-align: middle'>{$valors[2]}</a></li>";
    echo "<li class=page-item><a class=page-link href=index.php?pg=darrera aria-label='first page' style='vertical-align: middle'>&raquo;</a></li>";

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
            <th>ID<a href="index.php?sentit=asc&ordre=id"
                     class="btn <?php echo ($_SESSION["selected"] == "idasc") ? "btn-primary" : "btn-secundary" ?>"
                     style="margin-left: 5px;">&#8593</a>
                <a href="index.php?sentit=desc&ordre=id"
                   class="btn <?php echo ($_SESSION["selected"] == "iddesc") ? "btn-primary" : "btn-secundary" ?>">&#8595</a>
            </th>

            <th>Titol<a href="index.php?sentit=asc&ordre=titol"
                        class="btn <?php echo ($_SESSION["selected"] == "titolasc") ? "btn-primary" : "btn-secundary" ?>"
                        style="margin-left: 5px">&#8593</a>
                <a href="index.php?sentit=desc&ordre=titol"
                   class="btn <?php echo ($_SESSION["selected"] == "titoldesc") ? "btn-primary" : "btn-secundary" ?>">&#8595</a>
            </th>

            <th>Editorial<a href="index.php?sentit=asc&ordre=editor"
                            class="btn <?php echo ($_SESSION["selected"] == "editorasc") ? "btn-primary" : "btn-secundary" ?>"
                            style="margin-left: 5px">&#8593</a>
                <a href="index.php?sentit=desc&ordre=editor"
                   class="btn <?php echo ($_SESSION["selected"] == "editordesc") ? "btn-primary" : "btn-secundary" ?>">&#8595</a>
            </th>
            <th style="vertical-align: middle">Acció</th>
        </tr>
        </thead>
        <tbody>
        <?php imprimirFilesTabla($_SESSION["arrayFiles"]) ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php imprimirPaginacio() ?>
        </ul>
    </nav>
</div>
</body>
</html>