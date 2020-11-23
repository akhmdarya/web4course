<?php
 if(isset($_POST['id']) )
 {
  // include Database connection file 
  $con=mysqli_connect("localhost", "root", "", "parents");
  session_start();
  $current_user = $_SESSION['user'];
  // get values 
  $message = $_POST['message'];
  $chatID= $_POST['id'] ;

$query = mysqli_query($con, "INSERT INTO messages ( sender, text ,chat_id ) VALUES ('".$current_user."', '$message', '$chatID')");
  


}
?>