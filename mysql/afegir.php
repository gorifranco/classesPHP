<?php
session_start();

$missatge = "";

if (isset($_POST["submit"])) {
    if (trim($_POST["nom_editor"]) == "") {
        $missatge = "<p style='color:red'>Nom no pot ser buit</p>";
    } else if (editorExisteix()) {
        $missatge = "<p style='color:red'>L'usuari ja existeix</p>";
    } else if(afegirEditor($_POST["nom_editor"])){
        $missatge = "<p style='color:green'>Usuari creat</p>";
    }else{
        $missatge = "<p style='color:red'>Error realitzant l'insert</p>";
    }
}

function editorExisteix()
{
    $_SESSION["connection"]->connect("localhost", "root", "1234", "biblioteca", 3306);
    $sql = "select * from editors where nom_edit = ?;";
    $statement = $_SESSION["connection"]->prepare($sql);
    $statement->bind_param("s", $_POST["nom_editor"]);
    $statement->execute();
    $result = $statement->get_result();
    $row_count = $result->num_rows;
    return ($row_count > 0);
}

function afegirEditor($nomEditor)
{
    try {
        $sql1 = "select max(id_edit) as maxid from editors;";
        $sql2 = 'insert into editors value (? ,? , null, null, null, null, null, null)';

        $row = $_SESSION["connection"]->query($sql1);

        $nouId = (($row->fetch_assoc())["maxid"]) + 1;

        $nomEditor = strip_tags($nomEditor);

        $statement = $_SESSION["connection"]->prepare($sql2);
        $statement->bind_param("is", $nouId, $nomEditor);

        $statement->execute();
        return true;
    } catch (Exception $ex) {
        return false;
    }
}

?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <title>Afegir actor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5 text-center pb-4">
    <div class="d-flex justify-content-center">
        <form action="#" method="post" class="p-4 border">
            <div><?= $missatge ?></div>
            <div class="form-group">
                <label for="authorName">NOM DE L'EDITOR</label>
                <input type="text" class="form-control" id="authorName" name="nom_editor">
            </div>
            <button name="submit" type="submit" class="btn btn-primary mt-3">Agregar</button>
        </form>
    </div>
</div>
<div class="text-center">
    <a href="prova1.php" style="padding-top: 10px;">Torna enrere</a>
</div>
</body>
</html>
