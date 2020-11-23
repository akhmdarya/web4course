<?php
 if(isset($_POST['title']) && isset($_POST['tweet']))
 {
  // include Database connection file 
  $con=mysqli_connect("localhost", "root", "", "parents");
  session_start();
  $current_user = $_SESSION['user'];
  // get values 
  $title = $_POST['title'];
  $tweet = $_POST['tweet'];

  //$query = "INSERT INTO tweets(title, tweet) VALUES('$first_name', '$last_name', '$email')";


//  $tweets_query = mysqli_query($con, "INSERT INTO tweets (user_id, tweet) VALUES ('".$current_user."', '".mysqli_real_escape_string($con, $_POST['tweet'])."') ");

$tweets_query = mysqli_query($con, "INSERT INTO tweets (user_id, title,tweet) VALUES ('".$current_user."', '$title', '$tweet')");
  
$query = "DELETE FROM users WHERE id = '$user_id'";
if (!$result = mysqli_query($con, $query)) {
    exit(mysqli_error($con));
}
}
?>