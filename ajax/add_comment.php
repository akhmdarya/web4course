<?php

//add_comment.php

$connect = new PDO('mysql:host=localhost;dbname=parents', 'root', '');
session_start();
$con=mysqli_connect("localhost", "root", "", "parents");


$current_user = $_SESSION['user'];
$error = '';
$comment_name = $current_user ;
$comment_content = '';

// if(empty($_POST["comment_name"]))
// {
//  $error .= '<p class="text-danger">Name is required</p>';
// }
// else
// {
//  $comment_name = $_POST["comment_name"];
// }

if(empty($_POST["add_comment"]))
{
 $error .= '<p class="text-danger">Comment is required</p>';
}
else
{
 $comment_content = $_POST["add_comment"];
}

if($error == '')
{
    $query = "
    INSERT INTO comments 
    (com_post_id, com_text, com_user) 
    VALUES (:parent_comment_id, :comment, :comment_sender_name)
    ";
    $statement = $connect->prepare($query);
    $statement->execute(
     array(
      ':parent_comment_id' => $_POST["tweet_id"],
      ':comment'    => $comment_content,
      ':comment_sender_name' => $comment_name
     )
    );
    $error = '<label class="text-success">Comment Added</label>';
   }
   
   $data = array(
    'error'  => $error
   );
   
   echo json_encode($data);
   
   ?>