<?php

//Este lo que hace es tener las variables de entorno útiles.s

define('CONTROLLERS', ROOT_PATH.'/Controller');
define('MODELS', ROOT_PATH.'/Models');
define('PUBLIC', ROOT_PATH.'/Public');
define('VIEWS', ROOT_PATH.'/Views');
define('HTTP', $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'foroplatos');

function model($nombre){
    $url = MODELS.'/'.$nombre.'Model.php';
    if(file_exists($url)){
        require_once $url;
        $className = $nombre.'Model';
        if(class_exists($className)){
            $class = new $className;
            return $class;
        }else{
            echo json_encode(['status'=>500, 'message'=>'INTERNAL ERROR MODEL']);
        }
    }else{
        echo json_encode(['status'=>400, 'message'=>'NOT FOUND']);
    }
}
?>