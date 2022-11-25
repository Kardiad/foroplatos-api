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

    private function recetas(?array $params){
        $sql = 'SELECT * FROM receta';
        return $this->queryExec($sql, $params);
    }

    private function receta_borrar(array $params){
        $sql = 'DELETE FROM receta WHERE receta.id = ?';
        return $this->queryExec($sql, $params);
    }

    private function nueva_receta($params){
        $sql = 'INSERT INTO receta (titulo, ingredientes, pasos, dificultad, tipo) 
        VALUES (?,?,?,?,?)';
        return $this->queryExec($sql, $params);
    }

    private function modificar_receta($params){
        $sql = 'UPDATE receta SET '.$params['update'].' WHERE receta.id = ?';
        return $this->queryExec($sql, [intval(explode('=', $params['id'])[1])]);
    }
}

?>