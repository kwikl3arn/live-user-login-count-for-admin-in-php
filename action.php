<?php
//action.php
include('database_connection.php');

 if($_POST["action"] == "fetch_data")
 {
  $output = '';
  $query = "
  SELECT login_details.user_id, user_details.user_email, user_details.user_image FROM login_details 
  INNER JOIN user_details 
  ON user_details.user_id = login_details.user_id 
 WHERE  user_details.user_type = 'user' and activity='1'
  ";
 
   $statement =mysqli_query($connect,$query);
 
 $count= mysqli_num_rows($statement);
  
  $output .= '
  <div class="table-responsive">
   <div align="right">
    '.$count.' Users Online
   </div>
   <table class="table table-bordered table-striped">
    <tr>
     <th>No.</th>
     <th>Email ID</th>
     <th>Image</th>
    </tr>
  ';

  $i = 0;
 
  
while($row = mysqli_fetch_assoc($statement))
  { 
   $i = $i + 1;
   $output .= '
   <tr> 
    <td>'.$i.'</td>
    <td>'.$row["user_email"].'</td>
    <td><img src="images/'.$row["user_image"].'" class="img-thumbnail" width="50" /></td>
   </tr>
   
   ';
  }

 $output .= '</table></div>';
  echo $output;
 }

?>
