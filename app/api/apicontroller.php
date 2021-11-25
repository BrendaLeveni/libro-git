<?php

require_once('app/modelo/comentariomodel.php');
require_once('app/api/apiview.php');
require_once('app/controlador/userController.php');
require_once('app/modelo/libro.model.php');


class ApiController
{

    private $comentarioModel;
    private $apiView;
    private $libroModel;
    private $userController;
    private $data;

    public function __construct()
    {
        $this->apiView = new ApiView();
        $this->comentarioModel = new ComentarioModel();
        $this->libroModel = new LibroModel();
        $this->userController = new UserController();
        $this->data = file_get_contents("php://input");
    }
    private function getData()
    {

        return json_decode($this->data);
    }

    public function getComentarios($params = null)
    {
        if ($params && isset($params[':id_libro'])) {
            $comentario = $this->comentarioModel->obtenerComentarios($params[':id_libro']);
            if ($comentario) {
                $this->apiView->response($comentario, 200);
            } else {
                $libro = $this->libroModel->traerUno($params[':id_libro']);
                if ($libro) {
                    $this->apiView->response(false, 200);
                    //devuelvo  200 por que el libro existe pero no tiene comentarios.
                } else {
                    $this->apiView->response(false, 404);
                }
            }
        } else {
            $this->apiView->response(false, 404);
        }
    }

    public function postComentario($params = null)
    {
        $logueado = $this->userController->estaLogueado();
        if ($logueado) {
            if ($params && isset($params[':id_libro'])) {
                $id_usuario = $_SESSION['id_usuario'];
                $id_libro = $params[':id_libro'];
                $data = $this->getData();
                $comentario = $data->comentario;
                $puntaje = $data->puntaje;
                $data->id_usuario = $id_usuario;
                $data->id_libro = $id_libro;
                $data->fecha = new DateTime('now', new DateTimeZone('America/Buenos_Aires'));
                $data->id_comentario =  $this->comentarioModel->AgregarComentario($id_usuario, $id_libro, $comentario, $puntaje);
                $this->apiView->response($data, 201);
            } else {
                $this->apiView->response(false, 404);
            }
        } else {
            $this->apiView->response(false, 403);
        }
    }
    public function deleteComentario($params=null){
        $admin = $this ->userController->esAdmin();
        if($admin){
            if($params && isset($params[':id_comentario']) && isset($params[':id_libro'])){
                $resultado= $this ->comentarioModel->borrarComentario($params[':id_comentario']);
                if($resultado){
                $this->apiView->response(true,200);
                }
                else{
                    $this->apiView->response(false,404);
                }
            }
            else {
                $this->apiView->response(false, 404);
            }
        }
        else{
            $this->apiView->response(false, 403);
        }

    } 
}
