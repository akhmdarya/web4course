<?php
$con=mysqli_connect("localhost", "root", "", "parents");

session_start();
 $current_user = $_SESSION['user'];


 $html = '<div class="container">';
 
 $chatID= $_POST['id'] ;

 $result = mysqli_query($con, "SELECT m.text as msg, m.status, m.date, p.parents_login as sender, p.parents_img as img 
 FROM messages m JOIN parents p ON m.sender = p.parents_id 
 WHERE m.chat_id = ".$chatID." ORDER BY date ASC");


 while($row = mysqli_fetch_array($result)){

    $msg=$row['msg'];
    $status=$row['status'];
    $date = $row['date'];
    $sender = $row['sender'];
    $img = $row['img'];


    if ($status ==true) {
        $html .=  '<div class="card" >';
         }
    else{
        $html .=  '<div class="card" style="background-color:aliceblue!important;">';
         }
    




    // 
    $html .=  '<img src="images/'.$img.'" class="card-img-left"  alt="Card image cap"  style=" max-height:125px;  max-width:125px !important;"	/> ';
    $html .=  '<div class="card-body"> <p class="card-text">'.$sender.'</p><p>Сообщение:'.$msg.'</p><p>Дата:'.$date.'</p><p>Статус:'.$status.'</p></div>';
    $html .=  '</div>';
 }
 $html .=  '<button  class="btn btn-warning" style="display:block;position:absolute;    top: 100px;
 left: 1%;"   ><a href="chats.php">ВСЕ ЧАТЫ</a></button>';
 $html .=  '</div>';

 
 $html .=  '<div class="modal-footer" style="justify-content: center;"><input type="text" id="message" placeholder="message" class="form-control"/>';
 $html .=  '<button type="button" class="btn btn-primary" onclick="writeMessage('.$chatID.')">Отправить</button></div>';
 echo $html;




?>
