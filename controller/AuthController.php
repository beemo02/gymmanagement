<?php

include_once "../model/User.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class AuthController {

    


    public function login() {
        
        // Initialize error message
        $msg = '';

        // Create a new User object
        $user = new User();

        // Check if the form has been submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            

            // Check if both fields are filled
            if (!empty($email) && !empty($password)) {
                // Perform login and handle the result
                $loginResult = $user->login($email, $password);

                // If login failed, $loginResult will contain an error message
                if ($loginResult) {
                    $msg = $loginResult;  // Display error message (e.g., invalid credentials)
                }
            } else {
                // Error if fields are empty
                $msg = "Please fill in both email and password.";
            }
        }

        // Return the error message for display if needed
        return $msg;
    }

    public function register()
    {
        $user = new User();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $created_at = $_POST['created_at'];
        
            try {
                
                $user->register($fname, $lname, $email, $password, $phone, $created_at);
                header("location: ../user/login.php");
                exit();
            } catch (PDOException $e) {
                
                error_log($e->getMessage());
                echo "An error occurred during registration. Please try again.";
            }
        }
    }
}



?>