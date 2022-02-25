
<html>
<head>
  <style>

    body{
       margin: 0;
       padding: 0;
       background-color: lightblue;

    }

    div{
      width: 320px;
      height: 420px;
      background: #000;
      color: #fff;
      top: 50%;
      left: 50%;
      position: absolute;
      transform: translate(-50%,-50%);
      box-sizing: border-box;
      padding: 70px 30px;

    }
    
    div h1{
      margin: 0;
      text-align: center;
      padding: 0 0 10px;
      font-size: 50px;
    }
    
    div p{
      font-weight: bold;
      margin: 0;
      padding: 0;
      text-align: center;

    }

    div p input[type="text"], input[type="password"]{
     
      height: 40px;
      padding-left: 12px;
    }

    
    div input{
      width: 100%;
      margin-bottom: 20px;
      border-radius: 7.25rem;
      
    }

    .login_bu {
    color: #fff;
    background-color: #28a745;
    border-color: #28a745;
    }

    .cancel_bu {
    color: #fff;
    background-color: #e52342;
    border-color: #e52342;
    }

    .lc {
    font-weight: 400;
    text-align: center;
    vertical-align: middle;
    user-select: none;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    

    }
    .lc {
    cursor: pointer;
    opacity: 0.9;
    }

    .lc:hover {
    opacity: 1;
    }

  </style>
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