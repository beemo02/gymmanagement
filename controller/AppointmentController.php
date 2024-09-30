<?php

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include necessary files
include_once "../model/Appointment.php";
include_once "../model/Trainer.php";
include_once "../include/db.php";

// Start session to access session variables
//session_start();

class AppointmentController {
    private $db;
    private $appointment;
    private $trainer;

    public function __construct() {
        // Use global $dbh which is initialized outside
        global $dbh;
        
        // Assign the global database connection to $this->db
        $this->db = $dbh;
        
        // Initialize the Appointment and Trainer models
        $this->appointment = new Appointment($this->db);
        $this->trainer = new Trainer($this->db);
    }

    // Method to create an appointment
    public function createAppointment() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check if the user session exists
            if (!isset($_SESSION['uid'])) {
                echo "<script> alert('No user session found! Please log in first.'); </script>";
                return;
            }

            
            $user_id = $_SESSION['uid'];
            $trainer_id = htmlspecialchars($_POST['trainer_id']);
            $appointment_date = htmlspecialchars($_POST['appointment_date']);

            // Add the appointment using the model's method
            $appointment = $this->appointment->addAppointment($user_id, $trainer_id, $appointment_date);

            // Check if the appointment was successfully created
            if ($appointment) {
                echo "<script> alert('Appointment created successfully with'); </script>";
                unset($_SESSION['form_token']);
                $_SESSION['form_token'] = bin2hex(random_bytes(32)); 
                
            } else {
                echo "<script> alert('Appointment creation failed'); </script>";
            }

            

           
        }
    }
}
?>





