<?php
ob_start();
session_start();
$usercontroller = new UsersController();
$attendancecontroller = new AttendanceController();
?>