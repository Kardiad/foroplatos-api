<?php

class Usuarios extends BaseController{

    //Métodos test
    public function get_index (){
        echo json_encode([
            'status' => 200,
            'message' => 'WELCOME TO GET INDEX USUARIOS',
            'data' => $this->segments
        ]);
    }

    public function post_index (){
        echo json_encode([
            'status' => 200,
            'message' => 'WELCOME TO POST INDEX USUARIOS',
            'data' => $this->segments
        ]);
    }

    public function put_index (){
        echo json_encode([
            'status' => 200,
            'message' => 'WELCOME TO PUT INDEX USUARIOS',
            'data' => $this->segments
        ]);
    }
    
    //Metodos get
    public function get_recetas(){
        $results = model('Receta')->select($this->segments[2], []);
        $this->select_result($results, $this->segments[2]);
    }

    public function get_perfil(){
        $this->validPermission($this->segments);
        $results = model('User')->select($this->segments[2], [$this->segments[3]]);
        $this->select_result($results, $this->segments[2]);
    }

    public function get_valoraciones(){
        $results = model('User')->select($this->segments[2], []);
        $this->select_result($results, $this->segments[2]);
    }

    public function get_valoraciones_por_receta(){
        $results = model('User')->select($this->segments[2], [$this->segments[3]]);
        $this->select_result($results, $this->segments[2]);
    }

    //Metodos post
    public function post_login(){
        $results = model('User')->select($this->segments[2], $this->params);
        $this->select_result($results, $this->segments[2]);
    }

    public function post_nuevo_usuario(){
        $results = model('User')->insert($this->segments[2], $this->params);
        $this->generate_input($results, $this->segments[2]);
    }

    public function post_mensaje(){
        $results = model('User')->insert($this->segments[2], $this->params);
        $this->generate_input($results, $this->segments[2]);
    }

    public function post_valorar(){
        $results = model('User')->insert($this->segments[2], $this->params);
        $this->generate_input($results, $this->segments[2]);
    }

    //Metodos put
    public function put_modificar_perfil(){
        $results = model('User')->update($this->segments[2], $this->paramsUpdate());
        $this->generate_input($results, $this->segments[2]);
    }

    //Metodo delete
    public function delete_baja_usuario(){
        $results = model('User')->delete($this->segments[2], [intval($this->segments[3])]);
        $this->generate_input($results, $this->segments[2]);
    }
}

?>