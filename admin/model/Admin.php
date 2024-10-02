<?php

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include_once "../admin/config/database.php";

class Admin {
    private $conn;
    

    public function __construct(){
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function login($email, $password)
{
    
    $sql = "SELECT * FROM admin WHERE email = :email";
    $stmt = $this->conn->prepare($sql); // Make sure you have a PDO connection
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

   
    
    // Check if a row was found and verify password
    if ($row && password_verify($password, $row['adminpassword'])) {
        
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        header("location: ../admin/dashboard.php");
        exit();
    } else {
        echo "Login unsuccessful";
    }
}


    public function register($uname, $password, $cpassword, $email, $phone)
    {
        try {
            // First, validate that passwords match
            if ($password != $cpassword) {
                echo "Passwords do not match.";
                return false;
            }
    
            // Prepare the SQL statement
            $sql = "INSERT INTO admin (username, email, adminpassword, phone) VALUES (:username, :email, :adminpassword, :phone)";
            $stmt = $this->conn->prepare($sql);
            
            // Sanitize input
            $uname = htmlspecialchars(strip_tags($uname));
            $email = htmlspecialchars(strip_tags($email));
            $phone = htmlspecialchars(strip_tags($phone));
    
            // Hash the password
            $hash = password_hash($password, PASSWORD_DEFAULT);
    
            // Bind parameters
            $stmt->bindParam(':username', $uname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':adminpassword', $hash);
            
    
            // Execute the query
            if ($stmt->execute()) {
                // Redirect after successful registration
                
                header("Location: ../views/login.php");
                exit();
            } else {
                return false;
            }
    
        } catch (PDOException $e) {
            echo "Exception caught: " . $e->getMessage();
            return false;
        }
    }
    
}




?>