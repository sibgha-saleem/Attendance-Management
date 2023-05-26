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

    <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        session_start();
        if(!isset($_SESSION['login_user'])){ //if login in session is not set
            $_SESSION['login_user'];
            header("Location: login.php");
        }?>

<div class="index-div">
    <a href="logout.php"><button type="button" style="position: absolute; top: 100px ;right:610px">
                    <img src="logout.png" alt="buttonpng" border="0" width="30px">
                </button></a>
    <div class="detail">
        <?php
        $user_check = $_SESSION['login_user'];
        $connection = mysqli_connect("localhost","root","","ams");
        if (!$connection) 
        {   echo 'connection failed';
            die("Connection failed: " . mysqli_connect_error()); } 
        $query = " SELECT * from `account` WHERE `username` = '$user_check' ";
        $result = mysqli_query($connection, $query);
        if(mysqli_num_rows($result)>0) { 
            $row = mysqli_fetch_array($result); ?>
            <div style="position: relative; width: 220px;">
                <img src="<?php if ($row[5] === 'a'){
                                    echo "dp.jpg";}
                                else{
                                    echo $row[5];} ?> " class="rounded">
                <button type="button" onclick="show(1)" style="position: absolute; top: 30px ;right:40px">
                    <img src="edit.png" alt="buttonpng" border="0" width="30px">
                </button>
            </div>
            <h2 class="details-text" style="padding-top:50px"> Name: &emsp; &emsp;&emsp;<?php echo $row[2]; ?> </h2>
            <h2 class="details-text"> User Name: &ensp; <?php echo $row[1]; ?> </h2>
            <h2 class="details-text"> Email: &emsp; &emsp;&emsp;<?php echo $row[3]; ?> </h2>
        <?php }?>
           
    </div>
    
    

    <h1 style="font-weight:300;"><?php
    date_default_timezone_set("Asia/Karachi");
    $d1=strtotime("January 28 2023");
    $d2=ceil((time()-$d1)/60/60/24);
    echo "Day " . $d2 .": ";
    
    $from_time = strtotime("now"); 
    $to_time = strtotime("tomorrow 00:00:00"); 
    $query = " SELECT * from `attendance` where `username` = '$user_check' AND `day` = '$d2' AND `marked` != 'Absent'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);
    if(mysqli_num_rows($result)>0) { 
        echo $row[2] . " is Marked";}
    else{
        echo $diff_minutes = round(abs($to_time-time())/60). " minutes left to Mark Attendance";
    }
    ?></h1>
    <div class="action">
        <button type="button" onclick="show(2)" id="insert">Mark Attendance</button>
        <button type="button" onclick="show(3)" id="insert">Mark Leave</button>
        <button type="button" onclick="show(4)" id="insert">View Attendance</button>
    </div>   
</div>
    
<div id="MA" 
    style="background: #fff;      
        padding-top: 10px;
        width: 900px;
        margin: 30px auto;
        border-radius: 4px;
        box-shadow: 0 2px 25px rgba(0, 0, 0, 0.2); ">
        <h2 style="font-weight:300; text-align:center; padding: 10px;"> Mark Attendance</h2>
        <?php if(mysqli_num_rows($result)>0) {
            ?> <p style=" text-align:center; padding: 10px;"> <?php echo $row[2] . " is already Marked"; ?> </p> 
        <?php }
    else{
        ?>
        <p style=" text-align:center; padding: 10px;"> Click the button below if you want to mark your Attendance.</p>
        <form method="post" action="maAction.php" >
        <input type="hidden" name="username" value="<?php echo $user_check ?>" >
        <input type="hidden" name="day" value="<?php echo $d2 ?>" >
        <input type="submit" value="Submit Attendance" name="submit" style="
            width: 40%;
            margin-left: 30%;
            border: none;
            padding: 20px;
            font-family: 'Rubik', sans-serif;
            cursor: pointer;
            text-transform: uppercase;
            background: #2d3b55;
            color: #fff;
            border-bottom-right-radius: 4px;
            border-bottom-left-radius: 4px;
            letter-spacing: 0.2px;
            outline: 0;">
    </form> <?php } ?>
</div>

<div id="ML" 
    style="background: #fff;
        padding-top: 10px;
        width: 900px;
        margin: 30px auto;
        border-radius: 4px;
        box-shadow: 0 2px 25px rgba(0, 0, 0, 0.2); ">
        <h2 style="font-weight:300; text-align:center; padding: 10px;"> Mark Leave</h2>
        <?php if(mysqli_num_rows($result)>0) {
            ?> <p style=" text-align:center; padding: 10px;"> <?php echo $row[2] . " is aleady Marked";; ?> </p> 
        <?php }
    else{
        ?>
        <p style=" text-align:center; padding: 10px;"> Fill the form below and click the button if you want to mark your leave.</p>
        <form method="post" action="mlAction.php" style="text-align: center;">
        <input type="hidden" name="username" value="<?php echo $user_check ?>" >
        <input type="hidden" name="day" value="<?php echo $d2 ?>" >
        <input type="text" name="reason" placeholder="Enter Reason of Leave" style="font-size: 16px;
        display: block;
        font-family: 'Rubik', sans-serif;
        width: 50%;
        padding: 10px;
        margin: 10px;
        margin-left: 25%;
        border: 0;
        border-bottom: 1px solid #747474;
        outline: none;"></br>
        <p style="color: #747474;letter-spacing: 0.2px; margin-left:25%; text-align:left; padding: 10px; font-family: 'Rubik', sans-serif;"> Enter Details of your Leave below.</p>
        <textarea rows = "5" cols = "70" name = "text" style="font-size: 16px;
        display: block;
        font-family: 'Rubik', sans-serif;
        width: 50%;
        padding: 10px;
        margin: 10px;
        margin-left: 25%;
        border: 0;
        border-bottom: 1px solid #747474;
        outline: none;">
         </textarea>
        <input type="submit" value="Submit Leave" name="submit" style="
            width: 40%;
            border: none;
            padding: 20px;
            font-family: 'Rubik', sans-serif;
            cursor: pointer;
            text-transform: uppercase;
            background: #2d3b55;
            color: #fff;
            border-bottom-right-radius: 4px;
            border-bottom-left-radius: 4px;
            letter-spacing: 0.2px;
            outline: 0;">
    </form> <?php } ?>
</div>

<div id="VA" 
    style="background: #fff;
        padding-top: 10px;
        width: 900px;
        margin: 30px auto;
        border-radius: 4px;
        box-shadow: 0 2px 25px rgba(0, 0, 0, 0.2); ">
        <h2 style="font-weight:300; text-align:center; padding: 10px;"> View Attendance</h2>
        <p style=" text-align:center; padding: 10px;"> Following is the your attendance of all days.</p>
        
        <?php $query="SELECT * FROM `attendance`WHERE `username` = '$user_check' ORDER BY `day` ASC"; 
        $result = mysqli_query($connection,$query); 
        $count = 1;
        if(mysqli_num_rows($result)>0) 
        { ?>
            <table border="0" align="center" style="padding:10px; margin-left: 20%;font-family: 'Rubik', sans-serif;">
            <tr>
                <td width="130" height="42" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Sr no.</td>
                <td width="130" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Day</td>
                <td width="130" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Marked</td>
                <td width="130" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;"> Status</td>
            </tr> 
            <?php while($row=mysqli_fetch_array($result)) 
            { ?> 
            <tr>
                <td height="42" bgcolor="#e8e9ec"><div align="center"><?php echo $count; ?></div></td>
                <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[3]; ?></div></td>
                <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[2]; ?></div></td>
                <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[6]; ?></div></td>
            </tr>
            <?php }} ?>
            </table>

</div>

<div id="DP" 
style="background: #fff;
    padding-top: 10px;
    width: 900px;
    margin: 30px auto;
    border-radius: 4px;
    box-shadow: 0 2px 25px rgba(0, 0, 0, 0.2); display: -webkit-box;
    display: block;">
    <h2 style="font-weight:300; text-align:center; padding: 10px;"> Edit Display Picture</h2>
    <form method="post" action="dpAction.php" enctype="multipart/form-data">
        <input type="hidden" name="username" value="<?php echo $user_check ?>" >
        <input type="file" name="pic" style="
        width: 49.8%;
    border: none;
    padding: 18.5px;
    font-family: 'Rubik', sans-serif;
    cursor: pointer;
    text-transform: uppercase;
    background: #e8e9ec;
    color: #777;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 0;
    letter-spacing: 0.2px;
    outline: 0;">
        <input type="submit" value="Upload Image" name="submit" style="
        width: 49.75%;
    border: none;
    padding: 20px;
    font-family: 'Rubik', sans-serif;
    cursor: pointer;
    text-transform: uppercase;
    background: #2d3b55;
    color: #fff;
    border-bottom-right-radius: 4px;
    border-bottom-left-radius: 0;
    letter-spacing: 0.2px;
    outline: 0;">
    </form>
</div>
</body>
</html>

<script type="text/javascript">

  window.onload = function() {

    document.getElementById("MA").style.display = "none";
    document.getElementById("ML").style.display = "none";
    document.getElementById("VA").style.display = "none";
    document.getElementById("DP").style.display = "none";
  };

  function show(a) {
    if (a == 1) {
        
      document.getElementById("DP").style.display = "block";
    } 
    else if (a == 2){
        
        document.getElementById("MA").style.display = "block";
    }
    else if (a == 3){
        
        document.getElementById("ML").style.display = "block";
    }
    else if (a == 4){
        
        document.getElementById("VA").style.display = "block";
    }
    else {
      document.getElementById("MA").style.display = "none";
    }   
  }

</script>
<div class="main">
        <div class="main-left">
            <h1> Powering the digital business simply </h1>
            <p>We provides you with user management functionality that results in faster development, faster revenue, more users.</p>
            <button type="button"><a href="get-started.html">Get Started</a></button>
            <h2> Companies that trust us</h2>
            <div class="img-button">
                <button type="button">
                    <img src="main-design.png" alt="buttonpng" border="0" width="30px">
                </button>
                <button type="button" >
                    <img src="main-dm.png" alt="buttonpng" border="0" width="30px">
                </button>
                <button type="button" >
                    <img src="main-21.png" alt="buttonpng" border="0" width="30px">
                </button>
            </div>
        </div>

        <div class="main-right">
            <img src="main-image.png" alt="buttonpng" border="0" width="30px">
        </div>
    </div>

    