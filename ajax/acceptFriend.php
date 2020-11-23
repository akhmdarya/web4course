<?php
 if(isset($_POST['id']) )
 {
  // include Database connection file 
  $con=mysqli_connect("localhost", "root", "", "parents");
  session_start();
  $current_user = $_SESSION['user'];
  // get values 
  $id = $_POST['id'];


$query = mysqli_query($con, "INSERT INTO friends ( profile_id,friend_id) VALUES ('".$current_user."', '$id')");
 $query1 = mysqli_query($con, "INSERT INTO chats ( profile_id,friend_id) VALUES ('".$current_user."', '$id')");
$queryDelete = mysqli_query($con, "DELETE FROM friends_request WHERE friend_id = '$current_user'  and profile_id='$id'");
  


}
?>