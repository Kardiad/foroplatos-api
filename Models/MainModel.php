<?php

//En este se encuentra la base de datos y algunas cosas para facilitar consultas

abstract class MainModel extends PDO{
    
    protected PDO $db;

    public abstract function insert(string $method, array $params);
    public abstract function update(string $method, array $params);
    public abstract function delete(string $method, array $params);
    public abstract function select(string $method, ?array $params);

    public function __construct(){
        try{
            $this->db = new PDO('mysql:host='.HOST.';dbname='.DBNAME, USER, PASS);
        }catch(PDOException $e){
            echo json_encode(['status'=>500, 'message'=>$e->getMessage()]);
        }
    }

    public function queryExec($sql, array $params = []) {
        try{
            $stmt = $this->db->prepare($sql);
            for ($x = 0; $x < count($params); $x++) {
                $stmt->bindParam($x+1, $params[$x], $this->tipo($params[$x]));
            }
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            if(!empty($result)){
                return $result;
            }else{
                return ['status' => 'INSERT, UPDATE OR DELETE DONE SUSSCCESFUL'];
            }
        }catch(PDOException $e){
            echo $e->getMessage();
            return ['status' => 'SOMETHING WAS WRONG', 'error' => $this->error($e->getMessage())];
        }
    }
    
    private function tipo($param) {
        switch (gettype($param)) {
            case "string":
                return PDO::PARAM_STR;
            case "integer":
                return PDO::PARAM_INT;
            case "resource":
                return PDO::PARAM_LOB;
        }

    }

    private function error($error){
        $error = preg_match_all('/([\d]+)/', $error, $match);
        if(empty($error)){
            $stringError = 'SQLPROBLEM '.$match[0][0].' SUBPROBLEM '.$match[0][1];
        }else{
            $stringError = 'ERROR';
        }
        return $stringError;
    }

}

?>