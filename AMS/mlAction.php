<?php
$connection=mysqli_connect("localhost","root","","ams");
if (!$connection) 
{ die("Connection failed: " . mysqli_connect_error()); }

 $username = $_POST['username'];
 $day = $_POST['day'];
 $reason = $_POST['reason'];
 $text = $_POST['text'];
 $res2= mysqli_query($connection,"SELECT * FROM `attendance` WHERE `username`='$username' AND `day` = '$day'");
    if(mysqli_num_rows($res2)>0) 
    { 
        $res1 = mysqli_query($connection,"UPDATE `attendance` SET `marked` = 'Leave' , `reason` = '$reason' , `text` = '$text' , `status` = 'Pending' WHERE `username` = '$username'AND `day` = '$day");
    }
    else{
        $res1 = mysqli_query($connection,"INSERT INTO `attendance` (`username`, `marked`, `day`, `reason`, `text`, `status`) VALUES ('$username', 'Leave', '$day', '$reason', '$text', 'Pending')");
    }
 header("Location:index.php?res=$res");
?>

