<?php
require_once("app/modelo/config.php");

class LibroModel
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
        $consulta = "SELECT * FROM libro";
        $consulta = $this->pdo->prepare($consulta);
        $consulta->execute();
        $respuesta = $consulta->fetchAll(PDO::FETCH_OBJ);
        return $respuesta;
    }

    public function traerUno($id){
        $consulta = "SELECT * FROM libro WHERE id_libro=?";
        $consulta = $this->pdo->prepare($consulta);
        $consulta->execute([$id]);
        $respuesta = $consulta->fetch(PDO::FETCH_OBJ);
        return $respuesta;
    }

    public function agregarUnLibro($titulo,$sinopsis,$cantidad_paginas,$genero){
        $consulta ="INSERT INTO libro (titulo,sinopsis,cant_pag,id_genero)
                    VALUES (?,?,?,?)";
        $consulta = $this->pdo->prepare($consulta);
        $consulta->execute([$titulo,$sinopsis,$cantidad_paginas,$genero]);
        return $consulta;
    }

    public function editarLibro($id,$titulo,$sinopsis,$cantidad_paginas,$genero){
        $consulta = "UPDATE libro
                     SET titulo=?,sinopsis=?,cant_pag=?,id_genero=? 
                     WHERE id_libro=?";
        $consulta = $this->pdo->prepare($consulta);
        $consulta->execute([$titulo,$sinopsis,$cantidad_paginas,$genero,$id]);
        return $consulta;
    }

    public function eliminarLibro($id){
        $consulta = "DELETE FROM libro 
                     WHERE id_libro=?";
        $consulta = $this->pdo->prepare($consulta);
        $consulta -> execute([$id]);
        return $consulta;         
    }

    public function traerPorGenero($id_genero){
        $consulta = "SELECT * FROM libro
                    WHERE id_genero =?";
                     $consulta = $this->pdo->prepare($consulta);
                     $consulta -> execute([$id_genero]);
                     $respuesta = $consulta->fetchAll(PDO::FETCH_OBJ);
                     return $respuesta;  

    }
    
}
