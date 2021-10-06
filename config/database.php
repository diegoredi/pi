<?php
class Database{
    private $host = "localhost";
    private $db_name = "pi02";
    private $user = "root";
    private $password = "";
    public $conn;

    public function getConnection(){
        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=". $this->host ."; dbname=". $this->db_name, $this->user, $this->password);
        }catch(PDOException $ex){
            echo "erro de conexao: ". $ex->getMessage();
        }

        return $this->conn;
    }
}