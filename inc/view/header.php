<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.scss" type="text/css">
  </head>
  
    <header>
      <nav class="side-top-nav">
      </head>

        <div id="mySidebar" class="sidebar">
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
          <a href="#">Departments</a>
          <a href="#">HR Config</a>
          <a href="#">Payroll Management</a>
          <a href="#">Employee Management</a>
          <a href="#">Attendance Management</a>
          <a href="#">Leave Management</a>
          <a href="#">Employee Management</a>
        </div>

        <div id="main">
          <button class="openbtn" onclick="openNav()">☰</button>  

        </div>
        <script src="./js/script.js"></script>
        <div></div>


        <a class="cur_user"> HMRS  </a>

        <div class="topnav_button">
          <a href="./home">home</a>
          <a href="#">about</a>

          <div class="dropmenu">
          <button class="dropbb"><?php require __DIR__."/inc.php"; echo $_SESSION['username'];?>  ▼</button>
        <div class="dropmenu-content">
          <a href="#">Profile</a>
          <a href="action=logout"> Logout</a>
        </div> 


      </nav>
      <script src="./js/script.js"></script>

  </div>
</div>
      
    </header>
    <body>
  </body>

</html>

  