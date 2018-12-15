<?php
class DB_Connect {
    private $conn;
 
    // Connecting to database
    public function connect() {
        require_once 'dbDetails.php';
         
        // Connecting to mysql database
        $this->conn = new mysqli(HOST,USER,PASS,DB);
         
        // return database handler
        return $this->conn;
    }
}
 
?>