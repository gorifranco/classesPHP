<?php
session_start();


if(isset($_POST["submitImg"])) {
$target_dir = "img/";
$target_file = $target_dir . strtolower($_POST["nameImg"]).".".strtolower(pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION));
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    }
    }
}
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        img{
            width: 25px;
        }
    </style>
</head>
<body>
<div class="container">
    <?php
    if (isset($_SESSION["mail"])) {
        echo "Uep, com va " . $_SESSION["mail"] . "?<br/>";
        echo "<a href='logout.php'>logout</a><br/>";
    } else {
        header("Location: login.php");
    }

    $productes = ["0000" => ["cireres", "gut shit", 5], "0001" => ["llom", "llom de trutja", 2], "0002" => ["colquers", "venenplens", 7],
        "0003" => ["curry", "Lo més bo de sa llista", 1], "0004" => ["pomes", "d'un pomer", 1.5]];

    $_SESSION["carrito"] = [];
    if (isset($_POST["submit"])) {
        foreach ($productes as $key => $producte) {
            if ($_POST[$key] > 0) {
                $_SESSION["carrito"][] = [$key, $_POST[$key]];
            }
        }
    }
    function treureValue($array, $key)
    {
        foreach ($array as $value) {
            if ($value[0] == $key) return $value[1];
        }
        return 0;
    }

    function treurePreu($arrayProd, $key)
    {
        foreach ($arrayProd as $k => $value) {
            if ($key == $k) {
                return $value[2];
            }
        }
        return 0;
    }

    function calcularTotal($arrayProd)
    {
        if (isset($_SESSION["carrito"])) {
            $total = 0;
            foreach ($_SESSION["carrito"] as $value) {
                $total += $value[1] * treurePreu($arrayProd, $value[0]);
            }
            return $total;
        }
        return 0;
    }

    function resolve($name) {
        // reads informations over the path
        $info = pathinfo($name);
        if (!empty($info['extension'])) {
            // if the file already contains an extension returns it
            return $name;
        }
        $filename = $info['filename'];
        $len = strlen($filename);
        // open the folder
        $dh = opendir($info['dirname']);
        if (!$dh) {
            return false;
        }
        // scan each file in the folder
        while (($file = readdir($dh)) !== false) {
            if (strncmp($file, $filename, $len) === 0) {
                if (strlen($name) > $len) {
                    // if name contains a directory part
                    $name = substr($name, 0, strlen($name) - $len) . $file;
                } else {
                    // if the name is at the path root
                    $name = $file;
                }
                closedir($dh);
                return $name;
            }
        }
        // file not found
        closedir($dh);
        return false;
    }

    ?>
</div>

<div class="container">
    <form method="post" action="#">
        <?php
        echo '<ul>';
        foreach ($productes as $key => $producte) {
            echo '<li><label>' . ucfirst($producte[0]) . ':';
            echo '<input type="number" value="' . treureValue($_SESSION["carrito"], $key). '" min="0" name="' . $key . '">';
            echo ' Descripció: ' . $producte[1] . ' ';
            echo ' Preu: ' . $producte[2];
            $file = resolve('./img/'.$producte[0]);
            if($file !== false){
                echo "img: ";
                echo '<img src="'.$file.'">';
            }
            echo "</label></li>";
        }
        echo 'total: ' . calcularTotal($productes);
        echo '</ul>';
        ?>
        <input type="submit" value="Enviar" name="submit">
    </form>
</div>

<div class="container">
    <form method="post" action="#" enctype="multipart/form-data">
        <div class="form-group">
            <label>Producte:
                <input type="text" value="" name="nameImg">
                <input type="file" name="file" value="">
            </label>
            <input type="submit" name="submitImg" value="Pujar" class="btn btn-primary">
        </div>
    </form>
</div>

</body>
</html>


