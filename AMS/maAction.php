<?php
$connection=mysqli_connect("localhost","root","","ams");
if (!$connection) 
{ die("Connection failed: " . mysqli_connect_error()); }

 $username = $_POST['username'];
 $day = $_POST['day'];
 $res2= mysqli_query($connection,"SELECT * FROM `attendance` WHERE `username`='$username' AND `day` = '$day'");
                if(mysqli_num_rows($res2)>0) 
                { 
                    echo $res1 = mysqli_query($connection,"UPDATE `attendance` SET `marked` = 'Present' , `score` = '1' WHERE `username` = '$username'AND `day` = '$day");
                }
                else{
                    $res1 = mysqli_query($connection,"INSERT INTO `attendance` (`username`, `marked`, `day`, `score`) VALUES ('$username', 'Present', '$day', '1')");
                }
 header("Location:index.php?res=$res");
?>

