<?php

session_start();
require_once "../include/db.php";
include_once "../include/header.php";

$uid = $_SESSION['uid'];

if(isset($_GET['pid'])){
    $pid = $_GET['pid'];
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = 'pending';

    $bookingSuccess = booking($uid,$pid,$start_date,$end_date,$status);

    if($bookingSuccess)
    {
        echo "<script> alert('Booking Successful'); </script>";
        
    }else
    {
        echo "<script> alert('Booking unsuccessful'); </script>";
    }
}

function booking($uid, $pid, $start_date, $end_date, $status)
{
    global $dbh;

    try {

        $sql = "INSERT INTO booking(user_id, package_id, start_date, end_date, status) VALUES (:uid, :pid, :start_date, :end_date, :status)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':uid', $uid);
        $stmt->bindParam(':pid', $pid);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':end_date', $end_date);
        $stmt->bindParam(':status', $status);
        
        if($stmt->execute())
        {
            return $dbh->lastInsertId();
        }else {

            echo "Failed to execute query". print_r($stmt->error_info());
            return false;
        }
    
    }catch (PDOException $e) {
        echo "Exception caught: " . $e->getMessage();
        return false;
    }
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Package</title>
</head>
<body>
    <h1>Book Your Package</h1>
    <form action="booking.php?pid=<?= $pid; ?>" method="POST">
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" required><br>

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" required><br>

        <button type="submit">Confirm Booking</button>
    </form>
</body>
</html>



<?php include_once "../include/footer.php"   ?>