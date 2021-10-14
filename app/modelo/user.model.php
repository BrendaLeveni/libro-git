<?php

require_once("app/modelo/config.php");

class UserModel {

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
    
    public function getUsuario($email) {
        
        $sql = "SELECT * FROM usuario WHERE email = ?";

        $stm = $this->pdo->prepare($sql);

        $stm->execute([$email]);

        $usuario = $stm->fetchAll(PDO::FETCH_OBJ);

        if (count($usuario) > 0) {
            return $usuario[0];    
        }
        
        return null;
    }   
    
}


