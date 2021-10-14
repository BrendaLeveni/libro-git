<?php
require_once("app/modelo/config.php");
class GeneroModel
{

    private $pdo;

    public function __construct(){
        $this->pdo = $this->conectar();
    }

    private function conectar() {
        global $parametros;

        $host = $parametros['host'];
        $port = $parametros['port'];;
        $db = $parametros['db'];
        $user = $parametros['user'];
        $password = $parametros['password'];

        $dsn = "mysql:host=$host:$port;dbname=$db;charset=UTF8";

        try {
            $conectar = new PDO($dsn, $user, $password);
            return $conectar;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }

    }


    public function traerTodos()
    {
        $consulta = "SELECT * FROM genero";
        $consulta = $this->pdo->prepare($consulta);
        $consulta->execute();
        $respuesta = $consulta->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }

    public function traerUno($id){
        $consulta = "SELECT * FROM genero WHERE id_genero=?";
        $consulta = $this->pdo->prepare($consulta);
        $consulta->execute([$id]);
        $respuesta = $consulta->fetch(PDO::FETCH_OBJ);
        return $respuesta;
    }

    public function agregarUngenero($nombre){
        $consulta ="INSERT INTO genero (nombre)
                    VALUES (?)";
        $consulta = $this->pdo->prepare($consulta);
        $consulta->execute([$nombre]);//tener en cuenta como estan los parametros
        return $consulta;
    }

    public function editargenero($id,$nombre){
        $consulta = "UPDATE genero
                     SET nombre=? 
                     WHERE id_genero=?";
        $consulta = $this->pdo->prepare($consulta);
        $consulta->execute([$nombre,$id]);
        return $consulta;
    }

    public function eliminarGenero($id){
        $consulta = "DELETE FROM genero 
                     WHERE id_genero=?";
        $consulta = $this->pdo->prepare($consulta);
        $consulta -> execute([$id]);
        return $consulta;         
    }
    
}