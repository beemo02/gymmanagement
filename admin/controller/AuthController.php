<?php

require_once "../../include/db.php";
include_once "../model/Admin.php";

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class AuthController {
    private $conn;
    private $admin;

    public function __construct()
    {
        global $dbh;
        
        $this->conn = $dbh;
        $this->admin = new Admin($this->conn);
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            if(!empty($email) && !empty($password))
            {
                
                $this->admin->login($email,$password);
            }else{
                echo "Invalid username or password";
            }
        }
    }

    
    public function register()
    
    {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $uname = $_POST['username'];
        $password = $_POST['adminpassword'];
        $cpassword = $_POST['confirmpassword'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        

        
        $registerSuccess = $this->admin->register($uname, $password, $cpassword, $email, $phone);

        
        if ($registerSuccess) {
            echo "<script>
            alert('Registered successfully');
            window.location.href = 'login.php';
        </script>";
        
            exit();
        } else {
            echo '<div class="alert alert-danger">Registration unsuccessful.</div>';
        }
    }
}
    public function setMessage($msg)
    {
        return $msg;
    }

}



?>