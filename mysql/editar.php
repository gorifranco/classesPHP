<?php
session_start();

$_SESSION["connection"]->connect("localhost", "root", "1234", "biblioteca", 3306);
$missatge = "";
$nomEditor = "";
if(preg_match("/\d+/", $_GET["id"])){
    $nomEditor = treureNomEditor();
}else{
    $nomEditor = "<span style='color:red;'>EDITOR INCORRECTE</span>";
}


function treureNomEditor()
{

        $sql = "select * from editors where id_edit = ?;";
        $statement = $_SESSION["connection"]->prepare($sql);
        $statement->bind_param("i", $_GET["id"]);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result -> fetch_assoc();
        if($row == null){
            return "<span style='color:red;'>EDITOR INCORRECTE</span>";
        }
        return ($row["NOM_EDIT"]);
}

?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Editar editor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<div class="container mt-5 text-center pb-4">
    <div class="d-flex justify-content-center">
        <form action="#" method="post" class="p-4 border">
            <div class="form-group">
                <label for="authorName">EDITOR: <?=$nomEditor?></label>
                <input type="text" class="form-control" id="authorName" name="nom_editor">
            </div>
            <div class="container mt-5">
                <div class="d-flex flex-row justify-content-center">
                    <div class="col-6 text-center">
                        <button name="submit" type="submit" class="btn btn-primary m-2">Editar</button>
                        <button name="borrar" type="submit" class="btn btn-danger m-2">Eliminar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>
