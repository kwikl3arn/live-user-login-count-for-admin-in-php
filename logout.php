<?php
//logout.php
include('database_connection.php');
session_start();
echo $query = "delete from login_details where user_id =".$_SESSION["login_id"];
//$query = "UPDATE login_details 
//  SET activity = '0'
//  WHERE user_id =".$_SESSION["login_id"];
 $statement =mysqli_query($connect,$query);
session_destroy();
header("location:login.php");
?>