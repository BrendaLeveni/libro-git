<?php
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');
define('HOME', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/home');
define('LOGIN', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/login');


require_once('app/controlador/userController.php');
require_once('app/controlador/libreria.controler.php');


$userController = new UserController();
$libreriaControler = new LibreriaControler();


if (!empty($_GET['action'])) {
    $accion = $_GET['action'];
} else {
    $accion = 'home';
}

$params = explode('/', $accion);

switch ($params[0]) {
    case 'login':
        $userController->showLogin();
        break;
    case 'logout':
        $userController->logout();
        break;
    case 'verificar':
        $userController->verificar();
        break;
    case 'home':
        $libreriaControler->showInicio();
        break;
    case 'generos':
        if (!isset($params[1])) {
            $libreriaControler->showInicio();
        } else {
            if (!isset($params[2])) {
                $libreriaControler->showGenero($params[1]);
            } else {
                if ($params[2] == "editar") {
                    $libreriaControler->editarUnGenero($params[1]);
                } else {
                    $libreriaControler->borrarGenero($params[1]);
                }
            }
        }
        break;
    case 'libros':
        if (!isset($params[1])) {
            $libreriaControler->showLibros();
        } else {
            if (!isset($params[2])) {
                $libreriaControler->showLibro($params[1]);
            } else {
                if ($params[2] == "editar") {
                    $libreriaControler->editarUnLibro($params[1]);
                } else {
                    $libreriaControler->borrarUnLibro($params[1]);
                }
            }
        }
        break;
    case 'agregarLibro':
        $libreriaControler->agregarLibro();

        break;
    case 'agregarGenero':
        $libreriaControler->agregarGenero();
        break;
    default:
        echo ('404 page not found');
        break;
}
