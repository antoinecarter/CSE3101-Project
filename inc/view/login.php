
<html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.scss" type="text/css">
</head>

  <?php
    session_start();
    if(isset($_POST['submit'])){
      $cred = $usercontroller->message;
    }
  ?>
<body>
  <div class="login">
    <h1>Login</h1>
    <?php if(isset($cred)){ ?>
      <div style="margin-top: 50px"class="alert"> <?php echo $cred; ?> </div>
    <?php } ?>
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