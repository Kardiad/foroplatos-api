<?php

//El controlador que tiene lo general para todos

class BaseController {

    protected array $segments = [];
    protected array $params = [];
    protected array $permission = [];

    
    public function setUriSegments($data=null){
        if($data==null){
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
            $uri = explode('/', $uri);
            $this->segments = $uri;
        }else{
            $this->segments = $data;
        }
    }

    public function validPermission($params){
        if($params[1]=='Administrador'){
            $results = model('Admin')->select('validarKey', $params);
            var_dump($results);
        }
        if($params[1]=='Usuarios'){
            $results = model('Usuario')->select('validarKey', $params);
            var_dump($results);
        }
    }

    public function clasificateByKey(string $key){
        var_dump($this->segments);
        $key_decoded = base64_decode($key);
        preg_match('/ \d /', $key_decoded, $assing);
        $assing = trim($assing[0]);
        $jsoneable = str_replace('Permission Level '.$assing[0].' =','',$key_decoded);
        $this->permission['permiso'] = json_decode($jsoneable);
        if(isset($assing[0])){
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

    public function paramsUpdate () {
        $params = [];
        $temp = [];
        $id = '';
        for($x=3; $x<=count($this->segments); $x++){
            if(strpos($this->segments[$x], 'id=', 0)>-1){
                $id = $this->segments[$x];
            }else{
                $text = explode('=', $this->segments[$x])[0]."='".explode('=', $this->segments[$x])[1]."'";
                array_push($temp, $text);
            }
        }
        $params['update'] = substr(implode(',',$temp), 0, strlen(implode(',',$temp)));
        $params['id'] = $id;
        return $params;
    }

    public function select_result($results, $segmento){
        if(!empty($results)){
            echo json_encode(['status'=>200, 'message'=>$segmento.' OK', 'results'=>$results]);
        }else{
            echo json_encode(['status' =>500, 'message'=>$segmento.' KO', 'results'=>0]);
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
        foreach($_REQUEST as $param){
            $this->params[$count] = $param;
            $count++;
        }
    }

}


?>