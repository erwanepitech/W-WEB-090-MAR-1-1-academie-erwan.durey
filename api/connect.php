
<?php

class connect{

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "common_database";
 
    protected $connection;

    public function __construct(){
        try{
            $this->connection = new PDO("mysql:host=". $this->host .
            ";dbname=" . $this->db . "", "'$this->username'", "$this->password");
            $this->connection->exec('SET NAMES "UTF8"');
        } catch (PDOException $e){
            echo 'Erreur : '. $e->getMessage();
            die();
        }
        return $this->connection;
    }
}

?>