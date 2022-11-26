<?php

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

function keyValidation($key){
    $key_decoded = base64_decode($key);
    preg_match('/ \d /', $key_decoded, $assing);
    if(isset($assing[0])){
        if(intval($assing[0])==0){
            return 'Inicio';
        }
        if(intval($assing[0])==1){
            //Validad si el usuario de la api coincide con el de la api key. Tengo correo y nombre usuario.
            return 'Usuarios';
        }
        if(intval($assing[0])==2){
            //Lo mismo pero en el admin.
            return 'Administrador';
        }
    }else{
        echo json_encode(['error'=>401, 'error'=>'YOU DON`T USE API_KEY']);
    }
}

function antihackChained ($string){
    return strip_tags(htmlspecialchars($string));
}

?>