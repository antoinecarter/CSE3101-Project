
<html>
<head>
  <style>

    body{
       margin: 0;
       padding: 0;
       background-color: red;

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

    }

    
    div input{
      width: 100%;
      margin-bottom: 20px;
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
        <label>passcode</label>
        <input id="passcode" name="passcode" type="password" required="required" />
      </p>
      <br />
      <p>
        <button type="submit" name="submit" formmethod="post"><span>Login</span></button> <button type="reset"><span>Cancel</span></button>
      </p>
    </form>
    </div>
</body>
</html>