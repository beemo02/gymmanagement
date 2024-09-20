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
              <a class="nav-link mx-2 active" aria-current="page" href="#">Home</a>
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
            <li class="nav-item">
              <a class="nav-link mx-2" href="#">Package History</a>
            </li>
          </ul>

          <?php if($_SESSION['uid'] == 0): ?>
            <a class="nav-link mx-2 active text-light" aria-current="page" href="../user/login.php">Login <span>-></span></a>
          <?php else: ?>
            <a class="nav-link mx-2 active text-light" aria-current="page" href="../user/logout.php">Logout <span>-></span></a>
          <?php endif; ?>
        </div>
      </div>
    </nav>



<?php include "footer.php" ?>





