<?php
//login.php
include('database_connection.php');
if(isset($_SESSION["type"]))
{
 header("location: index.php");
}
$message = '';

if(isset($_POST["login"]))
{
 if(empty($_POST["user_email"]) || empty($_POST["user_password"]))
 {
  $message = "<label>Both Fields are required</label>";
 }
 else
 {
     $email=$_POST["user_email"];
     $pass=$_POST["user_password"];
  $query = "SELECT * FROM user_details WHERE user_email = '$email' and user_password= '$pass'";
  $statement = mysqli_query($connect,$query);
  $values= mysqli_fetch_assoc($statement);
   $count= mysqli_num_rows($statement);
 
  if($count >0)
  {  
      $active='1';
     $last_activity=date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa')));
      
       $insert_query = "INSERT INTO login_details (user_id,last_activity,activity) VALUES ('".$values['user_id']."','$last_activity','$active')";
       
     $statement1 =mysqli_query($connect,$insert_query);
   $login_id=$values['user_id'];
    
     if(!empty($login_id))
     {
      $_SESSION["type"] = $values['user_type'];
      $_SESSION["login_id"] = $login_id;
     $_SESSION["email"]=$email;
     $_SESSION["active"]=$active;
      header("location: index.php");
     }

   }
  
  else
  {
   $message = "<label>Wrong Email Address</labe>";
  }
 }
}


?>

<!DOCTYPE html>
<html>
 <head>
  <title>How Display Users Online using PHP with Ajax JQuery</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   <h2 align="center">How Display Users Online using PHP with Ajax JQuery</h2>
   <br />
   <div class="panel panel-default">
    <div class="panel-heading">Login</div>
    <div class="panel-body">
     <form method="post">
      <span class="text-danger"><?php echo $message; ?></span>
      <div class="form-group">
       <label>User Email</label>
       <input type="text" name="user_email" class="form-control" />
      </div>
      <div class="form-group">
       <label>Password</label>
       <input type="password" name="user_password" class="form-control" />
      </div>
      <div class="form-group">
       <input type="submit" name="login" value="Login" class="btn btn-info" />
      </div>
     </form>
    </div>
   </div>
  </div>
 </body>
</html>
