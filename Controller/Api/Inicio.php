<?php

class Inicio extends BaseController{
    /**
     * ====================
     * =   MÉTODOS test   =
     * ====================
     */
    public function get_index (){
        echo json_encode([
            'status' => 200,
            'message' => 'WELCOME TO GET INDEX',
            'data' => $this->segments
        ]);
    }

    public function post_index (){
        echo json_encode([
            'status' => 200,
            'message' => 'WELCOME TO POST INDEX',
            'data' => $this->segments
        ]);
    }

     /**
     * ====================
     * =   MÉTODOS GET    =
     * ====================
     */
    public function get_recetas(){
        //Checked funciona y vamos a hacer la cutrez de sacarlas con un bucle de 10
        $this->results = model('Receta')->select($this->segments[2], [intval($this->segments[3])]);
        $this->select_result($this->results, $this->segments[2]);
    }

    /**
     * ====================
     * =   MÉTODOS POST   =
     * ====================
     */

    public function post_login(){
        //Cheched funciona
        $this->results = model('Admin')->select($this->segments[2], $this->params);
        if(isset($this->results['status']) && strpos($this->results['status'], 'INSERT')==false){
            $this->results = model('User')->select($this->segments[2], $this->params);
        }
        $this->select_result($this->results, $this->segments[2]);
    }

    public function post_nuevo_usuario(){
        //Checked funciona
        $this->results = model('User')->insert($this->segments[2], $this->params);
        $this->generate_input($this->results, $this->segments[2]);
    }
}


?>