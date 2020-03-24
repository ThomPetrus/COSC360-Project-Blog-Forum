<?php
class Database{
    // Connection variables
    private $host   = 'localhost';
    private $user   = 'root';
    private $pass   = 'test';
    private $db_name = 'project';

    private $db_handler;
    
    private $error;
    private $stmt;

    public function __construct(){
        // Set DSN - 
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
        
        // Set PDO Options - PHP Data Object
        $opts = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
        );

        //Create New PDO
        try{
            $this->db_handler = new PDO($dsn, $this->user, $this->pass, $opts);
        } catch(PDOException $e){
            $this->error = $e->getMessage();
            //echo $this->error;
        }
    }

    // Create prepared statement
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
        return $this->stmt->execute();
    }

    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lastInsertId(){
        $this->db_handler->lastInsertId();
    }
}
?>