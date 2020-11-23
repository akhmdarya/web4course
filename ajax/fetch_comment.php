<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<?php
  $con=mysqli_connect("localhost", "root", "", "parents");

  session_start();
  $current_user = $_SESSION['user'];
//fetch_comment.php

$connect = new PDO('mysql:host=localhost;dbname=parents', 'root', '');
//$tweetid=0;
if(isset($_POST['tweet_id']) && isset($_POST['tweet_id']) != "")
{
$tweetid= $_POST['tweet_id'] ;
}
else{
    $tweetid=1;   
}
//$query = mysqli_query($con, "SELECT t.id as id, p.parents_login as parents_login, p.parents_img as img FROM tweets t LEFT JOIN comments c on t.id = c.com_post_id LEFT JOIN parents p on t.user_id = p.parents_id WHERE c.com_post_id='$tweetid' AND p.parents_id = ".mysqli_real_escape_string($con, $current_user));


//как-то вытащить твит айди нынешний
///объединить 3 таблицы и туда вписать номер твита

$output1=$tweetid;

//$query = "SELECT c.com_user as com_user, c.com_date as com_date, c.com_text as com_text, c.com_id as com_id t.id as id, p.parents_login as parents_login, p.parents_img as img FROM tweets t LEFT JOIN comments c on t.id = c.com_post_id LEFT JOIN parents p on t.user_id = p.parents_id WHERE c.com_post_id='62'ORDER BY com_id DESC";
//current tweet ==$tweetid

// $query = "SELECT * FROM comments 
// WHERE com_post_id = '62' 
// ORDER BY com_id DESC";
$query = "SELECT * FROM tweets  LEFT JOIN comments on tweets.id = comments.com_post_id WHERE comments.com_post_id= tweets.id ORDER BY comments.com_id DESC";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();
$output = '';
//$output1 = '';

foreach($result as $row)
{
 $output .= '
 <div class="post">
 <div class="panel-heading">By <b>'.$row["com_user"].'</b> on <i>'.$row["com_date"].'</i></div>
 <div class="panel-body">'.$row["com_text"].'</div>
 <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["com_id"].'">Reply</button></div>
 </div>
 ';
 //$output .= get_reply_comment($connect, $row["com_id"]);
}

echo $output;




// $result = mysqli_query($con, "SELECT t.id as id,t.title as title, t.tweet as tweet, t.post_date as post_date, p.parents_login as parents_login, p.parents_img as img FROM tweets t LEFT JOIN parents p on t.user_id = p.parents_id WHERE  p.parents_id = ".mysqli_real_escape_string($con, $current_user));
// $data = mysqli_fetch_assoc($result);
//$parent_id = $tweetid;
function get_reply_comment($connect, $parent_id = 0, $marginleft = 0)
{
 $query = "
 SELECT * FROM comments WHERE com_post_id = '".$parent_id."'
 ";
 $output = '';
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
  foreach($result as $row)
  {
   $output .= '
   <div class="post" style="margin-left:'.$marginleft.'px">
    <div class="panel-heading">By <b>'.$row["com_user"].'</b> on <i>'.$row["com_date"].'</i></div>
    <div class="panel-body">'.$row["com_text"].'</div>
    <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["com_id"].'">Reply</button></div>
    </div>
   ';
   $output .= get_reply_comment($connect, $row["com_id"], $marginleft);
  }
 }
 return $output;
}

?>