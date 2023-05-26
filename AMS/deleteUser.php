<?php 
$id=$_GET['un'];

$connection=mysqli_connect("localhost","root","","ams");

if (!$connection) 
{ die("Connection failed: " . mysqli_connect_error()); } 
echo $query="DELETE FROM `account`WHERE `id` = $id"; 
$res = mysqli_query($connection,$query); 
header('Location: admin.php?del='.$res);
?>
