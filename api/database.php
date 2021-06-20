<?php
class Database{
    public $conn;
    private $host = "localhost";
    private $bd = "gestcami";
    private $user = "root";
    private $pwd = "";

    public function getConnection(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->bd, $this->user, $this->pwd);
        }catch(exception $e){
            echo "Connection error : " . $e->getMessage();
        }
        return $this->conn;
    }
}