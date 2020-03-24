<?php 

abstract class Model {
    
    protected $db_handler;
    protected $stmt;

    public function __construct(){
        $this->db_handler = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    }

    public function query($query){
        $this->stmt = $this->db_handler->prepare($query);
    }

    // Bind data to appropriate data type
    public function bind($parameter, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($parameter, $value, $type);
    }

    public function execute(){
        $this->stmt->execute();
    }

    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function last_insert_id(){
        return $this->db_handler->lastInsertId();
    }
}

?>