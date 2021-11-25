<?php

require_once("app/modelo/config.php");

class UserModel
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

    public function getUsuario($email)
    {

        $sql = "SELECT * FROM usuario WHERE email = ?";

        $stm = $this->pdo->prepare($sql);

        $stm->execute([$email]);

        $usuario = $stm->fetchAll(PDO::FETCH_OBJ);

        if (count($usuario) > 0) {
            return $usuario[0];
        }

        return null;
    }
    public function traerTodos(){
        $consulta = "SELECT * FROM usuario";
        $consulta = $this->pdo->prepare($consulta);
        $consulta->execute();
        $respuesta = $consulta->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }

    public function AgregarUsuario($email, $pass)
    {
        $consulta = "INSERT INTO  usuario (email,pass, administrador)
        VALUES (?,?,?)";
        $consulta = $this->pdo->prepare($consulta);
        $consulta->execute([$email, $pass, false]);
        return $consulta;
    }

    public function modificarPermisos($id_usuario)
    {
        if ($this->esAdmin($id_usuario)) {
            $consulta =   "UPDATE usuario SET administrador=? WHERE id_usuario=?";
            $consulta = $this->pdo->prepare($consulta);
            $consulta->execute([false, $id_usuario]);
            return $consulta;
        } else {
            $consulta =   "UPDATE usuario SET administrador=? WHERE id_usuario=?";
            $consulta = $this->pdo->prepare($consulta);
            $consulta->execute([true, $id_usuario]);
            return $consulta;
        }
    }
    public function esAdmin($id_usuario)
    {
        $consulta = "SELECT administrador FROM usuario WHERE id_usuario=?";
        $consulta = $this->pdo->prepare($consulta);
        $consulta->execute([$id_usuario]);
        $respuesta = $consulta->fetch(PDO::FETCH_OBJ);
        return $respuesta->administrador;
    }
    public function eliminarUsuario($id_usuario)
    {
        $consulta = "DELETE FROM usuario
        WHERE id_usuario=?";
        $consulta = $this->pdo->prepare($consulta);
        $consulta->execute([$id_usuario]);
        return $consulta;
    }
}
