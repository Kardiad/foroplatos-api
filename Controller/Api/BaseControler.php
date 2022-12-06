<?php

//El controlador que tiene lo general para todos

class BaseController {

    protected array $segments = [];
    protected array $params = [];
    protected array $permission = [];
    protected string $api_key = '';
    protected $results;

    /*
    $this->segments[1] es la clase $this->segments[2] el método 
    $this->segments[3] en adelante son parámetros de put o de get
    el request siempre será api_key en el get, en POST será cualquier
    parámetro
    */

    public function validkey(){
        $decoded_api_key = (new Cifrado())->descifrar($this->api_key, $this->segments[3]);
        if(strpos($decoded_api_key, $this->segments[3])>-1){
            return true;
        }else{
            return false;
        }
    }
    
    public function setUriSegments($data=null){
        if($data==null){
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri = explode('/', $uri);
            $this->segments = $uri;
        }else{
            $this->segments = $data;
        }
    }

    public function paramsUpdate () {
        $params = [];
        $temp = [];
        $username = '';
        for($x=3; $x<=count($this->segments); $x++){
            if(strpos($this->segments[$x], '=', 0)==false){
                $username = antihackChained($this->segments[$x]);
            }else{
                if(strpos($this->segments[$x], 'pass', 0)>-1){
                    $text = antihackChained(explode('=', $this->segments[$x])[0])."='".password_hash(substr(explode('=', $this->segments[$x])[1], 0, 6), PASSWORD_DEFAULT)."'";
                }else{
                    $text = antihackChained(explode('=', $this->segments[$x])[0])."='".antihackChained(explode('=', $this->segments[$x])[1])."'";
                }
                array_push($temp, $text);
            }
        }
        $params['update'] = substr(implode(',',$temp), 0, strlen(implode(',',$temp)));
        $params['username'] = $username;
        return $params;
    }

    public function select_result($results, $segmento){
        if(!empty($results)){
            if(isset($results['status'])){
                echo json_encode(['status'=>404, 'message'=>$segmento.' NOK', 'results'=>'USER OR SOURCE NOT FOUND']);
            }else{
                echo json_encode(['status'=>200, 'message'=>$segmento.' OK', 'results'=>$results]);
            }
        }else{
            if($results==''){
                echo json_encode(['status' =>403, 'message'=>$segmento.' DON`T GIVE DATA TO WRONG USER  ', 'results'=>0]);
            }else{
                echo json_encode(['status' =>500, 'message'=>$segmento.' KO', 'results'=>0]);
            }
        }
    }

    public function generate_input($results, $segmento){
        if(isset($results['status'])){
            echo json_encode(['status' =>200, 'message'=>$segmento.' OK', 'results'=>$results]);
        }else{
            echo json_encode(['status' =>500, 'message'=>$segmento.' KO', 'results'=>0]);
        }
    }
    
    public function getParams(){
        $count = 0;
        $params = null;
        if(!empty($_POST)){
            $params = $_POST;
        }else{
            $params = $_REQUEST;
        }
        if(!empty($_FILES)){
            $file = fopen($_FILES['foto']['tmp_name'], 'r');
            $img = fread($file, $_FILES['foto']['size']);
            array_push($params, $img);
            array_push($params, $_FILES['foto']['type']);
        }
        if(isset($_REQUEST['api_key'])){
            $this->api_key = $_GET['api_key'];
        }
        foreach($params as $param){
            $this->params[$count] = $param;
            $count++;
        }
    }
}


?>