<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Student AMS</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'><link rel="stylesheet" href="./style.css">

</head>
<body>

<div class="heading">
    <h1 id="white"> Student</h1>
    <h1 id="blue"> AMS</h1>
</div>

<div class="login-form">
  <form method="post" action="registerAction.php" autocomplete="off">
    <h1>Register</h1>
    <p style="margin-left:35px;margin-top:10px;">
      <?php
      error_reporting(0);
      ini_set('display_errors', 0);  
        $r = $_GET['res'];
        if($r>=1){
        echo 'Already Registered with that username or email';} ?>
        </p>
    <div class="content">
      <div class="input-field">
        <input type="text" placeholder="Username" name="username" >
      </div>
      <div class="input-field">
        <input type="text" placeholder="Name" name="name" >
      </div>
      <div class="input-field">
        <input type="text" placeholder="email" name="email" >
      </div>
      <div class="input-field">
        <input type="password" placeholder="Password" name="password" >
      </div>
    </div>
    <div class="action">
      <button ><a href="index.php">Login</a></button>
      <button type="submit" >Register</button>
    </div>
  </form>
</div>


</body>
</html>