<html>

<head></head>

<body>
  <h2>Login</h2>
  <form action="" method="POST">
    <p>
      <label>Username</label>
      <input id="username" value="" name="username" type="text" required="required" /><br>
    </p>
    <p>
      <label>passcode</label>
      <input id="passcode" name="passcode" type="password" required="required" />
    </p>
    <br />
    <p>
      <button type="submit" name="submit"><span>Login</span></button> <button type="reset"><span>Cancel</span></button>
    </p>
  </form>

  <?php

  echo $_SERVER["REQUEST_METHOD"];
  ?>
</body>