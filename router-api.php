<?php

require_once ('libs/router.php');
require_once('app/api/apicontroller.php');



$router = new Router();


$router->addRoute('comentario/:id_libro', 'GET', 'ApiController', 'getComentarios');
$router->addRoute('comentario/:id_libro', 'POST', 'ApiController', 'postComentario');
$router->addRoute('comentario/:id_libro/:id_comentario', 'DELETE', 'ApiController', 'deleteComentario');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);




