<?php

session_start();
require_once '../include/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $created_at = $_POST['created_at'];

    try {
        
        register($fname, $lname, $email, $password, $phone, $created_at);
    } catch (PDOException $e) {
        
        error_log($e->getMessage());
        echo "An error occurred during registration. Please try again.";
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
        echo "Registered Successfully";
        header("Location: login.php");
        exit();
    } else {
        echo "Registration failed. Please try again.";
    }
}
?>




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="register.php" method = "POST">
    
        <label for="first_name">First Name</label><br>
        <input type="text" name="first_name" required><br>
        
        <label for="last_name">Last Name</label><br>
        <input type="text" name="last_name" required><br>
        
        <label for="email">Email</label><br>
        <input type="email" name="email" required><br>

        <label for="password">Password</label><br>
        <input type="password" name="password" required><br>
        
        <label for="phone">Phone</label><br>
        <input type="text" name="phone" required><br>
        
        <label for="created_at">Created At</label><br>
        <input type="date" name="created_at" required><br>
        
       
        
        <button type="submit">Submit</button>
    


    </form>
</body>
</html>