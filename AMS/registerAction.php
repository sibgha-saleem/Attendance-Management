<?php
error_reporting(0);
ini_set('display_errors', 0); 
$res1 = 0;
$res2 = 0;
$connection = mysqli_connect("localhost","root","","ams");
        if (!$connection) 
        { die("Connection failed: " . mysqli_connect_error()); }
       
$username = $_POST['username'];
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT `id` FROM `account` WHERE `username` = '$username' OR `email` = '$email'";
$result = mysqli_query($connection, $sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$count = mysqli_num_rows($result);
$hash = password_hash($password, PASSWORD_DEFAULT);
         
if($count >= 1) {
    echo $res1 = 1; 
    header("Location:register.php?res=$res1");
}
else {
    $query = "INSERT INTO `account` (`username`, `name`, `email`, `password`, `dp`) VALUES ('$username', '$name', '$email', '$hash', 'a')"; 
    $res2 = mysqli_query($connection, $query); 
    
    date_default_timezone_set("Asia/Karachi");
    $d1=strtotime("January 28 2023");
    $d2=ceil((time()-$d1)/60/60/24);
    $query = "INSERT INTO `attendance` (`username`, `marked`, `day`) VALUES ('$username', 'Absent', '$d2')";
    $res = mysqli_query($connection, $query); 

    header("Location:login.php?res=$res2");
}
?>
 
