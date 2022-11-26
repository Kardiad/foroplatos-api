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
        $results = model('Admin')->select($this->segments[2], []);
        $this->select_result($results, $this->segments[2]);
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
        $results = model('Receta')->insert($this->segments[2], $this->params);
        $this->generate_input($results, $this->segments[2]);
    }
    /** @method post_nuevo_administrador
     *  @param nombre se saca de $_POST['nombre']
     *  @param contraseña se saca de $_POST['contraseña']
     *  Permite crear a un administrador, crear otro administrador
     *  Endpoint: /Administrador/nueva_administrador/
     */
    public function post_nuevo_administrador(){
        $results = model('Admin')->insert($this->segments[2], $this->params);
        $this->generate_input($results, $this->segments[2]);
    }

    public function post_login(){
        $results = model('Admin')->select($this->segments[2], $this->params);
        $this->select_result($results, $this->segments[2]);
    }

    /**
     * ====================
     * =   MÉTODOS PUT    =
     * ====================
     */

    public function put_modificar_receta(){
        $results = model('Receta')->update($this->segments[2], $this->paramsUpdate());
        return $this->generate_input($results, $this->segments[2]);
    }

    public function put_leido(){
        $results = model('Admin')->update($this->segments[2], [$this->segments[3]]);
        $this->generate_input($results, $this->segments[2]);
    }

    /**
     * ====================
     * =  MÉTODOS DELETE  =
     * ====================
     */

    public function delete_receta_borrar(){
        $results = model('Receta')->delete($this->segments[2], [intval($this->segments[3])]);
        $this->generate_input($results, $this->segments[2]);
    }

    public function delete_usuario_borrar(){
        $results = model('User')->delete($this->segments[2], [intval($this->segments[3])]);
        $this->generate_input($results, $this->segments[2]);
    }

}

?>