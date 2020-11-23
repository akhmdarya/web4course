
<?php
 include 'header1.php';
$con=mysqli_connect("localhost", "root", "", "parents");

session_start();
 $current_user = $_SESSION['user'];
 $currentUserProfile=0;
 $currentUserFriend=0;

//  SELECT * FROM `friends` WHERE profile_id = 55 or friend_id = 55
// $result1 = mysqli_query($con, "SELECT profile_id, friend_id FROM `friends` WHERE profile_id = '".$current_user."' or friend_id ='".$current_user."'");
// while($row = mysqli_fetch_array($result1)){
//   $currentUserProfile=$row['profile_id'];
//   $currentUserFriend=$row['friend_id'];






  

// 1. Берём все чаты, в которых участвует пользователь
// 2. Вытаскиваем данные о собеседнике 
// 2.1 Мы Friend
// 2.2 Мы Profile


// 1




$html = '<div class="container" style="padding:4%">';

$result = mysqli_query($con, "SELECT 
      id as chatId,
      profile_id as profileId,
      friend_id as friendId,
      (SELECT text FROM messages WHERE chat_id = chats.id ORDER BY id DESC LIMIT 1) as lastMessage
      FROM chats 
      WHERE friend_id = ".$current_user." OR profile_id=".$current_user);





    
  // $result = mysqli_query($con, "SELECT c.id as chatId, c.friend_id as friendId, p.parents_login as friendLogin, p.parents_img as friendImg,
  // (SELECT text FROM messages WHERE chat_id = c.id ORDER BY id DESC LIMIT 1) as lastMessage,  
  // (SELECT p.parents_login FROM messages m JOIN parents p ON m.sender=p.parents_id WHERE m.chat_id = c.id ORDER BY id DESC LIMIT 1) as lastMessageSender
  // FROM chats c 
  // LEFT JOIN parents p ON c.friend_id = p.parents_id 
  // LEFT JOIN friends f ON f.profile_id= ".$current_user." AND f.friend_id=c.friend_id  WHERE c.friend_id =".$current_user." or c.profile_id=".$current_user);

// SELECT id FROM chats WHERE profile_id = $current_user AND friend_id = $userId
//  SELECT text FROM messages WHERE chat_id = 1 ORDER BY id DESC LIMIT 1
 while($row = mysqli_fetch_array($result)){

    $chatID=$row['chatId'];
    $friendID=$row['friendId'];
    $profileID=$row['profileId'];
    $lastMessage = $row['lastMessage'];
    $friendLogin="";
    $friendImg="";
    $lastMessageSender="";

    $q = " SELECT 
    p.parents_login as friendLogin, 
    p.parents_img as friendImg,
    (SELECT p.parents_login FROM messages m JOIN parents p ON m.sender=p.parents_id WHERE m.chat_id = ".$chatID." ORDER BY id DESC LIMIT 1) as lastMessageSender
    FROM friends f 
    LEFT JOIN parents p ON ";  



//     $q5 = "SELECT count(c.id) as cnt FROM chats c
// INNER JOIN messages m ON m.chat_id=c.id AND m.status=0 AND ";



$q6="";

    $q1="";
    if ($current_user === $profileID){
     $q1 .=" f.friend_id = p.parents_id 
      WHERE f.profile_id = ".$current_user." AND f.friend_id= ".$friendID;
      // $q6=" m.sender!=profile_id
      // WHERE profile_id ='".$current_user."'";
    }
    $q .= $q1;
    // $q5 .=$q6;
    $q1="";
    // $q6="";

    if ($current_user === $friendID){
     $q1 .=" f.profile_id = p.parents_id 
     WHERE f.profile_id = ".$profileID." AND f.friend_id= ".$current_user;
    //  $q6=" m.sender!=friend_id
    //   WHERE friend_id ='".$current_user."'";
    }
    $q .= $q1;
//     $q5 .=$q6;
//     $resC = mysqli_query($con, $q5);
//     $countChats= mysqli_fetch_($resC);
// $countС = $countChats['cnt'];

    $res = mysqli_query($con, $q);
    $friendLogin="";
    $friendImg="";
    $lastMessageSender="";
   $resp = mysqli_fetch_array($res);
      $friendLogin = $resp['friendLogin'];
      $friendImg = $resp['friendImg'];
      $lastMessageSender = $resp['lastMessageSender'];
  



    
    
      // if ($countС ==0) {
        $html .=  '<div class="card" >';
    //      }
    // if($countС!=0){
    //     $html .=  '<div class="card" style="background-color:aliceblue!important;">';
    //      }
    //      echo $countС;

    // $html .=  '<div class="card" >';
    $html .=  '<img src="images/'.$friendImg.'" class="card-img-left"  alt="Card image cap"  style=" max-height:125px;  max-width:125px !important;"	/> ';
    

    $html .=  '<button  onclick="openChat('.$chatID.')" id ="btn-chat-friend-'.$chatID.'" class="btn btn-warning" style="display:block;position:absolute;right:0;top:0;"   name="tweet_id">Открыть чат</button>';
    
    
    $html .=  '<div class="card-body"> <p class="card-text">'.$friendLogin.'</p><p>Сообщение:'.$lastMessage.'</p><p>Отправитель:'.$lastMessageSender.'</p></div></div>';

 }
 $html .=  '</div>';
 $html .=  '<div class="chats" ></div>';
 echo $html;




?>
<script type="text/javascript" src="js/messages.js"></script>


  <!-- $q = INSERT INTO messages (chat_id, text, sender) VALUES (1, "Hello", 55) RETURNING id; -->
<!-- $data = mysqli_fetch_assoc($q);
$id = $data['id']; -->

<!-- UPDATE messages SET status = true WHERE id = $id -->

<!-- UPDATE messages SET status = true WHERE chat_id = 1 AND sender = Friend -->