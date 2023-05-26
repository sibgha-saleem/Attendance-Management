<?php
$connection=mysqli_connect("localhost","root","","ams");
if (!$connection) 
{ die("Connection failed: " . mysqli_connect_error()); }

echo $_POST['username'];
 $username = $_POST['username'];
 $pic_name=$_FILES['pic']['name'];
 $pic_type = $_FILES['pic']['type'];
 $pic_size=$_FILES['pic']['size'];
 $pic_tmpname= $_FILES['pic']['tmp_name'];
if($pic_size<10000000 ) 
{ $destination= "uploads/".rand().$pic_name; move_uploaded_file($pic_tmpname,$destination); 
  echo $query=" UPDATE `account` SET `dp` = '$destination' WHERE `username` = '$username' "; 
  $res = mysqli_query($connection,$query); 
  header("Location:index.php?res=$res");
} 
?>

