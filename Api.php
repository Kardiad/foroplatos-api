<?php
ini_set('default_charset', 'utf-8');
error_reporting(E_ALL);
//En este encontramos el que hará frente a la petición.
require_once __DIR__."/Config/bootstrap.php";
require_once HELPERS."/Helpers.php";
$controllers = null;
$existe = false;
if(isset($_SERVER['PATH_INFO'])){
    $uri = parse_url($_SERVER['PATH_INFO'], PHP_URL_PATH);
    $uri = explode('/', $uri);
    $reqMeth = strtolower($_SERVER['REQUEST_METHOD']);
    unset($uri[0]);
    $controllers = glob(CONTROLLERS.'/Api/*.php');
    
    /**
     * crear root;
     */

    model('Admin')->insert('master_chief', ['pepe', 'pepe', 'Admin']);
}

//Carga controladores Api
$api_default = null;
if(isset($_REQUEST['api_key'])){
    $api_default = $_REQUEST['api_key'];
}
$user = null;
if(isset($uri[3])){
    $user = $uri[3];
}
if($controllers!=null){
    foreach($controllers as $contro){
        $controlerName = str_replace('.php', '', explode(DIRECTORY_SEPARATOR, $contro)[7]);
        if($controlerName === $uri[1]){
            $existe = true;
            require_once $contro;
            if(class_exists($controlerName)){
                $class = new $controlerName();
                $method =  $reqMeth.'_'.$uri[2];
                if(method_exists($class, $method) && is_callable($controlerName, $method)){
                    if($api_default==null || (new Cifrado())->descifrar($api_default, $uri[1])!=''){
                        $class->getParams();
                        $class->setUriSegments($uri);
                        $class->$method();
                    }else{
                        echo json_encode(['status'=>403, 'error'=>'YOU DON`T HAVE PERMISSION']);
                    }
                }else{
                    echo json_encode([
                        'status' => 500,
                        'message' => 'INTERNAL ERROR APP'
                    ]);
                }
            }
        }
    }
}
if(!$existe){
    echo json_encode([
        'status' => 400,
        'message' => 'NOT FOUND'
    ]);
}
?>