<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.scss" type="text/css">
  </head>
  
    <header>
      <nav class="top-nav">
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
    </header>
    <body>
  </body>


  <script src="./script.js"></script>
</html>

  