<link rel="stylesheet" type="text/css" href="../style/all.css">
<!-- <link rel="stylesheet" type="text/css" href="../bootstrap-3.3.5-dist/css/bootstrap.css"/> -->
<?php
 //include '../header1.php';
	// include Database connection file 
	$con=mysqli_connect("localhost", "root", "", "parents");

    session_start();
	$current_user = $_SESSION['user'];
	

	// $query = mysqli_query($con, "SELECT * FROM parents WHERE parents_id='".$current_user."'");
    // $data1 = mysqli_fetch_assoc($query);
    // $login = $data1['parents_login'];
    // $mail = $data1['parents_mail'];
    // $img = $data1['parents_img'];

	// Design initial table header 
	$data = '<table class="table table-bordered table-striped">
						<tr>
							<th>No.</th>
							<th>title</th>
							<th>Tweet</th>
							<th>Author</th>
							<th> Profile</th>
							<th>Post Date </th>
							<th>Update</th>
							<th>Delete</th>
						</tr>';

$tweets_query = mysqli_query($con, "SELECT t.title as title, t.id as id, t.tweet as tweet, t.post_date as post_date, p.parents_login as parents_login, p.parents_img as img 
FROM tweets t 
LEFT JOIN parents p on t.user_id = p.parents_id 
WHERE p.parents_id = ".mysqli_real_escape_string($con, $current_user)." ORDER BY  post_date DESC");
   

echo '<section class="tweets"><div class="container">';

echo '<div class="row">';
echo '<div class="col">';

    // if query results contains rows then featch those rows 
    if(mysqli_num_rows($tweets_query) > 0)
    {
    	$number = 1;
    	while($row = mysqli_fetch_assoc($tweets_query))
    	{
    		// $data .= '<tr>
			// 	<td>'.$number.'</td>
			// 	<td>'.$row['title'].'</td>
			// 	<td>'.$row['tweet'].'</td>
			// 	<td>'.$row['parents_login'].'</td>
			// 	<td><img src="images/'.$row['img'].'" width="133" height="180" /></td> 
			// 	<td>'.$row['post_date'].'</td>
			// 	<td>
			// 		<button onclick="GetUserDetails('.$row['id'].')" class="btn btn-warning"  name="tweet_id">Update</button>
			// 	</td>
			// 	<td>
			// 		<button onclick="DeleteUser('.$row['id'].')" class="btn btn-danger">Delete</button>
			// 	</td>
    		// </tr>';
			// $number++;
			echo '<div class="post">';
			echo '<div class="card text-left">';
			echo' <div class="card-header" style="padding: .75rem 1.25rem;margin-bottom: 0;background-color: rgba(0,0,0,.03);border-bottom: 1px solid rgba(0,0,0,.125);position:relative;">';
			  echo  '<img src="images/'.$row['img'].'" class="img-responsive" style=" max-height:125px !important;"	/>Автор: ';
			  echo  $row['parents_login'];
			  echo '<button onclick="GetUserDetails('.$row['id'].')" class="btn btn-warning" style="display:block;position:absolute;right:0;top:0;"  name="tweet_id">Update</button>';
			   echo '<button onclick="DeleteUser('.$row['id'].')" class="btn btn-danger" style="display:block;position:absolute;right:0;bottom:0;">Delete</button>';
			echo '</div>';
	
			echo '<div class="card-body">';
			echo '<h1 >'.$row['title'].'</h1>';
			  echo '<p class="card-text">'.$row['tweet'].'</p>';
			echo '</div>';
			echo '<div class="card-footer text-muted">Дата публикации: '.$row['post_date'];
			echo '</div> ';
		  echo ' </div>';
		  echo ' </div>';



    	}
	}
	
	echo ' </div>';
	echo '</div>';
echo '</div> </section></body></html>';
   // else
   // {
    	// records now found 
    //	$data .= '<tr><td colspan="6">Records not found!</td></tr>';
   // }

    //$data .= '</table>';

   // echo $data;
?>




<!-- echo '<section class="tweets"><div class="container">';

echo '<div class="row">';
echo '<div class="col">'; -->

<!-- while( $row = mysqli_fetch_assoc($tweets_query) ){  -->
  
	
	

<!-- } -->
<!-- echo ' </div>';
	  echo '</div>';
echo '</div> </section></body></html>'; -->