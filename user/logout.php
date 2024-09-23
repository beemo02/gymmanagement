<?php
session_start();
require_once('../include/db.php');
session_destroy();
header("location: login.php");
exit();
?>