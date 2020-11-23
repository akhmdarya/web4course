<?php
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    $con=mysqli_connect("localhost", "root", "", "parents");

    // get user id


    $tweetid= $_POST['id'] ;
    $_SESSION['TWEETID'] =  $tweetid;
    echo $tweetid;

    // delete User
    $query = mysqli_query($con, "DELETE FROM tweets WHERE id = ".mysqli_real_escape_string($con, $_SESSION['TWEETID']));
    $data = mysqli_fetch_assoc($query);
}
?>