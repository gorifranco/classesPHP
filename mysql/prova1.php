<?php
session_start();

if(!isset($_SESSION["ordre"])) {
    $_SESSION["ordre"] = " order by id_edit";
    $_SESSION["as"] = " asc";
    $_SESSION["filter"] = "";
}

if(isset($_GET["ordre"])){
    $_SESSION["ordre"] = ' order by '.$_GET["ordre"];
}
if(isset($_GET["dir"])){
    $_SESSION["as"] = " ".$_GET["dir"];
}
if(isset($_GET["filter"])){
    $_SESSION["filter"] = " where (id_edit like '%{$_GET["filter"]}%' or nom_edit like '%{$_GET["filter"]}%')";
}
?>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<div class="container justify-content-center d-flex m-auto">
    <div class="text-center">
        <form method="get" action="#">
            <div  class="mt-3">
            <label>Filtre:
                <input name="filter" type="text">
                <input name="submit" type="submit" value="Filtrar" class="btn btn-primary">
            </label>
            </div>
        </form>
        <table class='table table-striped'>
            <caption>LLISTAT D'EDITORS</caption>
            <tr><th><a href="prova1.php?<?php if($_SESSION["ordre"] == " order by id_edit" && $_SESSION["as"] == " asc") echo "dir=desc";
                     else if ($_SESSION["ordre"] == " order by id_edit" && $_SESSION["as"] == " desc") echo "dir=asc";
                     else echo "ordre=id_edit&dir=asc";

                    ?>">ID</th><th><a href="prova1.php?<?php if($_SESSION["ordre"] == " order by nom_edit" && $_SESSION["as"] == " asc") echo "dir=desc";
                    else if ($_SESSION["ordre"] == " order by nom_edit" && $_SESSION["as"] == " desc") echo "dir=asc";
                    else echo "ordre=nom_edit&dir=asc";

                    ?>">NOM</a></th></tr>

<?php
$connection = new Mysqli();

$connection ->connect("localhost", "root", "", "biblioteca", 3306);



$sql = 'select id_edit, nom_edit from editors'.$_SESSION["filter"].$_SESSION["ordre"].$_SESSION["as"].';';

$cursor = $connection->query($sql) or die("fallo garrafal");


while ($row = $cursor->fetch_assoc()){
    echo '<tr><td>'.$row["id_edit"].'</td><td>'.$row["nom_edit"].'</td></tr>';
}
echo "</table>";
?>
</div>
</div>
