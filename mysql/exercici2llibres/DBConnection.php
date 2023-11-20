<?php
require_once __DIR__ . "/../../vendor/autoload.php";

class DBConnection
{
    private $db_host;
    private $db_user;
    private $db_password;
    private $db_database;
    private $db_port;
    private $conn;


    public function __construct()
    {
        $dotenv = Dotenv\Dotenv::createImmutable("../../");
        $dotenv->load();
        $this->db_host = $_ENV['DB_HOST'];
        $this->db_database = $_ENV['DB_DATABASE'];
        $this->db_user = $_ENV['DB_USER'];
        $this->db_password = $_ENV['DB_PASSWORD'];
        $this->db_port = intval($_ENV["DB_PORT"]);

        $this->conn = new Mysqli($this->db_host, $this->db_user, $this->db_password, $this->db_database, $this->db_port);

        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
    static function totalTuples($filtre)
    {
        $dbcon = new DBConnection();
        $conn = $dbcon->getConnection();
        try {
            $sql = "select count(*) as total from llibres
        right join editors on editors.id_edit = llibres.fk_idedit
        where id_llib like '%$filtre%' or titol like '%$filtre%' or nom_edit like '%$filtre%'";

            $prepared = $conn->prepare($sql);
            $prepared->execute();
            $result_set = $prepared->get_result();
            return ($result_set->fetch_assoc())["total"];
        } finally {
            $dbcon->closeConnection();
        }
    }

    static function treureLlibres($filtre, $ordre, $sentit, $limit, $offset)
    {
        $dbcon = new DBConnection();
        $conn = $dbcon->getConnection();
        try {
            $sql = "select id_llib as id, titol, nom_edit from llibres
        right join editors on editors.id_edit = llibres.fk_idedit
        where id_llib like '%$filtre%' or titol like '%$filtre%' or nom_edit like '%$filtre%' 
        order by $ordre $sentit limit $limit offset $offset";

            $prepared = $conn->prepare($sql);

            $prepared->execute();
            $result_set = $prepared->get_result();

            $array = array();

            while ($row = $result_set->fetch_assoc()) {
                $array[] = $row;
            }
            return $array;
        } finally {
            $dbcon->closeConnection();
        }
    }
    static function id_edit_where_nom_edit($nom_edit){
        $dbcon = new DBConnection();
        $conn = $dbcon->getConnection();
        try {
            $sql1 = "select id_edit from editors where nom_edit = '$nom_edit'";
            $result_set = $conn->query($sql1);
            $result = $result_set->fetch_assoc();
            return $result["id_edit"];
        } finally {
            $dbcon->closeConnection();
        }
    }

    static function updateLlibre($id_llib, $titol, $nom_editor, $departament, $lloc_edicio){
        $dbcon = new DBConnection();
        $conn = $dbcon->getConnection();
        try {
            $sql = "update llibres set titol=?, fk_idedit=?, fk_departament=?, llocedicio=? where id_llib = '$id_llib'";
            $prepared = $conn->prepare($sql);
            $prepared->bind_param("siss", $titol, $nom_editor, $departament, $lloc_edicio);
            return $prepared->execute();
        } finally {
            $dbcon->closeConnection();
        }
    }

    static function dadesLlibre($id_llib){
        $dbcon = new DBConnection();
        $conn = $dbcon->getConnection();
        try {
            $sql = "select id_llib as id, titol, nom_edit, fk_departament, llocedicio from llibres
            inner join editors on editors.id_edit = llibres.fk_idedit where id_llib = '$id_llib'";
            $prepared = $conn->prepare($sql);
            $prepared->execute();
            return ($prepared->get_result())->fetch_assoc();
        } finally {
            $dbcon->closeConnection();
        }
    }

    static function departments(){
        $dbcon = new DBConnection();
        $conn = $dbcon->getConnection();
        try {

            $sql = "select departament from departaments";
            $prepared = $conn->prepare($sql);
            $prepared->execute();
            $result_set = $prepared->get_result();

            $array = array();

            while ($row = $result_set->fetch_assoc()) {
                $array[] = $row;
            }
            return $array;
        } finally {
            $dbcon->closeConnection();
        }
    }

    static function editorials(){
        $dbcon = new DBConnection();
        $conn = $dbcon->getConnection();
        try {
            $sql = "select nom_edit as editor from editors";
            $prepared = $conn->prepare($sql);
            $prepared->execute();
            $result_set = $prepared->get_result();

            $array = array();

            while ($row = $result_set->fetch_assoc()) {
                $array[] = $row;
            }
            return $array;
        } finally {
            $dbcon->closeConnection();
        }
    }

    static function eliminarLlibre($id_llib){
        $dbcon = new DBConnection();
        $conn = $dbcon->getConnection();
        try {
            $sql = "delete from llibres where id_llib=$id_llib";
            return $conn->query($sql);
        } finally {
            $dbcon->closeConnection();
        }
    }
}





















