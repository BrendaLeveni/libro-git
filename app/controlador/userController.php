<?php

require_once('app/modelo/user.model.php');
require_once('app/vista/libreria.view.php');
require_once('app/modelo/genero.model.php');

class UserController{
    private $generoModel;
    private $userModel;
    private $view;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->view = new LibreriaView();
        $this->generoModel = new GeneroModel();
    }

    public function logout() {
        if (!isset($_SESSION)){
			session_start();
		}
        session_destroy();
        header('Location: '.LOGIN);
    }

    public function showLogin($mensaje = '') {
        if (!isset($_SESSION)){
			session_start();
		}
        if(isset($_SESSION["email"])){
            header('Location: '. HOME);
        }else {
            $generos=$this->generoModel->traerTodos();
            $this->view->mostrarLogin($mensaje, $generos);
        }
    }

    private function verificaUsuarioPass($userMail, $userPass){

        $user = $this->userModel->getUsuario($userMail);

        if (!empty($user) && password_verify($userPass, $user->pass))
        {
            session_start();
            $_SESSION['email'] = $user->email;

            return true;
        } else {
            return false;
        }
    }

    public function verificar() { 

        $userMail = $_POST['email'];
        $userPass = $_POST['pass'];

        if ($this->verificaUsuarioPass($userMail, $userPass))
        {
            header('Location:'. HOME );
        } else 
        {
            $this->showLogin('Error de login');
        }

    }

    
}