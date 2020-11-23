<?php
 include 'header1.php';
$con=mysqli_connect("localhost", "root", "", "parents");

session_start();
 $current_user = $_SESSION['user'];
//  $q1 = mysqli_query($con, "SELECT count(id) as count FROM `friends_request` WHERE profile_id ='".$current_user."'"); 
//  $countRequestsOut = mysqli_fetch_assoc($q1);
//  $countOut = $countRequestsOut['count'];


 $html = '<div class="container">';
 $result = mysqli_query($con, "SELECT p.parents_img, p.parents_login, p.parents_id, p.parents_mail, fr.id FROM parents p LEFT JOIN friends_request fr ON 
 fr.friend_id = p.parents_id 
 AND fr.profile_id = '".$current_user."' WHERE fr.profile_id='".$current_user."'");
 while($row = mysqli_fetch_array($result)){
    $img=$row['parents_img'];
    $id=$row['parents_id'];
    $login = $row['parents_login'];
    $mail = $row['parents_mail'];
    $friend_id = $row['id'];

  

    $html .=  '<div class="card" >';
    $html .=  '<img src="images/'.$img.'" class="card-img-left"  alt="Card image cap"  style=" max-height:125px;  max-width:125px !important;"	/> ';
    
    if ($friend_id !=null) {
        $html .=  '<button  onclick="cancelOutRequest('.$id.')" id ="btn-cancelOutRequest-friend-'.$id.'" class="btn btn-warning" style="display:block;position:absolute;right:0;top:0;"   name="tweet_id">Отменить запрос</button>';

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