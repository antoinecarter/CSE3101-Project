<?php
include_once("inc/controller/Userscontroller.php");
$controller = new UsersController();
$controller->login($data);
?>