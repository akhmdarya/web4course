<!-- <link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.css"/> -->

<?php

$con=mysqli_connect("localhost", "root", "", "parents");

session_start();
 $current_user = $_SESSION['user'];



 $query = mysqli_query($con, "SELECT * FROM parents WHERE parents_id='".$current_user."'");
 $data = mysqli_fetch_assoc($query);
 $login = $data['parents_login'];
 $mail = $data['parents_mail'];
 $img = $data['parents_img'];
 $tweets_query = mysqli_query($con, "SELECT t.tweet as tweet, t.post_date as post_date, p.parents_login as parents_login, p.parents_img as img FROM tweets t
 LEFT JOIN parents p on t.user_id = p.parents_id");



?>




<!-- <link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.css"/> -->
<!-- <div class="container" > -->
<?php
$rowperpage = 3;

            // counting total number of posts
            $allcount_query = "SELECT count(*) as allcount FROM tweets";
            $allcount_result = mysqli_query($con,$allcount_query);
            $allcount_fetch = mysqli_fetch_array($allcount_result);
            $allcount = $allcount_fetch['allcount'];

      

           $query = "SELECT 
		   				t.id as tweet_id, t.tweet as tweet, t.post_date as post_date,t.title as title,t.link as link, p.parents_login as parents_log, p.parents_img as img 
					FROM 
						tweets t 
					LEFT JOIN parents p on t.user_id = p.parents_id 
					ORDER BY id DESC LIMIT 0,$rowperpage ";
        // $query = "select * from tweets order by id asc limit 0,$rowperpage ";  

         $result = mysqli_query($con,$query);


            while($row = mysqli_fetch_array($result)){
                $img=$row['img'];
                $tweet_id=$row['tweet_id'];
               
                $id = $row['parents_log'];
                $title = $row['title'];
                $content = $row['tweet'];
                $shortcontent = substr($content, 0, 50)."...";
               // $link = $row['link'];
            ?>

		<div class="post" id="post_<?php echo $id; ?>">

			<?php
echo '<div class="card text-left">';
           echo' <div class="card-header">';
           
              echo  '<img src="images/'.$row['img'].'" class="img-responsive" style=" max-height:125px !important;"	/>Автор: ';
              echo  $row['parents_log'];
           echo '</div>';
           
           echo '</div>';
		$post=$row['tweet_id'];
		$user=$row['parents_log'];
           
     ?>
			<h1>
				<?php echo $title; ?>
			</h1>
			<p>
				<?php echo $shortcontent; ?>
			</p>

	<span class="readmore1"><p class="read">Read More...</p>
		<img class="caret1" id="caret" src="images/caret-down.svg"/>
	</span>
	<div class="message">
		<?php echo $content; ?>
	</div>

			<!-- <br /> -->

			<?php  
echo '<button onclick="toReplyPost('.$row['tweet_id'].')" class="btn btn-primary" style="display:block; margin-left:90% ;margin-bottom: 7px;"  name="tweet_id">Reply</button>';
    $connect = new PDO('mysql:host=localhost;dbname=parents', 'root', '');
  
        
            // $query1 = "SELECT * FROM tweets LEFT JOIN parents  on tweets.user_id = parents.parents_id LEFT JOIN comments on tweets.id = comments.com_post_id 
			// WHERE comments.com_post_id= '$post'
			//  ORDER BY comments.com_id DESC";

	$query1 = "SELECT 
					c.com_id, c.com_user, c.com_text, c.com_date, c.com_post_id, p.parents_login, p.parents_img 
				FROM 
					comments c 
				LEFT JOIN 
					parents p on c.com_user = p.parents_id 
				WHERE 
					c.com_post_id= '$post'
				ORDER BY 
					c.com_id DESC";
			

$statement = $connect->prepare($query1);

$statement->execute();

$result1 = $statement->fetchAll();
$output = '';
//$output1 = '';

foreach($result1 as $row)
{
 $output .= '

 <div class="post1">
 <div class="panel-heading"><img src="images/'.$row['parents_img'].'" class="img-responsive" style=" max-height:70px !important; border-radius: 100px;
 box-shadow: 0 0 7px #666; max-width: 100px;"	/>By <b>'.$row['parents_login'].'</b> on <i>'.$row["com_date"].'</i></div>
 <div class="panel-body">'.$row["com_text"].'</div>
 <button onclick="DeleteComment('.$row['com_id'].')" class="btn btn-danger" style="display:block; margin-left:90% ;margin-bottom: 7px;">Delete</button>
 <div class="panel-footer" align="right"></div>
 </div>
 
 ';

}


echo $output;



   ?>
			<div id="display_comment"></div>


		</div>



		<?php
            }
            ?>

		<h1 class="load-more">Load More</h1>
		<input type="hidden" id="row" value="0">
		<input type="hidden" id="all" value="<?php echo $allcount; ?>">

  <!-- </div> -->
  
  <!-- <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script> -->

<!-- Bootstrap JS file -->
<!-- <script type="text/javascript" src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script> -->
<!-- <script src="js/search.js"></script> -->
<!-- <script src="js/comments.js"></script> -->
<script src="js/readMORE.js"></script>
<script src="js/loadmore.js"></script>

<script>
	(function(i, s, o, g, r, a, m) {
		i['GoogleAnalyticsObject'] = r;
		i[r] = i[r] || function() {
			(i[r].q = i[r].q || []).push(arguments)
		}, i[r].l = 1 * new Date();
		a = s.createElement(o),
			m = s.getElementsByTagName(o)[0];
		a.async = 1;
		a.src = g;
		m.parentNode.insertBefore(a, m)
	})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

	ga('create', 'UA-75591362-1', 'auto');
	ga('send', 'pageview');
</script>
