<?php 

define('SGBD', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'ManagerOneDB');
define('DB_USER', 'root');
define('DB_PWD', '');

class Db_connect {

    public $connexion;    
   
    public function setConnection()
    {
        
        $this->conn = null;
        
        try 
        {
            $this->conn = new PDO(SGBD.':host='.DB_HOST.';dbname='.DB_NAME.';chartset=UTF8', DB_USER, DB_PWD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            // echo "Connected";
        }
        catch ( PDOException $e ) 
        {
            die ('Error: ' . $e->getMessage());
        }
        return $this->conn;
    }
}