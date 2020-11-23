<?php
    $con=mysqli_connect("localhost", "root", "", "parents");
$query = "SELECT t.id as tweet_id, t.tweet as tweet, t.post_date as post_date,t.title as title,t.link as link, p.parents_login as parents_login, p.parents_img as img FROM tweets t 
           LEFT JOIN parents p on t.user_id = p.parents_id";
           $tweets_query = mysqli_query($con, "SELECT t.id as tweet_id, t.tweet as tweet, t.post_date as post_date, p.parents_login as parents_login, p.parents_img as img FROM tweets t
           LEFT JOIN parents p on t.user_id = p.parents_id");

         


            while($row = mysqli_fetch_array($tweets_query)){
            
                $post=$row['tweet_id'];


                $connect = new PDO('mysql:host=localhost;dbname=parents', 'root', '');
  
        
                $query1 = "SELECT * FROM tweets  LEFT JOIN comments on tweets.id = comments.com_post_id WHERE comments.com_post_id= '$post' ORDER BY comments.com_id DESC";
    
    $statement = $connect->prepare($query1);
    
    $statement->execute();
    
    $result1 = $statement->fetchAll();
    $output = '';
    $output1 = '';
    
    foreach($result1 as $row)
    {
     $output .= '
    
     <div class="post">
     <div class="panel-heading">By <b>'.$row["com_user"].'</b> on <i>'.$row["com_date"].'</i></div>
     <div class="panel-body">'.$row["com_text"].'</div>
     <div class="panel-footer" align="right"></div>
     </div>
     
     ';
    
    }
    
    
    echo $output;
  }
    ?>