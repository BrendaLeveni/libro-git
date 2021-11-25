<?php

class ApiView{

    private $status;

    function __construct(){
       
        $this->status = array (
            200 => "OK",
            201 => "Created",
            403 => "Forbidden",
            404 => "Not Found",
            500 => "Internal Server Error"
        );
        
    }

    function response($data,$code){

        header("Content-Type: application/json");
        header("HTTP/1.1 " . $code . " " . $this->requestStatus($code));
        echo json_encode($data);

    }

    private function requestStatus($code){
        try{
            $state = $this->status[$code];
        } catch (Exception $e){
            $state = $this->status[500];
        }
        return $state;
    }

}