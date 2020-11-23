<!-- <script type="text/javascript">
            $(document).ready(function() {
                $(".message").hide();
                $("span.readmore").click(function(){
                    $(".message").show("slow");
                    $(this).hide();
                });
            });
		</script> -->
		<script src="js/readMORE.js"></script>
<link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.css" />


<?php
  include 'header2.php';

  $con=mysqli_connect("localhost", "root", "", "parents");

   //!!!!!!!! session_start();
    $current_user = $_SESSION['user'];
 


    $query = mysqli_query($con, "SELECT * FROM parents WHERE parents_id='".$current_user."'");
    $data = mysqli_fetch_assoc($query);
    $login = $data['parents_login'];
    $mail = $data['parents_mail'];
    $img = $data['parents_img'];







    if(isset($_POST['createTweet'])){

      $tweets_query = mysqli_query($con, "INSERT INTO tweets (user_id, title,tweet) VALUES ('".$current_user."', '".mysqli_real_escape_string($con, $_POST['title'])."', '".mysqli_real_escape_string($con, $_POST['tweet'])."') ");
    }


    
    $tweets_query = mysqli_query($con, "SELECT t.tweet as tweet, t.post_date as post_date, p.parents_login as parents_login, p.parents_img as img FROM tweets t
     LEFT JOIN parents p on t.user_id = p.parents_id");

    echo '<section class="tweets"><div class="container1">';
?>





<div>Enter TITLE </div>
<div>
	<input type="text" id="txt_search" name="txt_search">
</div>
<ul id="searchResult"></ul>

<div class="clear"></div>
<div id="postDetail">
</div>





<div class="container" style="margin-top: 50px !important">
	<div class="row">
		<div class="col">
			<div class="card text-left">
				<div class="card-header" style="position:relative;">
					<div class="img-responsive" style=" max-height:125px !important;" id="img"></div>
					<p id="parents_login"></p>

				</div>
				<div class="card-body" id="body">
					<h1 id="title"></h1>
					<p class="card-text" id="tweet"></p>
				</div>
				<div class="card-footer text-muted" id="post_date">
				</div>
			</div>
		</div>
	</div>
</div>









<form method="POST">
	<div class="form-group" style="margin-top: 50px !important">
		<label for="title">название:</label>
		<input name="title" class="form-control" id="title">

		<label for="tweet">Текст:</label>
		<input name="tweet" class="form-control" id="tweet">
	</div>

	<input class="btn btn-primary" name="createTweet" type="submit" value="Добавить твит">
</form>






<body>
	<div class="container">
		<div class="coms"></div>
	</div>



	<!-- </div>
	</section> -->


	<!-- <div class="container">
   <form method="POST" id="comment_form">
    <div class="form-group">
     <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name" />
    </div>
    <div class="form-group">
     <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
    </div>
    <div class="form-group">
     <input type="hidden" name="comment_id" id="comment_id" value="0" />
     <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
    </div>
   </form>
   <span id="comment_message"></span>
   <br />
   <div id="display_comment"></div>
  </div> -->





	<!-- <link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.css" />
	<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Update</h4>
				</div>
				<div class="modal-body">

					<form method="POST" id="comment_form">
						<div class="form-group">

							<label for="add_comment">Add comment</label>
							<input type="text" name="add_comment" id="add_comment" placeholder="comment" class="form-control" />
						</div>
						<div class="form-group">
							<input type="hidden" id="tweet_id" name="tweet_id">
							<input type="submit" onclick="addComment()" name="submit" id="submit" class="btn btn-info" value="Submit" />
							<span id="comment_message"></span>
					</form>
					<span id="comment_message"></span>
					<br />

					</div>


				</div>

			</div>
		</div>
	</div> -->

	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.css" />
	<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel">Update</h4>
				</div>
				<div class="modal-body">

					<form method="POST" id="comment_form">
						<div class="form-group">
							<label for="add_comment">Add comment</label>
							<input type="text" name="add_comment" id="add_comment" placeholder="comment" class="form-control" />
						</div>
						<div class="form-group">
							<input type="hidden" id="tweet_id" name="tweet_id">
							<input type="submit" onclick="addComment()" name="submit" id="submit" class="btn btn-info" value="Submit" />
							<span id="comment_message"></span>
						</div>
					</form>
					<!-- <span id="comment_message"></span>
   <br />
   <div id="display_comment"></div> -->
				</div>


			</div>

		</div>
	</div>












</body>
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>

<!-- Bootstrap JS file -->
<script type="text/javascript" src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
<script src="js/search.js"></script>
<script src="js/comments.js"></script>
<script src="js/loadmore.js"></script>
<script src="js/readMORE.js"></script>
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













<!-- Jquery JS file -->
<!-- <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script> -->

<!-- Bootstrap JS file -->
<!-- <script type="text/javascript" src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>