<?php

include 'header1.php';
session_start();  

$con=mysqli_connect("localhost", "root", "", "parents");

  $err = '';

  if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['tweet_id'])){
    $tweetid= $_POST['tweet_id'] ;
    $_SESSION['TWEETID'] =  $tweetid;

    $query = mysqli_query($con, "SELECT t.id as id, t.tweet as tweet, t.post_date as post_date, p.parents_login as parents_login, p.parents_img as img FROM tweets t JOIN parents p on t.user_id = p.parents_id WHERE t.id = ".mysqli_real_escape_string($con, $tweetid));
    $data = mysqli_fetch_assoc($query);
    $date = $data['post_date'];
    $tweet = $data['tweet'];  
    $parents_login = $data['parents_login'];
    $img = $data['img'];

 
}
else{
  echo $err= 'ОШИБКА';
}
}


if(isset($_POST['changetweet']))

{
    
  $q = "UPDATE tweets SET ";

  $q .="tweet = '".mysqli_real_escape_string($con, $_POST['tweet'])."' ";


  $q .="WHERE id='".mysqli_real_escape_string($con, $_SESSION['TWEETID'])."' LIMIT 1 ";

  $query = mysqli_query($con, $q);
  $data = mysqli_fetch_assoc($query);

  header("Location: tweetsprofile.php");

  }
  if(isset($_POST['deletetweet']))

  {
      
    $query = mysqli_query($con, "DELETE FROM tweets WHERE id = ".mysqli_real_escape_string($con, $_SESSION['TWEETID']));
    $data = mysqli_fetch_assoc($query);
    header("Location: tweetsprofile.php");
  
    }
?>
<section class="tweets"><div class="container">

<div class="row">
<div class="col">


<div class="card text-left">
   <div class="card-header">
     <img src="images/<?=$img;?>" class="img-responsive" style=" max-height:125px !important;"	/>
     <?=$parents_login;?>
            </div>

            <div class="card-body">
              <p class="card-text">
              <form method="POST">
                <div class="form-group">
                  <input name="tweet" class="form-control" id="tweet" value="<?=$tweet;?>">
                  <input class="btn btn-success" name="changetweet" type="submit" value="Сохранить">
                  <a href="tweetsprofile.php" class="btn btn-secondary">Отменить</a>

                  <input class="btn btn-danger" name="deletetweet" type="submit" value="Удалить">
                </div>
              </form>
                
              </p>
            </div>
            <div class="card-footer text-muted">
            Дата публикации: <?=$date;?>
            </div> 
           </div>

          </div>
       </div>
  </div> </section></body></html>