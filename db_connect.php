<?php
class DbConnection {
 
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "common-database";
 
    protected $connection;
 
    public function __construct(){
 
        if (!isset($this->connection)) {
            try {
                $this->connection = new PDO("mysql:host=". $this->host .";dbname=" . $this->db . "", "'$this->username'", "$this->password");
                $this->connection->exec('SET NAMES "UTF8"');
            } catch (PDOException $e) {
                if (!$this->connection) {
                    $msg = 'Cannot connect to database server';
                    $json = ["succes" => 0, "msg" => $msg];
                    return $json;
                }
            }
        }
        return $this->connection;
    }
}