<html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <base href="http://localhost/CSE3101-Project/" />
  <link rel="stylesheet" href="./css/style.scss" type="text/css">
</head>
<?php include_once __DIR__ . "/../../index.php";
$login = new UsersController();
if (isset($_POST['submit'])) {
  $cred = $login->userlogin();
}
?>

<body>
  <?php if(isset($cred)){ 
  ?>
  <div style="background-color:blue; height:100px;"> <?php echo $cred; ?> </div>
  <?php } 
  ?>
  <div class="login">
    <h1>Login</h1>

    <form method="post" action="">
      <input type="hidden" name="type" value="login">
      <p>
        <label>Username</label>
        <input id="username" value="" name="username" type="text" required="required" /><br>
      </p>
      <p>
        <label>Passcode</label>
        <input id="passcode" name="passcode" type="password" required="required" />
      </p>
      <br />
      <p>
        <button type="submit" name="submit" class="lc login_bu" formmethod="post"><span>Login</span></button> <button type="reset" class="lc cancel_bu"><span>Cancel</span></button>
      </p>
    </form>
  </div>
</body>

</html>