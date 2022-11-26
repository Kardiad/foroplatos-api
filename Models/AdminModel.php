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

    public function master_chief($params){
        $sql = 'SELECT * FROM administrador';
        $resultado = $this->queryExec($sql);
        if(isset($resultado['status'])){
            if(strpos($resultado['status'], 'DONE')>-1){
                $api_key = $this->key_api_gen($params);
                $sql = "INSERT INTO administrador (username, pass, api_key) values (?,?,?)";
                $this->queryExec($sql, [$params[0], password_hash($params[1], PASSWORD_DEFAULT), $api_key]);
            }
        }
    }

    private function key_api_gen($params){
        return base64_encode('Permission Level 2 = {"'.$params[0].'":"'.$params[1].'"}');
    }

    private function nuevo_administrador($params){
        array_push($params, $this->key_api_gen($params));
        $params[1] = password_hash(substr($params[1], 0, 6), PASSWORD_DEFAULT);
        $sql = 'INSERT INTO administrador (username, pass, api_key) values (?,?,?)';
        return $this->queryExec($sql, $params);
    }

    private function mensajes($params){
        $sql = 'SELECT * FROM mensaje';
        return $this->queryExec($sql, $params);
    }

    private function login($params){
        $params[1]=$this->obtenerPasword($params[0], $params[1], 'administrador');
        $sql = 'SELECT * FROM administrador WHERE username = ? AND pass = ?';
        return $this->queryExec($sql, $params);
    }

    private function usuario($params){
        $sql = 'DELETE FROM usuario_receta WHERE usuario_receta.id_usuario = ?';
        $this->queryExec($sql, $params);
        $sql = 'DELETE FROM mensaje WHERE mensaje.id_usuario = ?';
        $this->queryExec($sql, $params);
        $sql = 'DELETE FROM usuario WHERE usuario.id = ?';
        return $this->queryExec($sql, $params);
    }

    private function leido($params){
        $sql = "UPDATE mensaje SET estado = 'leido' WHERE mensaje.id=?";
        return $this->queryExec($sql, $params);
    }
}

?>