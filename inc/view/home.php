<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <div>
        <?php
        include __DIR__."/header.php";
        ?>
    </div>
<body class=main-home>
    <h1 class="main-h1">Human Resources Dashboard</h1>
    <div class="cards">
        <?php
          for ($x = 0; $x <= 14; $x+=2) {
            echo "<div class=card$x><p>Hello World</p></div>";
          }
        ?> 
    </div>
</body>
  
</html>
