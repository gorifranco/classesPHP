<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
<div class="container">
    <br/>
    <div class="row">
        <h1 class="col-md-6 mx-auto display-4">Tabla amb Bootstrap</h1>
    </div>
    <br/>

    <?php

    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $dbname = "la_meva_botiga";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname, 3307);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT productes.id as id, productes.nom as nomProducte, productes.descripció as descripcio, preu, categories.nom as nomCategoria FROM productes
    inner join categories on categories.id = productes.categoria_id;";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='table table-striped'>";
        echo '<tr class="table-secondary"><td>Id</td><td>Nom del producte</td><td>Descripció</td><td>Preu</td><td>Categoria</td></tr>';
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo '<tr><td class="table-secondary">' . $row["id"] . '</td><td>' . $row["nomProducte"] . '
                </td><td>' . $row["descripcio"] . '</td><td>' . $row["preu"] . '</td><td>' . $row["nomCategoria"] . '</td></tr>';
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
</div>
</body>
</html>