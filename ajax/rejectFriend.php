<?php
 if(isset($_POST['id']) )
 {
  // include Database connection file 
  $con=mysqli_connect("localhost", "root", "", "parents");
  session_start();
  $current_user = $_SESSION['user'];
  // get values 
  $id = $_POST['id'];




$queryDelete = mysqli_query($con, "DELETE FROM friends_request WHERE friend_id = '$current_user'  and profile_id='$id'");
  


}
?>