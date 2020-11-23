<?php
// include Database connection file
$con=mysqli_connect("localhost", "root", "", "parents");
session_start();
$current_user = $_SESSION['user'];
// check request
if(isset($_POST['id']) && isset($_POST['id']) != "")
{
    // get User ID
    $user_id = $_POST['id'];

    // Get User Details
    //$tweets_query = mysqli_query($con, "SELECT t.title as title,  t.tweet as tweet FROM tweets t LEFT JOIN parents p on t.user_id = p.parents_id WHERE p.parents_id = ".mysqli_real_escape_string($con, $current_user));
   $queryTweets = mysqli_query($con, "SELECT * FROM tweets WHERE id = '$user_id'");
    $response = array();
    if(mysqli_num_rows($queryTweets) > 0) {
        while ($row = mysqli_fetch_assoc($queryTweets)) {
            $response = $row;
        }
    }
    else
    {
        $response['status'] = 200;
        $response['message'] = "Data not found!";
    }
    // display JSON data
    echo json_encode($response);
}
else
{
    $response['status'] = 200;
    $response['message'] = "Invalid Request!";
}