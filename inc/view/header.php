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
      <?php if($_SESSION['role'] == 'ADMIN'){ ?>
      <div>
      <button class="sidebar-dr">Configurations▼</button>
      <div class="dropdown-contain">
    <a href="./References">References</a>
    <a href="./Organizations">Organizations</a>
    <a href="./Compyear">Company Year</a>
    <a href="./Worklocations">Work Locations</a>
    <a href="./Shifts">Shifts</a>
  </div>
      </div>
      
      
<div>
<button class="sidebar-dr">Organization Management▼</button>
      <div class="dropdown-contain">
    <a href="./Orgstructure">Organization Structure</a>
    <a href="./Departments">Departments</a>
    <a href="./Units">Units</a>
    <a href="./Positions">Positions</a>
  </div>
</div>
<?php }?>
<div>
<button class="sidebar-dr">Employee Management ▼</button>
      <div class="dropdown-contain">
    <a href="./Individuals">Individuals</a>
    <a href="./Address">Address</a>
    <a href="./NationalIdentifier">National Identifier</a>
      <a href="./Employees">Employees</a>
      <a href="./Salary">Salary</a>
    <!--<a href="./Attendance">Attendance Det.</a>-->
    <a href="./Leaveentitlemt">Leave Entitlement </a>
  </div>
</div>
      
<div>
<button class="sidebar-dr">Attendance Management ▼</button>
      <div class="dropdown-contain">
    <a href="./Absence">Absence</a>
    <a href="./Lateness">Lateness</a>
    <a href="./Timeclocks">Timeclocks</a>
  </div>
</div>
      
<div>
<button class="sidebar-dr">Leave Management ▼</button>
      <div class="dropdown-contain">
    <a href="./Leavetrack">Leave Track</a>
    <a href="./Leaverequests">Leave Requests </a>
  </div>
</div>
      


    </div>

    <div id="main">
      <button class="openbtn" onclick="openNav()">☰</button>

    </div>

    <div>

    </div>
    </div>


    <a href="./home" class="cur_user"> HMRIS </a>

    <div class="topnav_button">
     <?php if($_SESSION['role'] == 'ADMIN'){?> <a href="./Users">User Accounts</a> <?php }?>

      <div class="dropmenu">
        <button class="dropbb"><?php require_once __DIR__."/../../index.php";
                                echo $_SESSION['username']; ?> ▼</button>
        <div class="dropmenu-content">
          <a href="./" name="logout"> Logout</a>
        </div>
      </div>
    </div>

  </nav>
  <script src="./js/script.js" async></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <script async src="https://cpwebassets.codepen.io/assets/embed/ei.js"></script>
  <body>
    <div>
  