
<?php
 include 'header1.php';
$con=mysqli_connect("localhost", "root", "", "parents");

session_start();
 $current_user = $_SESSION['user'];


 $html = '<div class="container">';
 $result = mysqli_query($con, " SELECT p.parents_img, p.parents_login, p.parents_id, p.parents_mail, fr.id, f.id
 FROM parents p 
 LEFT JOIN friends_request fr ON fr.friend_id = p.parents_id AND fr.profile_id = ".$current_user." 
 LEFT JOIN friends f ON (f.friend_id = p.parents_id AND f.profile_id = ".$current_user.") OR (f.profile_id = p.parents_id AND f.friend_id = ".$current_user.")
 WHERE p.parents_id!= ".$current_user);
 while($row = mysqli_fetch_array($result)){
    $img=$row['parents_img'];
    $id=$row['parents_id'];
    $login = $row['parents_login'];
    $mail = $row['parents_mail'];
    $friend_request_id = $row[4];
    $friend_id = $row[5];
    echo $friend_id;
    echo $friend_request_id;
    $html .=  '<div class="card" >';
    $html .=  '<img src="images/'.$img.'" class="card-img-left"  alt="Card image cap"  style=" max-height:125px;  max-width:125px !important;"	/> ';
    
    if ($friend_request_id !=null) {
        $html .=  '<button  class="btn btn-warning" style="display:block;position:absolute;right:0;top:0;"   name="tweet_id">Запрос отправлен</button>';
    }else if($friend_id!=null){
        $html .=  '<button  class="btn btn-warning" style="display:block;position:absolute;right:0;top:0;"   name="tweet_id">В друзьях</button>';
    }
    else{
        $html .=  '<button onclick="addFriend('.$id.')" id ="btn-add-friend-'.$id.'" class="btn btn-warning" style="display:block;position:absolute;right:0;top:0;"   name="tweet_id">ДОБАВИТЬ</button>';
    }
    
    $html .=  '<div class="card-body"> <p class="card-text">'.$login.'</p></div></div>';

 }
 $html .=  '</div>';
 echo $html;




?>
<script type="text/javascript" src="js/addFriend.js"></script>


  