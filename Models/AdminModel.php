<?php

class AdminModel extends MainModel{

    public function insert(string $method, array $params){
        return $this->$method($params);
    }

    public function update(string $method, array $params){
        return $this->$method($params);
    }

    public function delete(string $method, array $params){
        return $this->$method($params);
    }

    public function select(string $method, ?array $params){
        return $this->$method($params);
    }

    public function master_chief(){
        $sql = 'SELECT * FROM administrador';
        if(empty($this->queryExec($sql))){
            $api_key = $this->key_api_gen('pepe', 'pepe');
            $sql = "INSERT INTO administrador (username, pass, api_key) values ('pepe','pepe',$api_key)";
            $this->queryExec($sql, []);
        }
    }

    private function key_api_gen($params){
        return base64_encode('Permission Level 2 = {"'.$params[0].'":"'.$params[1].'"}');
    }

    private function nuevo_administrador($params){
        array_push($params, $this->key_api_gen($params));
        $sql = 'INSERT INTO administrador (username, pass, api_key) values (?,?,?)';
        return $this->queryExec($sql, $params);
    }

    private function mensajes($params){
        $sql = 'SELECT * FROM mensaje';
        return $this->queryExec($sql, $params);
    }

    private function login($params){
        $sql = 'SELECT * FROM administrador WHERE username = ? AND pass = ?';
        return $this->queryExec($sql, $params);
    }

    private function usuario($params){
        $sql = 'DELETE FROM mensaje WHERE mensaje.id_usuario = ?';
        $this->queryExec($sql, $params);
        $sql = 'DELETE FROM usuario WHERE usuario.id = ?';
        return $this->queryExec($sql, $params);
    }

    private function leido($params){
        $sql = 'UPDATE mensaje SET estado = leido WHERE mensaje.id=?';
        return $this->queryExec($sql, $params);
    }

    private function validarKey($params){
        $sql = 'SELECT id FROM administrador WHERE nombre=? and pass=?';
        return $this->queryExec($sql, $params);
    }
}

?>