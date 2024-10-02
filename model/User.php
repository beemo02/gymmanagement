<?php



include_once '../include/db.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class User extends Database {

    public function __construct()
    {
        parent::__construct();
    }

    public function login($email, $password)
    {
        try {
            $sql = "SELECT * FROM user WHERE email = :email ";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row && password_verify($password, $row['password'])) {
                
                $_SESSION['uid'] = $row['user_id'];
                $_SESSION['fname'] = $row['first_name'];
                $_SESSION['email'] = $row['email'];

                //header("location: ../gymlife-master/index.php");
                //exit();
                return true;
            } else {
                $msg = "Invalid username or password.";
            }
    
            return $msg;
        } catch (PDOException $e) {
            error_log($e->getMessage()); 
            $msg = "Login failed due to a server error. Please try again.";
        }

    }

    public function register($fname, $lname, $email, $password, $phone, $created_at)
    {
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO user (first_name, last_name, email, password, phone, created_at) VALUES (:fname, :lname, :email, :password, :phone, :created_at)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword); 
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':created_at', $created_at);
            $stmt->execute();
            $lastInsertId = $this->conn ->lastInsertId();
            
            if ($lastInsertId) {
                    
                echo "<script> alert('Registered Successfully') </script>";
            } else {
                echo "Registration failed. Please try again.";
            }

        }catch(PDOException $e){

            error_log($e->getMessage()); 
        }
    }
}






function register($fname, $lname, $email, $password, $phone, $created_at)
{   
    global $dbh;

    
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

   
    $sql = "INSERT INTO user (first_name, last_name, email, password, phone, created_at) VALUES (:fname, :lname, :email, :password, :phone, :created_at)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword); // Bind hashed password
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':created_at', $created_at);

    $stmt->execute();
    $lastInsertId = $dbh->lastInsertId();
    
    if ($lastInsertId) {
        echo "<script> alert('Registered Successfully') </script>";
        
    } else {
        echo "Registration failed. Please try again.";
    }
}






?>