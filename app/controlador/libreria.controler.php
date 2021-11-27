<?php
require_once('app/modelo/libro.model.php');
require_once('app/modelo/genero.model.php');
require_once('app/vista/libreria.view.php');
class LibreriaControler{

private $view;
private $generoModel;
private $libroModel;

public function __construct()
{
    $this->view=new LibreriaView();
    $this->generoModel=new GeneroModel();
    $this->libroModel=new LibroModel();
}


public function showInicio(){
    $generos = $this->generoModel->traerTodos();
    $this->view->showInicio($generos);
}

public function showGenero($id_genero){
    $genero = $this ->generoModel->traerUno($id_genero);
    $libros = $this ->libroModel->traerPorGenero($id_genero);
    $generos = $this->generoModel->traerTodos();
    $this ->view -> showGenero($generos,$genero,$libros);

}

public function showLibro($id_libro){
    $libro = $this->libroModel->traerUno($id_libro);
    $generos = $this->generoModel->traerTodos();
    $this -> view ->showLibro($generos,$libro);
}

public function showLibros(){
    $libros = $this ->libroModel->traerTodos();
    $generos = $this->generoModel->traerTodos();
    $this -> view ->showLibros($generos,$libros);

}

public function agregarLibro(){
$this->verificarSesion();
    $titulo = $_POST ["titulo"];
    $sinopsis = $_POST ["sinopsis"];
    $cantidad_paginas = $_POST ["cantidad_paginas"];
    $genero = $_POST ["id_genero"];
 
    $this->libroModel->agregarUnLibro($titulo,$sinopsis,$cantidad_paginas,$genero);
    header('Location:'. BASE_URL."libros" );
}

public function verificarSesion(){
    session_start();
    if(!isset ($_SESSION["email"])){
        header('Location:'. LOGIN );
        die;
    }
}
public function editarUnLibro($id_libro){
    $this->verificarSesion();
    $titulo = $_POST ["titulo"];
    $sinopsis = $_POST ["sinopsis"];
    $cantidad_paginas = $_POST ["cantidad_paginas"];
    $genero = $_POST ["genero"];
    $this->libroModel->editarLibro($id_libro,$titulo,$sinopsis,$cantidad_paginas,$genero);
    header('Location:'. BASE_URL."libros/$id_libro" );
}

public function borrarUnLibro($id_libro){
    $this->verificarSesion();
    $this->libroModel->eliminarLibro($id_libro);
    header('Location:'. BASE_URL."libros" );
}

public function agregarGenero(){
    $this->verificarSesion();
    $nombre = $_POST ["nombre"];
    $this->generoModel->agregarUngenero($nombre);
    header('Location:'. BASE_URL."generos" );
}

public function editarUnGenero($id_genero){
    $this->verificarSesion();
    $nombre = $_POST ["nombre"];
    $this->generoModel->editargenero($id_genero,$nombre);
    header('Location:'. BASE_URL."generos/$id_genero" );
}

public function borrarGenero($id_genero){
    $this->verificarSesion();
    $this->generoModel->eliminarGenero($id_genero);
    header('Location:'. BASE_URL."generos" );
}

}
