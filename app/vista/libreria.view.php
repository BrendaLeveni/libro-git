<?php
require_once('libs/Smarty.class.php');
class LibreriaView{

 private $smarty;

 public function __construct()
 {
     $this->smarty=new Smarty();
     $this->smarty->assign("admin",$this->esAdmin());

 }

 public function showInicio($generos){
    $this->smarty->assign('generos',$generos);
    $this->smarty->assign('BASE_URL', BASE_URL);
    $this->smarty->assign('email', $this->getActiveEmail());
    $this->smarty->display("templates/home.tpl");
}

private function esAdmin(){
    if (!isset($_SESSION)){
        session_start();
    }
    if (isset($_SESSION['permisos']) && $_SESSION['permisos']) {
        return true;
    } else {
        return false;
    }
} 



private function getActiveEmail(){
    if (!isset($_SESSION)){
        session_start();
    }
    if(isset($_SESSION['email']))
        $email = $_SESSION['email'];
    else{
        $email = null;
    }
    
    return $email;
    
    
}

public function mostrarLogin($mensaje = '',$generos) {
    $this->smarty->assign('generos', $generos);
    $this->smarty->assign('titulo','Inicie sesion');
    $this->smarty->assign('BASE_URL', BASE_URL);
    $this->smarty->assign('mensaje', $mensaje);
    $this->smarty->assign('email', $this->getActiveEmail());
    $this->smarty->display('templates/login.tpl');

}

public function showGenero($generos,$genero,$libros){
    $this->smarty->assign('generos', $generos);
    $this->smarty->assign('genero', $genero);
    $this->smarty->assign('libros', $libros);
    $this->smarty->assign('email', $this->getActiveEmail());
    $this->smarty->assign('BASE_URL', BASE_URL);
    $this->smarty->display('templates/genero.tpl');
}

public function showLibro($generos,$libro){
    $this->smarty->assign('generos', $generos);
    $this->smarty->assign('libro', $libro);
    $this->smarty->assign('email', $this->getActiveEmail());
    $this->smarty->assign('BASE_URL', BASE_URL);
    $this->smarty->display('templates/libro.tpl');

}
public function showLibros($generos,$libros){
    $this->smarty->assign('generos', $generos);
    $this->smarty->assign('libros', $libros);
    $this->smarty->assign('email', $this->getActiveEmail());
    $this->smarty->assign('BASE_URL', BASE_URL);
    $this->smarty->display('templates/libros.tpl');
}

public function mostrarRegistro($mensaje = '',$generos) {
    $this->smarty->assign('generos', $generos);
    $this->smarty->assign('titulo','Registrarse');
    $this->smarty->assign('BASE_URL', BASE_URL);
    $this->smarty->assign('mensaje', $mensaje);
    $this->smarty->assign('email', $this->getActiveEmail());
    $this->smarty->display('templates/registro.tpl');

}
public function mostrarUsuarios($mensaje = '',$generos, $usuarios) {
    $this->smarty->assign('generos', $generos);
    $this->smarty->assign('usuarios', $usuarios);
    $this->smarty->assign('titulo','Registrarse');
    $this->smarty->assign('BASE_URL', BASE_URL);
    $this->smarty->assign('mensaje', $mensaje);
    $this->smarty->assign('email', $this->getActiveEmail());
    $this->smarty->display('templates/usuario.tpl');
}

}