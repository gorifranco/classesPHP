<?php
require_once __DIR__ . "/../../vendor/autoload.php";

class DBConnection
{
    private static $instance=null;

    public static function getInstance()
    {
        if (!self::$instance) {
            $dotenv = Dotenv\Dotenv::createImmutable("../../");
            $dotenv->load();
            self::$instance = new mysqli();
              }
        self::connect();
        return self::$instance;
    }

    private static function connect(){
        self::$instance->connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_DATABASE'], intval($_ENV["DB_PORT"]));
    }
    private static function close(){
        self::$instance->close();
    }
    static function totalTuples($filtre)
    {
        try {
            $sql = "select count(*) as total from llibres
        right join editors on editors.id_edit = llibres.fk_idedit
        where id_llib like '%$filtre%' or titol like '%$filtre%' or nom_edit like '%$filtre%'";

            $prepared = self::getInstance()->prepare($sql);
            $prepared->execute();
            $result_set = $prepared->get_result();
            return ($result_set->fetch_assoc())["total"];
        } finally {
            self::close();
        }
    }



    static function treureLlibres($filtre, $ordre, $sentit, $limit, $offset)
    {
        try {
            $sql = "select id_llib as id, titol, nom_edit from llibres
        right join editors on editors.id_edit = llibres.fk_idedit
        where id_llib like '%$filtre%' or titol like '%$filtre%' or nom_edit like '%$filtre%' 
        order by $ordre $sentit limit $limit offset $offset";

            $prepared = self::getInstance()->prepare($sql);

            $prepared->execute();
            $result_set = $prepared->get_result();

            $array = array();

            while ($row = $result_set->fetch_assoc()) {
                $array[] = $row;
            }
            return $array;
        } finally {
            self::close();
        }
    }
    static function id_edit_where_nom_edit($nom_edit){
        try {
            $sql1 = "select id_edit from editors where nom_edit = '$nom_edit'";
            $result_set = self::getInstance()->query($sql1);
            $result = $result_set->fetch_assoc();
            return $result["id_edit"];
        } finally {
            self::close();
        }
    }

    static function updateLlibre($id_llib, $titol, $nom_editor, $departament, $lloc_edicio){
        try {
            $sql = "update llibres set titol=?, fk_idedit=?, fk_departament=?, llocedicio=? where id_llib = '$id_llib'";
            $prepared = self::getInstance()->prepare($sql);
            $prepared->bind_param("siss", $titol, $nom_editor, $departament, $lloc_edicio);
            return $prepared->execute();
        } finally {
            self::close();
        }
    }

    static function dadesLlibre($id_llib){
        try {
            $sql = "select id_llib as id, titol, nom_edit, fk_departament, llocedicio from llibres
            inner join editors on editors.id_edit = llibres.fk_idedit where id_llib = '$id_llib'";
            $prepared = self::getInstance()->prepare($sql);
            $prepared->execute();
            return ($prepared->get_result())->fetch_assoc();
        } finally {
            self::close();
        }
    }

    static function departments(){
        try {

            $sql = "select departament from departaments";
            $prepared = self::getInstance()->prepare($sql);
            $prepared->execute();
            $result_set = $prepared->get_result();

            $array = array();

            while ($row = $result_set->fetch_assoc()) {
                $array[] = $row;
            }
            return $array;
        } finally {
            self::close();
        }
    }

    static function editorials(){
        try {
            $sql = "select nom_edit as editor from editors";
            $prepared = self::getInstance()->prepare($sql);
            $prepared->execute();
            $result_set = $prepared->get_result();

            $array = array();

            while ($row = $result_set->fetch_assoc()) {
                $array[] = $row;
            }
            return $array;
        } finally {
            self::close();
        }
    }

    static function eliminarLlibre($id_llib){
        try {
            $sql = "delete from llibres where id_llib=$id_llib";
            return self::getInstance()->query($sql);
        } finally {
            self::close();
        }
    }
    static function ferConsulta($sql){
        $resultat = self::getInstance()->query($sql);
        self::close();
        return json_encode($resultat->fetch_all());
    }
}

