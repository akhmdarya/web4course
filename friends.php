<?php
 include 'header1.php';
$con=mysqli_connect("localhost", "root", "", "parents");

session_start();
 $current_user = $_SESSION['user'];



 $html = '<div class="container">';
 $result = mysqli_query($con, "SELECT p.parents_img, p.parents_login, p.parents_id, p.parents_mail, fr.friend_id as id
 FROM friends fr
 inner JOIN parents p ON fr.profile_id = p.parents_id
 WHERE fr.friend_id='".$current_user."'
 UNION
 SELECT p.parents_img, p.parents_login, p.parents_id, p.parents_mail, fr.profile_id as id
 FROM friends fr  
 inner JOIN parents p ON fr.friend_id = p.parents_id
 WHERE fr.profile_id='".$current_user."'");
 while($row = mysqli_fetch_array($result)){
    $img=$row['parents_img'];
    $id=$row['parents_id'];
    $login = $row['parents_login'];
    $mail = $row['parents_mail'];
    $friend_id = $row['id'];

$q="SELECT id FROM chats WHERE (profile_id = ".$current_user."  AND friend_id =".$id.") OR (profile_id = ".$id." AND friend_id = ".$current_user.")";
    $res = mysqli_query($con, $q);
    $resp = mysqli_fetch_array($res);
    $chatID = $resp['id'];
echo $chatID;
    $html .=  '<div class="card" >';
    $html .=  '<img src="images/'.$img.'" class="card-img-left"  alt="Card image cap"  style=" max-height:125px;  max-width:125px !important;"	/> ';
    

        $html .=  '<button onclick="openChat('.$chatID.')" id ="btn-chat-friend-'.$chatID.'" class="btn btn-success" style="display:block;position:absolute;right:0;top:0;"   name="tweet_id">Написать сообщение</button>';
 

    //     $html .=  '<button onclick="addFriend('.$id.')" id ="btn-add-friend-'.$id.'" class="btn btn-warning" style="display:block;position:absolute;right:0;top:0;"   name="tweet_id">ДОБАВИТЬ</button>';

    
    $html .=  '<div class="card-body"> <p class="card-text">'.$login.'</p></div></div>';

 }
 $html .=  '</div>';
 $html .=  '<div class="chats" ></div>';
 echo $html;




?>

<script type="text/javascript" src="js/addFriend.js"></script>
<script type="text/javascript" src="js/messages.js"></script>
