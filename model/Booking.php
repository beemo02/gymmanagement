<?php

class Booking  {
    private $conn;

    public function __construct($dbh){    
        $this->conn = $dbh;
    }

    public function addBooking($uid,$pid,$start_date,$end_date,$status){
        try {

            $sql = "INSERT INTO booking(user_id, package_id, start_date, end_date, status) VALUES (:uid, :pid, :start_date, :end_date, :status)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':uid', $uid);
            $stmt->bindParam(':pid', $pid);
            $stmt->bindParam(':start_date', $start_date);
            $stmt->bindParam(':end_date', $end_date);
            $stmt->bindParam(':status', $status);
            
            if($stmt->execute())
            {
                return $this->conn->lastInsertId();
            }else {
    
                echo "Failed to execute query". print_r($stmt->error_info());
                return false;
            }
        
        }catch (PDOException $e) {
            echo "Exception caught: " . $e->getMessage();
            return false;
        }
    }
}




?>