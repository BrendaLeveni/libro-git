<?php

require_once('app/modelo/user.model.php');
require_once('app/vista/libreria.view.php');
require_once('app/modelo/genero.model.php');

class UserController
{
    private $generoModel;
    private $userModel;
    private $view;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->view = new LibreriaView();
        $this->generoModel = new GeneroModel();
    }

    public function logout()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        session_destroy();
        header('Location: ' . LOGIN);
    }

    public function showLogin($mensaje = '')
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION["email"])) {
            header('Location: ' . HOME);
        } else {
            $generos = $this->generoModel->traerTodos();
            $this->view->mostrarLogin($mensaje, $generos);
        }
    }

    private function verificaUsuarioPass($userMail, $userPass)
    {
        $user = $this->userModel->getUsuario($userMail);

        if (!empty($user) && password_verify($userPass, $user->pass)) {
            session_start();
            $_SESSION['email'] = $user->email;
            $_SESSION['permisos'] = $user->administrador;
            $_SESSION['id_usuario'] = $user->id_usuario;

            return true;
        } else {
            return false;
        }
    }

    public function verificar()
    {
        $userMail = $_POST['email'];
        $userPass = $_POST['pass'];

        if ($this->verificaUsuarioPass($userMail, $userPass)) {
            header('Location:' . HOME);
        } else {
            $this->showLogin('Error de login');
        }
    }
    public function estaLogueado()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION['email'])) {
            return true;
        } else {
            return false;
        }
    }

    public function esAdmin()
    {
        if ($this->estaLogueado()) {
            if ($_SESSION['permisos']) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function registrar()
    {
        if (isset($_POST['email']) && isset($_POST['pass'])) {
            $userMail = $_POST['email'];
            $userPass = $_POST['pass'];
            $password = password_hash($userPass, PASSWORD_DEFAULT);
            $this->userModel->AgregarUsuario($userMail, $password);
            $respuesta = $this->verificaUsuarioPass($userMail, $userPass);
            if ($respuesta) {
                header('Location:' . HOME);
            } else {
                $this->showRegistro('Error al registrarte');
            }
        } else {
            $this->showRegistro('Rellene todos los campos');
        }
    }
    public function showRegistro($mensaje = '')
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (isset($_SESSION["email"])) {
            header('Location: ' . HOME);
        } else {
            $generos = $this->generoModel->traerTodos();
            $this->view->mostrarRegistro($mensaje, $generos);
        }
    }

    public function modificarPermisos()
    {
        if ($this->esAdmin()) {
            $usuario = $_POST['usuario'];
            $this->userModel->modificarPermisos($usuario);
            $this->listarUsuarios('Los permisos fueron modificados');
        } else {
            header('Location: ' . HOME);
        }
    }
    public function listarUsuarios($mensaje = '')
    {
        if ($this->esAdmin()) {
            $usuarios = $this->userModel->traerTodos();
            $generos = $this->generoModel->traerTodos();
            $this->view->mostrarUsuarios($mensaje, $generos, $usuarios);
        } else {
            header('Location: ' . HOME);
        }
    }

    public function eliminarUsuario($usuario)
    {
        if ($this->esAdmin()) {
            $this->userModel->eliminarUsuario($usuario);
            $this->listarUsuarios('El usuario fue eliminado');
        } else {
            header('Location: ' . HOME);
        }
    }
}
