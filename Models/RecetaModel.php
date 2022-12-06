<?php

class RecetaModel extends MainModel{


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

    private function cantidad_recetas(?array $params){
        $sql = 'SELECT id FROM receta';
        return $this->queryExec($sql, $params);
    }

    private function recetas(?array $params){
        $sqlReceta = 'SELECT id, titulo, ingredientes, pasos, dificultad, tipo, formato FROM receta WHERE receta.id=?';
        $resultado['receta'] = $this->queryExec($sqlReceta, $params); 
        $sqlImagen = 'SELECT foto FROM receta WHERE receta.id=?';
        //var_dump($this->queryExec($sqlImagen, $params)[0]['foto']);
        $resultado['receta'][0]->foto = base64_encode($this->queryExec($sqlImagen, $params)[0]->foto);
        $sql = 'SELECT usuario.alias, usuario_receta.* 
        FROM receta 
        JOIN usuario_receta ON receta.id=usuario_receta.id_receta
        JOIN usuario on usuario.id=usuario_receta.id_usuario
        WHERE receta.id = ?';
        $resultado['comentarios'] = $this->queryExec($sql, $params);
        return $resultado;
    }

    private function recetas_todas(array $params){
        $sql = 'SELECT id, titulo, dificultad, tipo FROM receta';
        return $this->queryExec($sql, $params);
    }

    private function receta_borrar(array $params){
        $sql = 'DELETE FROM usuario_receta WHERE usuario_receta.id_receta=?';
        $this->queryExec($sql, $params);
        $sql = 'DELETE FROM receta WHERE receta.id = ?';
        return $this->queryExec($sql, $params);
    }

    private function nueva_receta($params){
        //var_dump('RecetaModel 42', $params);
        $sql = 'INSERT INTO receta (titulo, ingredientes, pasos, dificultad, tipo, foto, formato) 
        VALUES (?,?,?,?,?,?,?)';
        return $this->queryExec($sql, $params);
    }

    private function modificar_receta($params){
        $sql = 'UPDATE receta SET '.$params['update'].' WHERE receta.id = ?';
        return $this->queryExec($sql, [intval($params['username'])]);
    }
}

?>