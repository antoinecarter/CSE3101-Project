<?php
  session_start();
  if(isset($_POST['submit'])){
    $cred = $usercontroller->message;
  }
?>
<div>
  <h2>Login</h2>
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
      <label>passcode</label>
      <input id="passcode" name="passcode" type="password" required="required" />
    </p>
    <br />
    <p>
      <button type="submit" name="submit" formmethod="post"><span>Login</span></button> <button type="reset"><span>Cancel</span></button>
    </p>
  </form>
  </div>