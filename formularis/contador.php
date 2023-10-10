<html>
<head>

</head>
<body>
<?php
$contador = 0;
if(isset($_POST["contador"])) {
    $contador = ++$_POST["contador"];
}
if ($contador == 0) {
    $frase = "No s'ha fet clic cap vegada.";
} else if ($contador == 1) {
    $frase = "S'ha fet clic una vegada.";
} else {
    $frase = "S'han fet clic ${contador} vegades.";
}
?>
<p id="frase"><?=$frase?></p>
<p><?=$contador?></p>
<form method="post" action="#">
        <input hidden="hidden" type="number" name="contador" value="<?=$contador?>"/>
    <input type="submit" name="boto" value="+1"/>
</form>
</body>
</html>


