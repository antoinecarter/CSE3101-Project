<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <base href="http://localhost/CSE3101-Project/" />
  <link rel="stylesheet" href="./css/style.scss" type="text/css">
</head>


  <nav class="side-top-nav">
    </head>

    <div id="mySidebar" class="sidebar">
      <b href="javascript:void(0)" class="closebtn" onclick="closeNav()">x</b>
      <button class="sidebar-dr">Departments ▼</button>
      <div class="dropdown-contain">
    <a href="#">Link 1</a>
    <a href="#">Link 2</a>
    <a href="#">Link 3</a>
  </div>
      <button class="sidebar-dr">HR Config ▼</button>
      <div class="dropdown-contain">
    <a href="#">Link 1</a>
    <a href="#">Link 2</a>
    <a href="#">Link 3</a>
  </div>
      <button class="sidebar-dr">Payroll Management ▼</button>
      <div class="dropdown-contain">
    <a href="#">Link 1</a>
    <a href="#">Link 2</a>
    <a href="#">Link 3</a>
  </div>
      <button class="sidebar-dr">Employee Management ▼</button>
      <div class="dropdown-contain">
    <a href="#">Link 1</a>
    <a href="#">Link 2</a>
    <a href="#">Link 3</a>
  </div>
      <button class="sidebar-dr">Attendance Management ▼</button>
      <div class="dropdown-contain">
    <a href="./Attendance">Attendance</a>
    <a href="#">Link 2</a>
    <a href="#">Link 3</a>
  </div>
      <button class="sidebar-dr">Leave Management ▼</button>
      <div class="dropdown-contain">
    <a href="#">Link 1</a>
    <a href="#">Link 2</a>
    <a href="#">Link 3</a>
  </div>
      <button class="sidebar-dr">Employee Management ▼</button>
      <div class="dropdown-contain">
    <a href="#">Link 1</a>
    <a href="#">Link 2</a>
    <a href="#">Link 3</a>
  </div>
    </div>

    <div id="main">
      <button class="openbtn" onclick="openNav()">☰</button>

    </div>

    <div>

    </div>


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
  