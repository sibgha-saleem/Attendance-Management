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
  <form action ="" method ="post">
    <h1>Login</h1>
    <p style="margin-left:35px;margin-top:10px;">
      <?php 
      error_reporting(0);
      ini_set('display_errors', 0); 
        $r = $_GET['res'];
        if($r>=1){
            echo 'Account Registered, now Login'; 
          $res2 = 0;} ?>
    </p>
          
    <p style="margin-left:35px;margin-top:10px;">
        <?php
        include 'connection.php';
    
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // username and password sent from form 
        $myusername = mysqli_real_escape_string($connection,$_POST['username']);
        $mypassword = mysqli_real_escape_string($connection,$_POST['password']); 
        
        $sql = "SELECT * FROM `account` WHERE `username` = '$myusername'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_array($result);
        $count = mysqli_num_rows($result); 
        // If result matched $myusername, table row must be 1 row
            
        if($count == 1) {
            $verify = password_verify($mypassword, $row[4]);
            // Print the result depending if they match 
            if ($verify) { 
                session_start();
                $_SESSION['login_user'] = $myusername;
                echo "Password is correct";
                if($_SESSION['login_user']=="admin")
                {
                  header("location: admin.php");
                }
                else{
                  header("location: index.php");
                }
                
            }
            else 
            {
                echo "Your Password is incorrect";
            }
        }
        else 
        {
            echo "Your User Name is invalid, Register the account.";
        }
        }?>
    </p>
    <div class="content">
      <div class="input-field">
        <input type="text" placeholder="Username" name="username" autocomplete="nope">
      </div>
      <div class="input-field">
        <input type="password" placeholder="Password" name="password" autocomplete="new-password">
      </div>
    </div>
    <div class="action">
      <button><a href="register.php">Register</a></button>
      <button type="submit" >Sign in</button>
    </div>
  </form>
</div>

</body>
</html>