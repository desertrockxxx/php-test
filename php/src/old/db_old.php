<?php

class Database
{
    private $charset;

    public function connect($servername, $username, $password, $dbname, $charset = 'utf8mb4'){
        $this->charset = $charset;
        
        try {
            $dsn = "mysql:host=".$servername.
            ";dbname=".$dbname.
            ";charset=".$this->charset;
            
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            echo "Connection works!";
            
            return $pdo;
            
        } catch (PDOException $e) {
            echo "Connection failed: " .$e->getMessage();
        }
    }
}

$database = new Database();
$pdo = $database->connect("db", "user", "password", "phptestdb");
