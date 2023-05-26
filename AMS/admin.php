<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Student AMS</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'><link rel="stylesheet" href="./adminStyle.css">

</head>
<body>
<div class="sidebar">
        <div class="heading">
            <h1 id="white"> Student</h1>
            <h1 id="blue"> AMS</h1>
        </div>
        <div class="nav-links">
            <button type="button" onclick="show(1)" id="insert">Dashboard</button>
            <button type="button" onclick="show(2)" id="insert">Registered Students</button>
            <button type="button" onclick="show(3)" id="insert">Attendance</button>
            <button type="button" onclick="show(4)" id="insert">Leaves Approval</button>
            <button type="button" onclick="show(5)" id="insert">Report</button>
            <button type="button" onclick="show(6)" id="insert">Grades</button>
        </div>
</div>

  <?php
    session_start();
    if($_SESSION['login_user']!="admin"){ //if person other than admin tries to reach
    header("Location: index.php");
    }

    error_reporting(E_ALL);
    ini_set('display_errors', 0);
    date_default_timezone_set("Asia/Karachi");
    $d1=strtotime("January 28 2023");
    $d2=ceil((time()-$d1)/60/60/24);
    
    $connection = mysqli_connect("localhost","root","","ams");
                    if (!$connection) 
                    {   echo 'connection failed';
                        die("Connection failed: " . mysqli_connect_error()); } 

    
    $query="SELECT * FROM `attendance` WHERE `day`='$d2'"; 
    $result = mysqli_query($connection,$query);
    if(mysqli_num_rows($result)==0){
        $query_sum = "SELECT * FROM `account` WHERE `username` != 'admin'";
        $res = mysqli_query($connection,$query_sum);
        while($row=mysqli_fetch_array($res)) 
        {
            $query="INSERT INTO `attendance` (`username`, `marked`, `day`) VALUES ('$row[1]', 'Absent', '$d2')"; 
            $result = mysqli_query($connection,$query);
        }
    }

    $query_sum = "SELECT * FROM `account` WHERE `username` != 'admin'";
    $res = mysqli_query($connection,$query_sum);
    $total_students = mysqli_num_rows($res); 

    $query_sum = "SELECT * FROM `attendance` WHERE `marked` = 'Present'";
    $res = mysqli_query($connection,$query_sum);
    $present_students = mysqli_num_rows($res);

    $query_sum = "SELECT * FROM `attendance` WHERE `marked` = 'Absent' AND `username` != 'admin'";
    $res = mysqli_query($connection,$query_sum);
    $absent_students = mysqli_num_rows($res);

    $query_sum = "SELECT * FROM `attendance` WHERE `marked` = 'Leave'";
    $res = mysqli_query($connection,$query_sum);
    $leave_students = mysqli_num_rows($res);
    
    $query_sum = "SELECT * FROM `attendance` WHERE `status` = 'Pending'";
    $res = mysqli_query($connection,$query_sum);
    $leave_pending = mysqli_num_rows($res);

    $query_sum = "SELECT * FROM `attendance` WHERE `status` = 'Approve'";
    $res = mysqli_query($connection,$query_sum);
    $leave_approve = mysqli_num_rows($res);

    $query_sum = "SELECT * FROM `attendance` WHERE `status` = 'Disapprove'";
    $res = mysqli_query($connection,$query_sum);
    $leave_disapprove = mysqli_num_rows($res);

    $dataPoints = array( 
        array("label"=>"Present", "y"=>($present_students/($total_students*$d2))*100),
        array("label"=>"Absent", "y"=>($absent_students/($total_students*$d2))*100),
        array("label"=>"Leave", "y"=>($leave_students/($total_students*$d2))*100),
    );
    ?>

  <section class="home-section">
    <div id="DB">
        <nav>
            <span class="dashboard">Dashboard</span>
            <a href="logout.php"><button type="button" style="position: absolute; top: 20px ;right:40px">
                    <img src="logout.png" alt="buttonpng" border="0" width="30px">
                </button></a>
        </nav>

        <div class="home-content">
            <div class="overview-boxes">
                <div class="box">
                <div class="right-side">
                    <div class="box-topic">Total Students</div>
                    <div class="number"><?php echo $total_students ?></div>
                    <div class="indicator">
                    <span class="text">of <?php echo $d2 ?> Days </span>
                    </div>
                </div>
                </div>
                <div class="box">
                <div class="right-side">
                    <div class="box-topic">Total Present</div>
                    <div class="number"><?php echo $present_students ?></div>
                    <div class="indicator">
                    <span class="text">of  <?php echo $d2 ?> Days</span>
                    </div>
                </div>
                </div>
                <div class="box">
                <div class="right-side">
                    <div class="box-topic">Total Absent</div>
                    <div class="number"><?php echo $absent_students ?></div>
                    <div class="indicator">
                    <span class="text">of  <?php echo $d2 ?> Days</span>
                    </div>
                </div>
                </div>
                <div class="box">
                <div class="right-side">
                    <div class="box-topic">Total Leaves</div>
                    <div class="number"><?php echo $leave_students ?></div>
                    <div class="indicator">
                    <span class="text">of  <?php echo $d2 ?> Day</span>
                    </div>
                </div>
                </div>
            </div>

            <div class="leave-boxes" >
                <div class="content_box" style="float:left;margin-bottom:30%;">
                    <div class="title">Leave Status</div>
                    <?php 
                        $query="SELECT * FROM `attendance` WHERE `marked`='Leave' ORDER BY `day` ASC"; 
                        $result_a = mysqli_query($connection,$query);
                        if(mysqli_num_rows($result_a)>0) 
                        { ?>
                            <table border="0" align="center" style="padding:10px; font-family: 'Rubik', sans-serif; margin-left:auto;margin-right:auto;">
                                <tr>
                                    <td width="200" height="42" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Username</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Day</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;"> Status</td>
                                </tr> 
                                <?php while($row=mysqli_fetch_array($result_a)) 
                                { ?> 
                                <tr>
                                    <td height="42" bgcolor="#e8e9ec"><div align="center" ><?php echo $row[1]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[3]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[6]; ?></div></td>
                                </tr>
                            <?php }?>
                            </table>
                        <?php } ?>
                </div>
            </div>
            <div class="leave-boxes">
                <div class="content_box">
                    <div id="chartContainer" style="height: 500px; "></div>
                    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                </div>
            </div>

            
        </div>
    </div>
                    
    <div id="RS">
        <nav>
            <span class="dashboard">Registered Students</span>
        </nav>
        <div class="home-content">
            <div class="overview-boxes" style="margin-left:40%; width:100%; text-align:center;">
            <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Registered Students</div>
                        <div class="number"><?php echo $total_students ?></div>
                        
                    </div>
                </div>
            </div>

            <div class="rs-boxes" style="width:98%">
                <div class="content_box">
                    <?php 
                    
                    $query="SELECT * FROM `account` WHERE `username` != 'admin' "; 
                    $result = mysqli_query($connection,$query); 
                    $count = 1;
                    if(mysqli_num_rows($result)>0) 
                        { ?>
                            <table border="0" align="center" style="padding:10px; margin-left: 12%;font-family: 'Rubik', sans-serif;">
                                <tr>
                                    <td width="200" height="42" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Sr no.</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Username</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Name</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;"> Email</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;"> Profile Picture</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;"> Actions</td>
                                </tr> 
                                <?php while($row=mysqli_fetch_array($result)) 
                                { ?> 
                                <tr>
                                    <td height="42" bgcolor="#e8e9ec"><div align="center"><?php echo $count; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[1]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[2]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[3]; ?></div></td>
                                    <td> <img src="<?php echo $row[5]; ?>" height="100"  /></td>
                                    <td bgcolor="#e8e9ec"><div align="center"><a href="deleteUser.php?un=<?php echo $row[0]; ?>" onclick="return 
                                        confirm('Do you really want to delete this record?')  "  >DELETE</a></div></td>
            
                                </tr>
                                <?php $count++;}?>
                            </table>
                        <?php } ?>
                    
                </div>
            </div>
        </div>
    </div>

    <div id="A">
        <nav>
            <span class="dashboard">Attendance</span>
        </nav> 
        <div class="home-content">
            <div class="overview-boxes">
                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Students</div>
                        <div class="number"><?php echo $total_students ?></div>
                        <div class="indicator">
                        <span class="text">of  <?php echo $d2 ?> Day</span>
                        </div>
                    </div>
                </div>

                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Present</div>
                        <div class="number"><?php echo $present_students ?></div>
                        <div class="indicator">
                        <span class="text">of  <?php echo $d2 ?> Day</span>
                        </div>
                    </div>
                </div>

                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Absent</div>
                        <div class="number"><?php echo $absent_students ?></div>
                        <div class="indicator">
                        <span class="text">of  <?php echo $d2 ?> Day</span>
                        </div>
                    </div>
                </div>

                <div class="box">
                    <div class="right-side">
                        <div class="box-topic">Total Leaves</div>
                        <div class="number"><?php echo $leave_students ?></div>
                        <div class="indicator">
                        <span class="text">of  <?php echo $d2 ?> Day</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rs-boxes" style="width:98%">
                <div class="content_box">
                    <p style="margin-left:38%; display:inline-block;"> If you want to add record click the button</p>
                    <button type="button" onclick="show(7)" style="display:inline-block;">Add Attendance</button>
                    <?php 
                        $query="SELECT * FROM `attendance` WHERE `username` != 'admin' ORDER BY `day` ASC"; 
                        $result_a = mysqli_query($connection,$query); 
                        $count = 1;
                        if(mysqli_num_rows($result_a)>0) 
                        { ?>
                            <table border="0" align="center" style="padding:10px; margin-left: 15%;font-family: 'Rubik', sans-serif;">
                                <tr>
                                    <td width="200" height="42" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Sr no.</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Username</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Day</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Marked</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;"> Status</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;"> Actions</td>
                                </tr> 
                                <?php while($row=mysqli_fetch_array($result_a)) 
                                {
                               ?> 
                                <tr>
                                    <td height="42" bgcolor="#e8e9ec"><div align="center"><?php echo $count; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[1]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[3]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[2]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[6]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center"><a href="deleteAttendance.php?un=<?php echo $row[0]; ?>" onclick="return 
                                        confirm('Do you really want to approve this leave?')  "  >DELETE</a></div></td>
                                </tr>
                            <?php $count++;}?>
                            </table>
                        <?php } ?>
                    
                </div>
            </div>
            
            <div id="AR">
                <div class="rs-boxes" style="width:98%; margin-top:20px;">
                    <div class="content_box">
                        <p>Add Record</p>
                        <form method="post" action="addRecordAction.php" style="text-align: center;">
                            <input type="text" name="username" placeholder="Enter Username" style="font-size: 16px;
                                display: block;
                                font-family: 'Rubik', sans-serif;
                                width: 50%;
                                padding: 10px;
                                margin: 10px;
                                margin-left: 25%;
                                border: 0;
                                border-bottom: 1px solid #747474;
                                outline: none;"></br>
                            <input type="int" name="day" placeholder="Enter Day" style="font-size: 16px;
                                display: block;
                                font-family: 'Rubik', sans-serif;
                                width: 50%;
                                padding: 10px;
                                margin: 10px;
                                margin-left: 25%;
                                border: 0;
                                border-bottom: 1px solid #747474;
                                outline: none;"></br>
                            <input type="text" name="marked" placeholder="Enter Attendance Status" style="font-size: 16px;
                                display: block;
                                font-family: 'Rubik', sans-serif;
                                width: 50%;
                                padding: 10px;
                                margin: 10px;
                                margin-left: 25%;
                                border: 0;
                                border-bottom: 1px solid #747474;
                                outline: none;"></br>
                            <input type="submit" value="Submit Attendance" name="submit" style="
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
                        </form>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div id="LA">
        <nav>
            <span class="dashboard">Leave Approval</span>
        </nav> 
        <div class="home-content">
            <div class="overview-boxes">
                <div class="box" style="text-align:center">
                    <div class="right-side">
                        <div class="box-topic">Total Leaves</div>
                        <div class="number"><?php echo $leave_students ?></div>
                    </div>
                </div>

                <div class="box" style="text-align:center">
                    <div class="right-side">
                        <div class="box-topic">Pending Leaves</div>
                        <div class="number"><?php echo $leave_pending ?></div>
                    </div>
                </div>

                <div class="box" style="text-align:center">
                    <div class="right-side">
                        <div class="box-topic">Approved Leaves</div>
                        <div class="number"><?php echo $leave_approve ?></div>
                    </div>
                </div>

                <div class="box" style="text-align:center">
                    <div class="right-side">
                        <div class="box-topic">Disapproved Leaves</div>
                        <div class="number"><?php echo $leave_disapprove ?></div>
                    </div>
                </div>
            </div>

            <div class="rs-boxes" style="width:98%">
                <div class="content_box">
                    <?php 
                        $query="SELECT * FROM `attendance` WHERE `marked`='Leave' ORDER BY `day` ASC"; 
                        $result_a = mysqli_query($connection,$query); 
                        $count = 1;
                        if(mysqli_num_rows($result_a)>0) 
                        { ?>
                            <table border="0" align="center" style="padding:10px; font-family: 'Rubik', sans-serif;">
                                <tr>
                                    <td width="200" height="42" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Sr no.</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Username</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Day</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Marked</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Reason</td>
                                    <td width="400" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Description</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;"> Status</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;"> Actions</td>
                                </tr> 
                                <?php while($row=mysqli_fetch_array($result_a)) 
                                { ?> 
                                <tr>
                                    <td height="42" bgcolor="#e8e9ec"><div align="center"><?php echo $count; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[1]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[3]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[2]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[4]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[5]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[6]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center"><a href="approveLeave.php?un=<?php echo $row[0]; ?>" onclick="return 
                                        confirm('Do you really want to approve this leave?')  "  >Approve</a><br>
                                        <a href="disapproveLeave.php?un=<?php echo $row[0]; ?>" onclick="return 
                                        confirm('Do you really want to delete this record?')  "  >Disapprove</a><br></div></td>
                                </tr>
                            <?php $count++;}?>
                            </table>
                        <?php } ?>
                    
                </div>
            </div>
        </div>
    </div>

    <div id="R">
        <nav>
            <span class="dashboard">Report</span>
        </nav>
        <div class="home-content">
            <div class="overview-boxes" style="width:100%; margin-left:28%">
                <div class="box" style="width:40%;">
                    <div class="right-side">
                        <div class="box-topic">Filter</div>
                        <form action="admin.php" method="post">
                            From Day
                            <input type="int" name="from"/>
                            To Day
                            <input type="int" name="to"/>
                            <input type="submit"/>
                        </form>
                    </div>
                </div>
            </div> 
            
            <div class="rs-boxes" style="width:98%">
                <div class="content_box">
                    <p style="text-align:center"> Showing Results from Day <?php $from = $_POST['from'];
                        $to = $_POST['to']; echo $from; ?> To Day <?php echo $to; ?> </p>

                    <?php
                        
                        $query="SELECT * FROM `attendance` WHERE `day`BETWEEN '$from' AND '$to' AND `username` != 'admin' ORDER BY `day` ASC"; 
                        $result_a = mysqli_query($connection,$query); 
                        $count = 1;
                        if(mysqli_num_rows($result_a)>0) 
                        { ?>
                            <table border="0" align="center" style="padding:10px; margin-left:2%; font-family: 'Rubik', sans-serif;">
                                <tr>
                                    <td width="200" height="42" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Sr no.</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Username</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Day</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Marked</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Reason</td>
                                    <td width="400" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Description</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;"> Status</td>
                                </tr> 
                                <?php while($row=mysqli_fetch_array($result_a)) 
                                { ?> 
                                <tr>
                                    <td height="42" bgcolor="#e8e9ec"><div align="center"><?php echo $count; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[1]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[3]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[2]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[4]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[5]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[6]; ?></div></td>
                                </tr>
                            <?php $count++;}?>
                            </table>
                    <?php } ?>
                          
                </div>
            </div>
        </div>
    
    </div>

    <?php
    $query="SELECT `username` FROM `attendance`"; 
    $result = mysqli_query($connection,$query); 
    $count = 0;
    if(mysqli_num_rows($result)>0) 
    {  
         while($row=mysqli_fetch_array($result)) 
            { 
                $query_sum = "SELECT SUM(score) AS `value_sum` FROM `attendance` WHERE `username`='$row[$count]'";
                $res = mysqli_query($connection,$query_sum);
                $row_sum = mysqli_fetch_assoc($res); 
                $sum = $row_sum['value_sum'];
                $percentage = ceil(($sum/$d2)*100);
                if($percentage >= 90 && $percentage <= 100){
                    $grade="A";
                }
                else if($percentage >= 80 && $percentage < 90){
                    $grade="B";
                }
                else if($percentage >= 70 && $percentage < 80){
                    $grade="C";
                }
                else if($percentage >= 60 && $percentage < 70){
                    $grade="D";
                }
                else if($percentage >= 50 && $percentage < 60){
                    $grade="F";
                }
                $grade;
                $res2= mysqli_query($connection,"SELECT * FROM `grade` WHERE `username`='$row[$count]'");
                if(mysqli_num_rows($res2)>0) 
                { 
                    $res1 = mysqli_query($connection,"UPDATE `grade` SET `score` = '$sum', `grades` = '$grade' WHERE `username` = '$row[$count]'");
                }
                else{
                    $res1 = mysqli_query($connection,"INSERT INTO `grade` (`username`, `score`, `grades`) VALUES ('$row[$count]', '$sum', '$grade')");
                }    
            }            
    } ?>

    <div id="G">
        <nav>
            <span class="dashboard">Grades</span>
        </nav>
        <div class="home-content">

            <div class="rs-boxes" style="width:98%">
                <div class="content_box">
                <?php
                    
                        $query="SELECT * FROM `grade` WHERE `username` != 'admin' "; 
                        $result_a = mysqli_query($connection,$query); 
                        $count = 1;
                        if(mysqli_num_rows($result_a)>0) 
                        { ?>
                            <table border="0" align="center" style="padding:10px; margin-left:10%; font-family: 'Rubik', sans-serif;">
                                <tr>
                                    <td width="200" height="42" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Sr no.</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Username</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Total Days</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Days Present/Leave</td>
                                    <td width="200" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Days Absent</td>
                                    <td width="400" bgcolor="#2d3b55" style="color:#fff;text-transform: uppercase; text-align:center;">Grade</td>
                                </tr> 
                                <?php while($row=mysqli_fetch_array($result_a)) 
                                { ?> 
                                <tr>
                                    <td height="42" bgcolor="#e8e9ec"><div align="center"><?php echo $count; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[1]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $d2; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[2]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $d2-$row[2]; ?></div></td>
                                    <td bgcolor="#e8e9ec"><div align="center" ><?php echo $row[3]; ?></div></td>
                                </tr>
                            <?php $count++;}?>
                            </table>
                    <?php } ?>
                          
                </div>
            </div>
        
        </div>
    </div>
  </section>

  <script type="text/javascript" >

  window.onload = function() {

    var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Attendance Status of <?php echo $d2 ?> Days"
	},
	data: [{
		type: "pie",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
        });
        chart.render();

    document.getElementById("DB").style.display = "block";
    document.getElementById("RS").style.display = "none";
    document.getElementById("A").style.display = "none";
    document.getElementById("LA").style.display = "none";
    document.getElementById("R").style.display = "none";
    document.getElementById("G").style.display = "none";
    document.getElementById("AR").style.display = "none";
  };
  

  function show(a) {
    if (a == 1) { 
        document.getElementById("DB").style.display = "block";
        document.getElementById("RS").style.display = "none";
        document.getElementById("A").style.display = "none";
        document.getElementById("LA").style.display = "none";
        document.getElementById("R").style.display = "none";
        document.getElementById("G").style.display = "none";
        document.getElementById("AR").style.display = "none";
    } 
    else if (a == 2){
       
        document.getElementById("DB").style.display = "none";
        document.getElementById("RS").style.display = "block";
        document.getElementById("A").style.display = "none";
        document.getElementById("LA").style.display = "none";
        document.getElementById("R").style.display = "none";
        document.getElementById("G").style.display = "none";
    }
    else if (a == 3){
        document.getElementById("DB").style.display = "none";
        document.getElementById("RS").style.display = "none";
        document.getElementById("A").style.display = "block";
        document.getElementById("LA").style.display = "none";
        document.getElementById("R").style.display = "none";
        document.getElementById("G").style.display = "none";
        document.getElementById("AR").style.display = "none";
    }
    else if (a == 4){
        document.getElementById("DB").style.display = "none";
        document.getElementById("RS").style.display = "none";
        document.getElementById("A").style.display = "none";
        document.getElementById("LA").style.display = "block";
        document.getElementById("R").style.display = "none";
        document.getElementById("G").style.display = "none";
        document.getElementById("AR").style.display = "none";
    }
    else if (a == 5){
        document.getElementById("DB").style.display = "none";
        document.getElementById("RS").style.display = "none";
        document.getElementById("A").style.display = "none";
        document.getElementById("LA").style.display = "none";
        document.getElementById("R").style.display = "block";
        document.getElementById("G").style.display = "none";
        document.getElementById("AR").style.display = "none";
    }
    else if (a == 7){
        document.getElementById("DB").style.display = "none";
        document.getElementById("RS").style.display = "none";
        document.getElementById("A").style.display = "block";
        document.getElementById("LA").style.display = "none";
        document.getElementById("R").style.display = "none";
        document.getElementById("G").style.display = "none";
        document.getElementById("AR").style.display = "block";
    }
    else {
        document.getElementById("DB").style.display = "none";
        document.getElementById("RS").style.display = "none";
        document.getElementById("A").style.display = "none";
        document.getElementById("LA").style.display = "none";
        document.getElementById("R").style.display = "none";
        document.getElementById("G").style.display = "block";
        document.getElementById("AR").style.display = "none";
    }   
  }



</script>