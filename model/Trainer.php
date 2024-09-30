<?php

class Trainer {
    private $conn;
    private $table = 'trainer';

    public function __construct($dbh){
        $this->conn = $dbh;
    }

    public function listTrainer() {
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->query($sql); 
        $stmt->execute(); 
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 

       
        return $rows; // Return the fetched rows
    }
}




?>