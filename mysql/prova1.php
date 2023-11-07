<?php
session_start();

if(!isset($_SESSION["ordre"])) {
    $_SESSION["ordre"] = " order by id_edit";
    $_SESSION["as"] = " asc";
    $_SESSION["filter"] = "";
    $_SESSION["limit"] =  10;
    $_SESSION["offset"] = 0;
}

if(isset($_GET["ordre"])){
    $_SESSION["ordre"] = ' order by '.$_GET["ordre"];
}
if(isset($_GET["dir"])){
    $_SESSION["as"] = " ".$_GET["dir"];
}
if(isset($_GET["filter"])){
    $_SESSION["filter"] = " where (id_edit like '%{$_GET["filter"]}%' or nom_edit like '%{$_GET["filter"]}%')";
    $_SESSION["offset"] = 0;
}
if(isset($_GET["pg"])){
    if($_GET["pg"] == "<<"){
        $_SESSION["offset"] = $_SESSION["offset"] - $_SESSION["limit"];
        if($_SESSION["offset"]<0) $_SESSION["offset"] = 0;
    }else if($_GET["pg"] == ">>"){
        $_SESSION["offset"] += $_SESSION["limit"];
    } else{
        $_SESSION["offset"] = ($_GET["pg"]-1) * $_SESSION["limit"];
    }
}

function paginacio(){
    if($_SESSION["offset"] == 0){
        return ["<<",1,2,3,">>"];
    }
    elseif ($_SESSION["offset"] == 10){
        return ["<<",1,2,3,">>"];
    }
    else if((int)$_SESSION["offset"] + (int)$_SESSION["limit"] > (int)$_SESSION["tuples"]){
        return ["<<",floor((int)$_SESSION["tuples"]/(int)$_SESSION["limit"])-2,floor((int)$_SESSION["tuples"]/$_SESSION["limit"])-1,floor((int)$_SESSION["tuples"]/(int)$_SESSION["limit"])];
    }else{
        return ["<<",floor((int)$_SESSION["offset"]/(int)$_SESSION["limit"]), floor((int)$_SESSION["offset"]/(int)$_SESSION["limit"])+1, floor((int)$_SESSION["offset"]/(int)$_SESSION["limit"])+2, ">>"];
    }
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
            <tr><th><a href="prova1.php?<?php if($_SESSION["ordre"] == " order by id_edit" && $_SESSION["as"] == " asc") echo "dir=desc";
                     else if ($_SESSION["ordre"] == " order by id_edit" && $_SESSION["as"] == " desc") echo "dir=asc";
                     else echo "ordre=id_edit&dir=asc";

                    ?>">ID</th><th><a href="prova1.php?<?php if($_SESSION["ordre"] == " order by nom_edit" && $_SESSION["as"] == " asc") echo "dir=desc";
                    else if ($_SESSION["ordre"] == " order by nom_edit" && $_SESSION["as"] == " desc") echo "dir=asc";
                    else echo "ordre=nom_edit&dir=asc";

                    ?>">NOM</a></th></tr>

<?php
$connection = new Mysqli();

$connection ->connect("localhost", "root", "1234", "biblioteca", 3306);

$count = 'select count(*) from editors'.$_SESSION["filter"].$_SESSION["ordre"].$_SESSION["as"].';';

$sql = 'select id_edit, nom_edit from editors'.$_SESSION["filter"].$_SESSION["ordre"].$_SESSION["as"]." limit ".$_SESSION["limit"]." offset ".$_SESSION["offset"].';';

$cursor = $connection->query($sql) or die("fallo garrafal");
$cursor2 = $connection->query($count) or die("fallo garrafal count");

$_SESSION["tuples"] = ($cursor2->fetch_all())[0][0];


while ($row = $cursor->fetch_assoc()){
    echo '<tr><td>'.$row["id_edit"].'</td><td>'.$row["nom_edit"].'</td></tr>';
}
echo "</table>";
$a = paginacio();
?>
            <div class="justify-content-center row">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php
                        foreach ($a as $item) {
                            echo '<li class="page-item"><a class="page-link" href="prova1.php?pg='.$item.'">'.$item.'</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
            </div>

</div>
</div>
