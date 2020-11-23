<?php
 //include '../header1.php';
	// include Database connection file 
	$con=mysqli_connect("localhost", "root", "", "parents");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
      }

$type = $_POST['type'];

// Search result
if($type == 1){
    $searchText = $_POST['search'];


  $tweets_query = mysqli_query($con, "SELECT t.id as id, t.tweet as tweet,t.title as title, t.post_date as post_date, p.parents_login as parents_login, p.parents_img as img FROM tweets t LEFT JOIN parents p on t.user_id = p.parents_id where title like '%".$searchText."%' order by title asc limit 5");


   // $sql = "SELECT id,name FROM user where name like '%".$searchText."%' order by name asc limit 5";

    //$result = mysqli_query($con,$sql);

    $search_arr = array();

    while($fetch = mysqli_fetch_assoc($tweets_query)){
        $id = $fetch['id'];
        $title = $fetch['title'];

        $search_arr[] = array("id" => $id, "title" => $title);
    }

    echo json_encode($search_arr);
}

// get User data
if($type == 2){
    $postid = $_POST['postid'];

   // $tweets_query = mysqli_query($con, "SELECT t.id as id, t.tweet as tweet,t.title as title, t.post_date as post_date, p.parents_login as parents_login, p.parents_img as img FROM tweets t LEFT JOIN parents p on t.user_id = p.parents_id where  id=".$userid." ");

    $sql =  "SELECT t.id as id, t.tweet as tweet,t.title as title, t.post_date as post_date, p.parents_login as parents_login, p.parents_img as img FROM tweets t LEFT JOIN parents p on t.user_id = p.parents_id where t.id=".$postid;

    $result = mysqli_query($con,$sql);

    $return_arr = array();
    while($fetch = mysqli_fetch_assoc($result)){
        $tweet = $fetch['tweet'];
        $post_date = $fetch['post_date'];
        $parents_login = $fetch['parents_login'];
        $img = $fetch['img'];
        $title = $fetch['title'];

        $return_arr[] = array("tweet"=>$tweet, "post_date"=> $post_date,"parents_login"=>$parents_login,"img"=>$img,"title"=>$title);
    }

    echo json_encode($return_arr);
}
?>