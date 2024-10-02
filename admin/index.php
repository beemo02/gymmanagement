<?php

include_once "./controller/AuthController.php";

$authcontroller = new AuthController();

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch($action){
    case 'login':
        $authcontroller->login();
        break;
    case 'register':
        $authcontroller->register();
        break;
    case 'index':
        include_once "./views/login.php";
        break;
    default:
    include_once "../user/index.php";
    
}



?>