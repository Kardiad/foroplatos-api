<?php

    class UserModel extends MainModel{

        public function insert(string $method, array $params){
            /**
             * Métodos que entran en esta función.
             * @method nuevo_usuario
             */
            return $this->$method($params);
        }

        public function update(string $method, array $params){
            /**
             * Métodos que entran en esta función.
             * @method login
             */
            return $this->$method($params);
        }

        public function delete(string $method, array $params){
            /**
             * Métodos que entran en esta función.
             * @method login
             */
            return $this->$method($params);
        }

        public function select(string $method, ?array $params){
            /**
             * Métodos que entran en esta función.
             * @method login
             */
            return $this->$method($params);
        }

        private function key_api_gen($params){
            var_dump($params);
            return base64_encode('Permission Level 1 = {"'.$params[0].'":"'.$params[7].'"}');
        }

        private function login($params){
            $params[1] = $this->obtenerPasword($params[0], $params[1], 'usuario');
            $sql = "SELECT * FROM usuario 
            WHERE usuario.username = ? 
            AND usuario.pass = ? 
            AND usuario.alta=1";
            return $this->queryExec($sql, $params);
        }

        private function nuevo_usuario ($params){
            array_push($params, $this->key_api_gen($params));
            $params[1] = password_hash(substr($params[1], 0, 6), PASSWORD_DEFAULT);
            $sql = 'INSERT INTO usuario (username, pass, alias, nombre, apellidos, edad, telefono, email, api_key) 
            values (?,?,?,?,?,?,?,?,?)';
            return $this->queryExec($sql, $params);
        }

        private function perfil ($params){
            $sql = 'SELECT * FROM usuario WHERE username = ?';
            return $this->queryExec($sql, $params);
        }

        private function mensaje($params){
            $sql = 'INSERT INTO mensaje (id_usuario, texto) 
            values (?,?)';
            return $this->queryExec($sql, $params);
        }

        private function modificar_perfil($params){
            $sql = 'UPDATE usuario SET '.$params['update'].' WHERE usuario.username=?';
            return $this->queryExec($sql, [$params['username']]);
        }

        private function valorar($params){
            $sql = 'INSERT INTO usuario_receta (id_usuario, id_receta, valoracion, comentario) 
            VALUES (?, ?, ?, ?)';
            return $this->queryExec($sql, $params);
        }

        private function valoraciones($params){
            $sql = 'SELECT * FROM usuario_receta';
            return $this->queryExec($sql, $params);
        }

        private function baja_usuario($params){
            $sql = 'UPDATE usuario SET alta = 0 WHERE username = ?';
            return $this->queryExec($sql, $params);
        }

        private function usuario_borrar($params){            
            $sql = 'SELECT id FROM usuario WHERE username = ?';
            $id = ($this->queryExec($sql, $params))[0]->id;
            $sql = 'DELETE FROM usuario_receta WHERE usuario_receta.id_usuario = ?';
            $this->queryExec($sql, [$id]);
            $sql = 'DELETE FROM mensaje WHERE id_usuario = ?';
            $this->queryExec($sql, [$id]);
            $sql = 'DELETE FROM usuario WHERE id = ?';
            return $this->queryExec($sql, [$id]);
        }

        private function valoraciones_por_receta($params){
            $sql = 'SELECT * FROM usuario_receta JOIN receta ON receta.id=usuario_receta.id_receta 
            WHERE receta.id = ?';
            return $this->queryExec($sql, $params);
        }

        private function find_by_user_api_key($api_key){
            $sql = "SELECT * FROM usuario WHERE api_key=?";
            return $this->queryExec($sql, [$api_key]);
        }
    }

?>