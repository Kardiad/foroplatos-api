<?php

class Usuarios extends BaseController{

     /**
     * ====================
     * =   MÉTODOS test   =
     * ====================
     */
    public function get_index (){
        echo json_encode([
            'status' => 200,
            'message' => 'WELCOME TO GET INDEX USUARIOS',
            'data' => [$this->segments, $this->permission]
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
    
     /**
     * ====================
     * =   MÉTODOS GET    =
     * ====================
     */

    public function get_perfil(){
        //Funciona checked
        if($this->validkey()==true){
            $this->results = model('User')->select($this->segments[2], [$this->segments[3]]);
        }
        $this->select_result($this->results, $this->segments[2]);
    }

     /**
     * ====================
     * =   MÉTODOS POST   =
     * ====================
     */
    /*public function post_login(){
        $this->results = model('User')->select($this->segments[2], $this->params);
        $this->select_result($this->results, $this->segments[2]);
    }*/

    public function post_mensaje(){
        //Funciona checked
        if($this->validkey()==true){
            $this->results = model('User')->insert($this->segments[2], $this->params);
        }
        $this->generate_input($this->results, $this->segments[2]);
    }

    public function post_valorar(){
         //Funciona checked
        if($this->validkey()==true){
            $this->results = model('User')->insert($this->segments[2], $this->params);
        }
        $this->generate_input($this->results, $this->segments[2]);
    }

    
    /**
     * ====================
     * =   MÉTODOS PUT    =
     * ====================
     */
    public function put_modificar_perfil(){
         //Funciona checked
        if($this->validkey()==true){
            $this->results= model('User')->update($this->segments[2], $this->paramsUpdate());
        }
        $this->generate_input($this->results, $this->segments[2]);
    }

     /**
     * ====================
     * =  MÉTODOS DELETE  =
     * ====================
     */
    public function delete_baja_usuario(){
        //Funciona checked
        if($this->validkey()==true){
            $this->results = model('User')->update($this->segments[2], [$this->segments[3]]);
        }
        $this->generate_input($this->results, $this->segments[2]);
    }
}

?>