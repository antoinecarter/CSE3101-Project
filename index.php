<?php
require_once __DIR__ . "/inc/model/Database.php";
$db = new Database();
$db->init();

require_once __DIR__ . "/inc/controller/Userscontroller.php";
require_once __DIR__ . "/inc/controller/attendancecontroller.php";
require_once __DIR__. "/inc/view/inc.php";


$path = $_SERVER["REQUEST_URI"];
$url = $_SERVER['REQUEST_SCHEME'] . '://';
$url .= $_SERVER['HTTP_HOST'];
$url .= $_SERVER['REQUEST_URI'];

$url_components = parse_url($url);
if(isset($url_components['query'])){
    parse_str($url_components['query'], $params);
};

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
} else if($path == ('/CSE3101-Project/Users/Registration/Edit?id='.$params['id'])){
    if(isset($_SESSION['id'])){
        if(($_SESSION['id'] == $params['id']) || ($_SESSION['role'] == 'ADMIN')){
            $usercontroller->edtusers();
        }
    }
} else if($path == ('')){

}if ($path == "/CSE3101-Project/Attendance"){
    if(isset($_SESSION['id'])){
        $attendancecontroller->tblattendance();
    }
} else if ($path == "/CSE3101-Project/Attendance/Registration"){
    if(isset($_SESSION['id'])){
        $attendancecontroller->frmuattendance();
    }
} else if($path == ('/CSE3101-Project/Attendance/Registration/Edit?id='.$paras['id'])){
    if(isset($_SESSION['id'])){
        if(($_SESSION['id'] == $paras['id']) || ($_SESSION['role'] == 'ADMIN')){
            $attendancecontroller->edtattendance();
        }
    }
} else if($path == ('')){
    
}
?>
