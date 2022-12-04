<?php

class Administrador extends BaseController{
   
      /**
     * ====================
     * =   MÉTODOS test   =
     * ====================
     */
    public function get_index (){
        echo json_encode([
            'status' => 200,
            'message' => 'WELCOME TO GET INDEX ADMINISTRADOR',
            'data' => $this->segments
        ]);
    }

    public function post_index (){
        echo json_encode([
            'status' => 200,
            'message' => 'WELCOME TO GET INDEX ADMINISTRADOR',
            'data' => $this->segments
        ]);
    }

    public function put_index (){
        echo json_encode([
            'status' => 200,
            'message' => 'WELCOME TO GET INDEX ADMINISTRADOR',
            'data' => $this->segments
        ]);
    }
    
     /**
     * ====================
     * =   MÉTODOS GET    =
     * ====================
     */
    /** @method get_mensajes
     *  @param id_mensaje se obtiene desde $this->segments
     *  obtiene todos los mensajes escritos a administradores.
     *  Endpoint: /Administrador/mensajes/{id_mensaje}
     */
    public function get_mensajes(){
        //Checked y funciona
        if($this->validkey()){
            $this->results = model('Admin')->select($this->segments[2], []);
        }
        $this->select_result($this->results, $this->segments[2]);
    }
    public function get_usuarios(){
        //Checked y funciona
        if($this->validkey()){
            $this->results = model('Admin')->select($this->segments[2], []);
        }
        $this->select_result($this->results, $this->segments[2]);
    }

    /**
     * ====================
     * =   MÉTODOS POST   =
     * ====================
     */
    /** @method post_nueva_receta
     *  Añade una nueva receta al servidor.
     *  Endpoint: /Administrador/nueva_receta/
     */
    public function post_nueva_receta(){
        //Checked y funciona
        if($this->validkey()){
            $this->results = model('Receta')->insert($this->segments[2], $this->params);
        }
        $this->generate_input($this->results, $this->segments[2]);
    }
    /** @method post_nuevo_administrador
     *  @param nombre se saca de $_POST['nombre']
     *  @param contraseña se saca de $_POST['contraseña']
     *  Permite crear a un administrador, crear otro administrador
     *  Endpoint: /Administrador/nueva_administrador/
     */
    public function post_nuevo_administrador(){
        //Checked y funciona
        if($this->validkey()){
            $this->results = model('Admin')->insert($this->segments[2], $this->params);
        }
        $this->generate_input($this->results, $this->segments[2]);
    }

    /**
     * ====================
     * =   MÉTODOS PUT    =
     * ====================
     */

    public function put_modificar_receta(){
        //Checked y funciona
        if($this->validkey()){
            $this->results = model('Receta')->update($this->segments[2], $this->paramsUpdate());
        }
        return $this->generate_input($this->results, $this->segments[2]);
    }

    public function put_leido(){
        //Checked y funciona
        if($this->validkey()){
            $this->results = model('Admin')->update($this->segments[2], [intval($this->segments[4])]);
        }
        $this->generate_input( $this->results, $this->segments[2]);
    }

    /**
     * ====================
     * =  MÉTODOS DELETE  =
     * ====================
     */

    public function delete_receta_borrar(){
        //Checked y funciona
        if($this->validkey()){
            $this->results = model('Receta')->delete($this->segments[2], [intval($this->segments[4])]);
        }
        $this->generate_input($this->results, $this->segments[2]);
    }

    public function delete_usuario_borrar(){
        //Checked y funciona
        if($this->validkey()){
            $this->results = model('User')->delete($this->segments[2], [$this->segments[4]]);
        }
        $this->generate_input($this->results, $this->segments[2]);
    }

    public function delete_mensaje_borrar(){
        if($this->validkey()){
            $this->results = model('User')->delete($this->segments[2], [$this->segments[4]]);
        }
        $this->generate_input($this->results, $this->segments[2]);
    }
}

?>