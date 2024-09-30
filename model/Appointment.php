<?php



class Appointment {
    private $conn;
    
    public function __construct($dbh)
    {
        $this->conn = $dbh;
    }

    public function addAppointment($uid, $tid, $appointment_date )
    {
        if(!isset($_SESSION['uid']))
        {
            echo "no users found";
            return false;
        }

        $uid = $_SESSION['uid'];

        $sql = "INSERT INTO appointments(user_id, trainer_id, appointment_date) VALUES (:uid, :tid, :appointment_date)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':uid', $uid);
        $stmt->bindParam(':tid', $tid);
        $stmt->bindParam(':appointment_date', $appointment_date);

        if($stmt->execute())
        {
            return $this->conn->lastInsertId();
        }else{
            return false;
        }

    }
}




?>