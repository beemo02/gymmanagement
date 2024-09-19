<?php

session_start();
require_once '../include/db.php';

$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (!empty($email) && !empty($password)) {
        login($email, $password);
    } else {
        $msg = "Please fill in both email and password.";
    }
} 

function login($email, $password) {
    global $dbh, $msg; 
    try {
        $sql = "SELECT * FROM user WHERE email = :email ";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() == 1 && password_verify($password, $row['password'])) {
            session_regenerate_id(true); 
            $_SESSION['uid'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            header("Location: index.php");
            exit();
        } else {
            $msg = "Invalid username or password.";
        }
    } catch (PDOException $e) {
        error_log($e->getMessage()); 
        $msg = "Login failed due to a server error. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div>
        <?php if(!empty($msg)){ ?>
        <strong><?php echo htmlspecialchars($msg); ?></strong>
        <?php } ?>
        <form action="login.php" method="POST">
            <label for="email">Email</label><br>
            <input type="text" name="email" required><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" required><br>
            <button type="submit">Login</button>
        </form>
    </div>
    <div>
        <h1>Welcome to Login </h1>
        <p>Don't have an account yet?</p>
        <a href="register.php">Sign up</a>
    </div>
</body>
</html>
