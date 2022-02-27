<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <base href="http://localhost/CSE3101-Project/" />
  <link rel="stylesheet" href="./css/style.scss" type="text/css">
</head>

<header>
  <nav class="side-top-nav">
    </head>

    <div id="mySidebar" class="sidebar">
      <b href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</b>
      <a href="#">Departments▼</a>
      <a href="#">HR Config▼</a>
      <a href="#">Payroll Management▼</a>
      <a href="#">Employee Management▼</a>
      <a href="#">Attendance Management▼</a>
      <a href="#">Leave Management▼</a>
      <a href="#">Employee Management▼</a>
    </div>

    <div id="main">
      <button class="openbtn" onclick="openNav()">☰</button>

    </div>

    <div></div>


    <a href="./home" class="cur_user"> HMRIS </a>

    <div class="topnav_button">
      <a href="./Users">User Accounts</a>

      <div class="dropmenu">
        <button class="dropbb"><?php require_once __DIR__."/../../index.php";
                                echo $_SESSION['username']; ?> ▼</button>
        <div class="dropmenu-content">
          <a href="./" name="logout"> Logout</a>
        </div>
      </div>
    </div>

  </nav>
  <script src="./js/script.js"></script>

  <body>
    <div>
    <div style="height: 100px;"></div>
  