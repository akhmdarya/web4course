<?php
// include Database connection file
$con=mysqli_connect("localhost", "root", "", "parents");


// if($_SERVER['REQUEST_METHOD']=='POST'){
//     if(isset($_POST['tweet_id'])){
      $tweetid= $_POST['id'] ;
     // $_SESSION['TWEETID'] =  $tweetid;
    //  echo $tweetid;
    // }
    // else{
    //     echo $err= 'ОШИБКА';
    //   }
// check request
if(isset($_POST))
{
    // get values
    $id = $_POST['id'];
    $title = $_POST['title'];
    $tweet = $_POST['tweet'];
    

    // Updaste User details
    //$query = "UPDATE tweets SET title = '$title', tweet = '$tweet' WHERE id='".mysqli_real_escape_string($con, $_SESSION['TWEETID'])."' LIMIT 1 ";
    $query = "UPDATE tweets SET title = '$title', tweet = '$tweet' WHERE id='$id' ";
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));








    }
}