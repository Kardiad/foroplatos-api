<?php
//En este encontramos el que hará frente a la petición.
require_once __DIR__."/Config/bootstrap.php";
$uri = parse_url($_SERVER['PATH_INFO'], PHP_URL_PATH);
$uri = explode('/', $uri);
$reqMeth = strtolower($_SERVER['REQUEST_METHOD']);
unset($uri[0]);
$controllers = glob(CONTROLLERS.'/Api/*.php');
$existe = false;
/**
 * crear root;
 */
model('Admin')->master_chief();
/*echo '<pre>';
print_r($uri);
echo '</pre>';*/
//Carga controladores Api
$api_default = base64_encode('Permission Level 1 ');
if(isset($_REQUEST['api_key'])){
    $api_default = $_REQUEST['api_key'];
}
foreach($controllers as $contro){
    $controlerName = str_replace('.php','', explode('/', $contro)[6]);
    if($controlerName === $uri[1]){
        $existe = true;
        require_once $contro;
        if(class_exists($controlerName)){
            $class = new $controlerName();
            $method =  $reqMeth.'_'.$uri[2];
            if(method_exists($class, $method) && is_callable($controlerName, $method)){
                if($class->clasificateByKey($api_default)===$uri[1]){
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
//Pdte de implementar la view en Public
if(!$existe){
    echo json_encode([
        'status' => 400,
        'message' => 'NOT FOUND'
    ]);
}
?>