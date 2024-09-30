<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include "../model/Booking.php";
include "../include/db.php";

class BookingController {
    private $conn;
    private $booking;
    
    public function __construct(){
        global $dbh;
        $this->conn = $dbh;
        $this->booking = new Booking($this->conn);
    }

    public function createBooking()
    {
        $uid = $_SESSION['uid'];
        
        if(isset($_GET['pid'])){
            $pid = $_GET['pid'];
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $status = 'pending';
            
            $bookingSuccess = $this->booking->addBooking($uid,$pid,$start_date,$end_date,$status);
            
            
            if($bookingSuccess)
            {
                echo "<script> alert('Booking Successful. Please Confirm for the payment'); </script>";
            }else
            {
                echo "<script> alert('Booking unsuccessful'); </script>";
            }
        }

    }

}



?>