<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.scss" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Gothic&display=swap" rel="stylesheet">
  </head> 
  <body>
    <nav class="navbar navbar-light bg-info">
      <div class="container">
        <a class="navbar-brand" href="#">
          <h1 class="brand">HRMS</h1>
        </a>   
        <a class="nav-link" href="#">Profile</a>
        <a class="nav-link" href="#">About</a>
      </div>
    </nav>
    <div class="cards">
       <div>
         <p>Hello World  </p>
       </div>
        <?php
          for ($x = 0; $x <= 12; $x+=2) {
            echo "<div class=card$x><p>Hello World</p></div>";
          }
        ?> 
    </div>  
  </body>
</html>

  