<?php
 if(isset($_POST['id']) )
 {
  // include Database connection file 
  $con=mysqli_connect("localhost", "root", "", "parents");
  session_start();
  $current_user = $_SESSION['user'];
  // get values 
  $id = $_POST['id'];


$query = mysqli_query($con, "INSERT INTO friends_request ( profile_id,friend_id) VALUES ('".$current_user."', '$id')");
  


}
?>

<?php
//  if(isset($_POST['id']) )
//  {
//   // include Database connection file 
//   $con=mysqli_connect("localhost", "root", "", "parents");
//   session_start();
//   $current_user = $_SESSION['user'];
//   // get values 
//   $id = $_POST['id'];


// $tweets_query = mysqli_query($con, "INSERT INTO tweets (user_id, title,tweet) VALUES ('".$current_user."', '$title', '$tweet')");
  
// $query = "DELETE FROM users WHERE id = '$user_id'";
// if (!$result = mysqli_query($con, $query)) {
//     exit(mysqli_error($con));
// }
// }
?>