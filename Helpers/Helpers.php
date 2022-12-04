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

function antihackChained ($string){
    return strip_tags(htmlspecialchars($string));
}

class Cifrado {
    protected array $pass = [
        'User' => 'Permission level 1',
        'Admin'=>'Permission level 2 '
    ];
    protected String $method = 'aes-256-ctr';
    protected array $iv=[
        'User'=>'UserUserUserssss',
        'Admin'=>'AdminAdminAdmins',
    ];

    public function cifrar($string, $tipo){
        $tipo==='Usuarios'?$tipo='User':$tipo='Admin';
        return base64_encode(openssl_encrypt($string, $this->method, $this->pass[$tipo], OPENSSL_RAW_DATA, $this->iv[$tipo]));
    }

    public function descifrar($string, $tipo){
        $tipo==='Usuarios'?$tipo='User':$tipo='Admin';
        return openssl_decrypt(base64_decode($string), $this->method, $this->pass[$tipo], OPENSSL_RAW_DATA, $this->iv[$tipo]);
    }

    
}

?>