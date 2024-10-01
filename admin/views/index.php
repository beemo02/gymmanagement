<?php
require_once '../controller/AuthController.php';

$authController = new AuthController();


$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch($action)
{
    case 'register':
        $authController->register();
        break;
    case 'login':
        $authController->login();
        break;
    case 'index':
        include_once "login.php";
        break;

}
?>
