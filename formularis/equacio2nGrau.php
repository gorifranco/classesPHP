<?php
$frase = "";
if(isset($_POST["a"]) && isset($_POST["b"]) && isset($_POST["c"])){
    $a =$_POST["a"];
    $b = $_POST["b"];
    $c = $_POST["c"];
    if(($b*$b-4*$a*$c)<0 || $a == 0){
        $frase = "No es pot resoldre";
    }
    $resultat1 = (-$_POST + sqrt($b*$b-4*$a*$c))/2*$a;
}

?>
<html>
<head>

</head>
<body>

</body>
<form action="#" method="post">
    <label> a:
        <input type="number" name="a">
    </label>
    <label>b:
        <input type="number" name="b">
    </label>
    <label>c:
        <input type="number" name="c">
    </label>
    <input type="submit">
    <label>Resultat:
        <output name="resultat"><?=$frase?></output>
    </label>
</form>
</html>
