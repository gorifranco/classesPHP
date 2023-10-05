<?php

$alumnes= array ("1122"=>

    array("nom"=>"Pep",

        "telefons"=>array("971223344"," 666778877"),

        "grup"=>"S1X",

        "dir"=>array("carrer"=>"Nou","Num"=>12,"CP"=>"07300","Poblacio"=>"Inca"),

        "notes"=>array("client"=>7,"seridor"=>8,"disseny"=>5,"desplegament"=>7)

    ),

    "1192"=>

        array("nom"=>"Joan",

            "telefons"=>array("699775544"),

            "grup"=>"S1G",

            "dir"=>array("carrer"=>"Major","Num"=>1,"CP"=>"07440","Poblacio"=>"Muro"),

            "notes"=>array("client"=>6,"seridor"=>5,"disseny"=>5)

        ),

    "1982"=>

        array("nom"=>"Miquel",

            "telefons"=>array("971889977","666000077"),

            "grup"=>"S1X",

            "dir"=>array("carrer"=>"Sa plasa","Num"=>6,"CP"=>"07300","Poblacio"=>"Inca"),

            "notes"=>array("client"=>9,"seridor"=>10,"disseny"=>8,"desplegament"=>6)

        )

);

echo "<br>".$alumnes["1122"]["grup"];
echo "<br> telefons: ";
foreach ($alumnes["1982"]["telefons"] as $tf){
    echo "<br>".$tf;
}
echo "<br>";
foreach ($alumnes as $i =>$al){
    echo "<br>Codi: ".$i." Nom: ".$al["nom"]." Grup: ".$al["grup"];
}