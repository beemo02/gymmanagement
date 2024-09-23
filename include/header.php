<?php

session_start();



$pagetitle = isset($pagetitle) ? $pagetitle : "Document";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title><?= $pagetitle; ?></title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark p-3 bg-dark" id="headerNav">
      <div class="container-fluid">
        <a class="navbar-brand d-block d-lg-none" href="#">
          <img src="../include/images/gymlogo.jpg" height="80" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class=" collapse navbar-collapse " id="navbarNavDropdown">
          <ul class="navbar-nav mx-auto ">
            <li class="nav-item">
              <a class="nav-link mx-2 active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-2" href="#">Contact</a>
            </li>
            <li class="nav-item d-none d-lg-block">
              <a class="nav-link mx-2" href="#">
                <img src="../include/images/gymlogo.jpg" height="60" />
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-2" href="#">Packages</a>
            </li>
            <?php if(strlen($_SESSION['uid'] == 0)): ?> 
            <li class="nav-item">
              <a class="nav-link mx-2" href="#">Package History</a>
            </li>
            <?php else : ?>
              <li class="nav-item">
                <a class="nav-link mx-2" href="#">Admin</a>
              </li>
            <?php endif; ?>
          </ul>

          <?php if($_SESSION['uid'] == 0): ?>
             <a class="nav-link mx-2 active text-light" aria-current="page" href="../user/login.php"><img src="../include/images/workout.png" alt="user icon" height="40">Login</span></a>
            
            <?php else: ?>
            <a class="nav-link mx-2 active text-light" aria-current="page" href="../user/logout.php">Logout</span></a>
          <?php endif; ?>
        </div>
      </div>
    </nav>



<?php include "footer.php" ?>





