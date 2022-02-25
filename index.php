<?php
    include_once __DIR__."/inc/model/Database.php";
    $db = new Database();
    $db->init();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            HRMIS
        </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/styles.css">

    </head>
    <body>
        <main>
            <?php
                include __DIR__."/inc/controller/Userscontroller.php";
                $usercontroller = new UsersController;

                $path = $_SERVER["REQUEST_URI"];

                if($path == "/CSE3101-Project/"){
                    $usercontroller->userlogin();
                }else if($path == "/CSE3101-Project/home"){    
                        $usercontroller->home();
                }
            ?>
        </main>
    </body>
</html>
