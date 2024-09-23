<?php
session_start();
require_once "../include/db.php";
include_once "../include/header.php";

// Ensure user is logged in before proceeding
if (!isset($_SESSION['uid'])) {
    echo "You must be logged in to book a package.";
    exit();
}

$uid = $_SESSION['uid'];


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $pid = $_POST['pid'];
    

    // Ensure both package ID and user ID are not empty
    if (!empty($pid) && !empty($uid)) {
        
        $bookingSuccess = booking($uid, $pid); 
        
        if ($bookingSuccess) {
            // Redirect to the payment or confirmation page
            header("Location: payment.php?booking_id=" . $bookingSuccess);
            exit();
        } else {
            echo "An error occurred while booking the package.";
        }
    } else {
        echo "No package has been applied or user is not logged in.";
    }
}

// Function to handle booking
function booking($uid, $pid)
{
    global $dbh;

    try {
       
        $sql = "INSERT INTO booking (user_id, package_id) VALUES (:uid, :pid)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':uid', $uid);
        $stmt->bindParam(':pid', $pid);
        if($stmt->execute())
        {
            var_dump($uid,$pid);
        }
    } catch (PDOException $e) {
        
        error_log("Booking error: " . $e->getMessage());
        return false;
    }
}
?>


<?php

$sql = "SELECT * FROM package";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<ul>
<?php foreach($rows as $row): ?>
    <li><?= $row['package_name'] ?></li>
    <li><?= $row['price'] ?></li>
    <li><?= $row['duration_days'] ?></li>
    <li><?= $row['description'] ?></li>
    <li>
    <?php if(strlen($_SESSION['uid']) == 0): ?>
            <a href="login.php">Book Now</a> 
        <?php else: ?>
        <a href="booking.php?pid=<?= $row['package_id'] ?>">Book Now</a>
        
        <?php endif; ?>
    </li>
   
<?php endforeach; ?>

</ul>






<?php include_once "../include/footer.php"; ?>