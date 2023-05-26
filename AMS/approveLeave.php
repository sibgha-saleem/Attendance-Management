<?php 
$id=$_GET['un'];

$connection=mysqli_connect("localhost","root","","ams");

if (!$connection) 
{ die("Connection failed: " . mysqli_connect_error()); } 
date_default_timezone_set("Asia/Karachi");
    $d1=strtotime("January 28 2023");
    $d2=ceil((time()-$d1)/60/60/24);
echo $query="UPDATE `attendance` SET `status` = 'Approve', `score` = '1' WHERE `id` = '$id' AND `day` = '$d2'"; 
$res = mysqli_query($connection,$query); 
header('Location: admin.php?del='.$res);
?>
