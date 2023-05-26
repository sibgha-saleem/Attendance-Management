<?php
$connection=mysqli_connect("localhost","root","","ams");
if (!$connection) 
{ die("Connection failed: " . mysqli_connect_error()); }

 $username = $_POST['username'];
 $day = $_POST['day'];
 $marked = $_POST['marked'];
 echo $query= "INSERT INTO `attendance` (`username`, `marked`, `day`) VALUES ('$username', '$marked', '$day')"; 
 $res = mysqli_query($connection,$query); 
 header("Location:admin.php?res=$res");
?>

