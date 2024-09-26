<?php

session_start();
require_once "../include/db.php";
require_once "../include/header.php";

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
        echo "<script> alert('Booking Successful. Please Confirm for the payment'); </script>";
        
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

<section class="book-section spad" >
        <div class="container booking-container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="booksection-title booking-title">
                        <span>Book Your Package</span>
                        <h2 class="booktitle-phrase">Book Your Fitness</h2>
                    </div>
                    <div class="booking-widget">
                        <div class="bw-text">
                            <i class="fa fa-map-marker"></i>
                            <p>333 Middle Winchendon Rd, Rindge,<br/> NH 03461</p>
                        </div>
                        <div class="bw-text">
                            <i class="fa fa-mobile"></i>
                            <ul>
                                <li>125-711-811</li>
                                <li>125-668-886</li>
                            </ul>
                        </div>
                        <div class="bw-text email">
                            <i class="fa fa-envelope"></i>
                            <p>Support.gymcenter@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="leave-comment">
                        <form action="booking.php?pid=<?= $pid; ?>" method="POST">
                            <label for="start_date" class="book-form-label">Start Date:</label>
                            <input type="date" name="start_date"  required><br>
                            <label for="end_date" class="book-form-label">End Date:</label>
                            <input type="date" name="end_date"  required><br>
                            <button type="submit" class="confirm-booking-button">Confirm Booking</button>
                        </form>

                    </div>
                </div>
            </div>
            
        </div>
    </section>



<?php include_once "../include/footer.php"   ?>