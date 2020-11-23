<?php
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // include Database connection file
    $con=mysqli_connect("localhost", "root", "", "parents");

    // get user id


    $com_id= $_POST['id'] ;
    $_SESSION['TWEETID'] =  $tweetid;
    echo $tweetid;

    // delete User
    $query = mysqli_query($con, "DELETE FROM comments WHERE com_id = '$com_id' ");
    $data = mysqli_fetch_assoc($query);
}
?>