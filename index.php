<?php
require_once __DIR__ . "/inc/model/Database.php";
$db = new Database();
$db->init();

require_once __DIR__ . "/inc/controller/Userscontroller.php";
require_once __DIR__. "/inc/view/inc.php";


$path = $_SERVER["REQUEST_URI"];

if ($path == "/CSE3101-Project/"){
    $usercontroller->log();
} else if ($path == "/CSE3101-Project/home"){
    if(isset($_SESSION['id'])){
        $usercontroller->home();
    }
} else if ($path == "/CSE3101-Project/Users"){
    if(isset($_SESSION['id'])){
        $usercontroller->tblusers();
    }
} else if ($path == "/CSE3101-Project/Users/Registration"){
    if(isset($_SESSION['id'])){
        $usercontroller->frmusers();
    }
} 
?>
