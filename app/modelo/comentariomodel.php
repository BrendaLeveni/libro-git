<?php
require_once("app/modelo/config.php");
class ComentarioModel
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = $this->conectar();
    }

    private function conectar()
    {
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

    public function AgregarComentario($id_usuario, $id_libro, $comentario, $puntaje)
    {
        $consulta = "INSERT INTO comentario (id_usuario,id_libro,comentario,puntaje,fecha)
                    VALUES (?,?,?,?,?)";
        $consulta = $this->pdo->prepare($consulta);
        $fecha = new DateTime('now', new DateTimeZone('America/Buenos_Aires'));
        $consulta->execute([$id_usuario, $id_libro, $comentario, $puntaje, $fecha->format('Y-m-d H:i:s')]);
        return $this->pdo->lastInsertId();
    }

    public function obtenerComentarios($id_libro)
    {
        $consulta = "SELECT * FROM comentario WHERE id_libro=?";
        $consulta = $this->pdo->prepare($consulta);
        $consulta->execute([$id_libro]);
        $respuesta = $consulta->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }

    public function borrarComentario($id_comentario)
    {
        $consulta = "DELETE FROM comentario
        WHERE id_comentario=?";
        $consulta = $this->pdo->prepare($consulta);
        $consulta->execute([$id_comentario]);
        return $consulta;
    }


    
}

