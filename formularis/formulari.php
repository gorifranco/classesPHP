<?PHP
$al = "style=\"\"";
if(isset($nom) && $nom == ''){
    $al = "style=\"border-color: red\"";
}
$nom = isset($_POST["NOM"])?$_POST["NOM"]:'';
$email = isset($_POST["EMAIL"])?$_POST["EMAIL"]:'';
$comentari = isset($_POST["COMENTARI"])?$_POST["COMENTARI"]:'';
$sexe = isset($_POST["SEXE"])?$_POST["SEXE"]:'';
// Espereram un array de Llenguatges
$llenguatges = isset($_POST["LLENGUATGES"])?$_POST["LLENGUATGES"]:[];
// Podem ara fer alguna acció amb les dades. Per exemple insertar-las a una base de dades
?>
<html>
   <head>
      <title>PHP Formularis</title>
   </head>
   <body>
      <h2>Exemple formulari</h2>
      
      <form method = "post" action = "formulari.php">
         <table>
            <tr>
               <td>Nom:</td> 
               <td><input type = "text" name = "NOM" value="<?=$nom?>" <?=$al?>></td>
            </tr>
            
            <tr>
               <td>E-mail:</td>
               <td><input type = "text" name = "EMAIL" value="<?=$email?>"></td>
            </tr>
            
            <tr>
               <td>Comentari:</td>
               <td><textarea name = "COMENTARI" rows = "5" cols = "40"><?=$comentari?></textarea></td>
            </tr>
            
            <tr>
               <td>Sexe:</td>
               <td>
                  <input type = "radio" name = "SEXE" value = "HOME" <?php if($sexe == "HOME") echo "checked"?>>Home
                  <input type = "radio" name = "SEXE" value = "DONA" <?php if($sexe == "DONA") echo "checked"?>>Dona
               </td>
            </tr>
            <tr>
               <td>Cicle:</td>
                <td>
                  <select name="CICLE">
                     <option value=""></option>
                      <option value="MUL">Multiplataforma</option>
                      <option value="WEB">Web</option>
                      <option value="SIS">Sistemes</option>
                  </select> 
                </td>
            </tr>
            <tr>
               <td>Llenguatges:</td>
                <td>
                  <select name="LLENGUATGES[ ]" multiple="multiple">
                      <option value="csharp" <?php if(in_array("csharp", $llenguatges)) echo "selected"?>>C#</option>
                      <option value="jscript" <?php if(in_array("jscript", $llenguatges)) echo "selected"?>>JavaScript</option>
                      <option value="java" <?php if(in_array("java", $llenguatges)) echo "selected"?>>Java</option>
                      <option value="php" <?php if(in_array("php", $llenguatges)) echo "selected"?>>PHP</option>
                  </select> 
                </td>
            </tr>
            
            <tr>
               <td>
                  <input type = "submit" name = "BOTOENVIAR" value = "Enviar">
               </td>
            </tr>
         </table>
      </form>

   <?php
echo 'GET<hr/>';
if (isset($_POST["NOM"])){
    echo "NOM: ".$_POST['NOM'];
}else{
    echo "NOM: no hi ha ningu";
}
echo "<br>";

if (!isset($_POST["EMAIL"]) || $_POST["EMAIL"] == ""){
    echo "EMAIL: no hi ha ningu";
}else{
    echo "EMAIL: ".$_POST['EMAIL'];
}
echo "<br>";

if (!isset($_POST["COMENTARI"]) || $_POST["COMENTARI"] == ""){
    echo "COMENTARI: no hi ha ningu";
}else{
    echo "COMENTARI: ".$_POST['COMENTARI'];
}
echo "<br>";

if (!isset($_POST["SEXE"]) || $_POST["SEXE"] == ""){
    echo "SEXE: no hi ha ningu";
}else{
    echo "SEXE: ".$_POST['SEXE'];
}
echo "<br>";

if (!isset($_POST["CICLE"]) || $_POST["CICLE"] == ""){
    echo "CICLE: no hi ha ningu";
}else{
    echo "CICLE: ".$_POST['CICLE'];
}
echo "<br>";

if (!isset($_POST["LLENGUATGES"]) || $_POST["LLENGUATGES"] == ""){
    echo "LLENGUATGES: no hi ha ningu";
}else{
    echo "LLENGUATGES:";
    foreach ($_POST["LLENGUATGES"] as $item => $ss)
    echo "<br>$item: $ss";
}
?>

   </body>
</html>