<!-- <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="external.css" rel="stylesheet" >
    <script src="main.js"></script>
</head>
<body>  
  <div class="container">
    <div class="row">
      <div class="col">

          <h2> Личный кабинет</h2>
      </div>
    </div>
  </div> -->


<head>
    <meta charset="UTF-8">
  

    <!-- Bootstrap CSS File  -->
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.css"/>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" -->
</head>
<?php
 include 'header2.php';
// Страница авторизации







$con=mysqli_connect("localhost", "root", "", "parents");


    // session_start();
    $current_user = $_SESSION['user'];
 
    $query = mysqli_query($con, "SELECT * FROM parents WHERE parents_id='".$current_user."'");
    $data = mysqli_fetch_assoc($query);
    $pas = $data['parents_password'];
    $id = $data['parents_id'];
    $login = $data['parents_login'];
    $mail = $data['parents_mail'];
    $img = $data['parents_img'];
    $status = $data['parents_active'];


    $q1 = mysqli_query($con, "SELECT count(id) as count FROM `friends_request` WHERE profile_id ='".$current_user."'"); 
    $countRequestsOut = mysqli_fetch_assoc($q1);
    $countOut = $countRequestsOut['count'];

    $q2 = mysqli_query($con, "SELECT count(id) as count FROM `friends_request` WHERE friend_id ='".$current_user."'");
    $countRequestsIn = mysqli_fetch_assoc($q2);
    $countIn = $countRequestsIn['count'];

    $q3 = mysqli_query($con, "SELECT count(id) as count FROM `friends` WHERE friend_id ='".$current_user."' OR profile_id='".$current_user."'" );
    $countRequestsIn = mysqli_fetch_assoc($q3);
    $countFR = $countRequestsIn['count'];

    $q4 = mysqli_query($con, "SELECT sum(cnt) as summ from (
      SELECT count(c.id) as cnt FROM chats c
      INNER JOIN messages m ON m.chat_id=c.id AND m.status=0 AND m.sender!=friend_id
      WHERE friend_id ='".$current_user."'
      UNION
      SELECT count(c.id) as cnt FROM chats c
      INNER JOIN messages m ON m.chat_id=c.id AND m.status=0 AND m.sender!=profile_id
      WHERE  profile_id='".$current_user."') as z");
    $countChatsM= mysqli_fetch_assoc($q4);
    $countM = $countChatsM['summ'];


    // getProfileStatus();
    if(isset($_POST['changeSubmit']))

{
    $q = "UPDATE parents SET ";

    $q .="parents_password = '".mysqli_real_escape_string($con, $_POST['password'])."' ,";
    $q .="parents_login = '".mysqli_real_escape_string($con, $_POST['login'])."', ";
    $q .="parents_mail = '".mysqli_real_escape_string($con, $_POST['mail'])."' ";


    $q .="WHERE parents_id='".mysqli_real_escape_string($con, $id)."' LIMIT 1 ";

    // $query = mysqli_query($con, "UPDATE parents SET parents_password = coalesce('".mysqli_real_escape_string($con, $_POST['password'])."', parents_password) WHERE parents_login='".mysqli_real_escape_string($con, $login)."' LIMIT 1");
    
    

    $query = mysqli_query($con, $q);

    $data = mysqli_fetch_assoc($query);
    header("Refresh:0");
    
}
if(isset($_POST['getTweets'])){

  $tweets_query = mysqli_query($con, "SELECT * FROM tweets");
  // $result = mysqli_fetch_assoc($tweets_query);
  while( $row = mysqli_fetch_assoc($tweets_query) ){ 
   // echo '<div class="media-body">'. $row['tweet']. '</div>';
   echo '<div class="myDiv"></div>';
     echo  '<div class="myDiv-inner">'. '<div class="myDiv-inner-sides">'.$row['tweet']. '</div>' . '</div>';
    // echo "<div class=\"myDiv \">
    // <div class=\"myDiv-inner \">
    //          {$row['tweet']}</div></div>";
    // echo '<script language="javascript">';
    // echo 'alert("' . $row['tweet'] . '")';
    // echo '</script>';
  }
  // while( $row = $result->fetch_assoc() ){ 
  //   echo '<script language="javascript">';
  //   echo 'alert("' . $row['id'] . '")';
  //   echo '</script>';
  //   // printf("%s (%s)\n", $row['id'], $row['tweet']);
  // }
}
if(isset($_POST['logout'])){

  session_unset();     
  session_destroy(); 
  header("Location: index.php");
}



if(isset($_POST['createTweet'])){

  $tweets_query = mysqli_query($con, "INSERT INTO tweets (user_id, tweet) VALUES ('".$current_user."', '".mysqli_real_escape_string($con, $_POST['tweet'])."') ");
  // $result = mysqli_fetch_assoc($tweets_query);
 // while( $row = mysqli_fetch_assoc($tweets_query) ){ 
   //echo '<div class="mydiv">'. $row['tweet']. '</div>';
    // echo '<script language="javascript">';
    // echo 'alert("' . $row['tweet'] . '")';
    // echo '</script>';
 // }
  // while( $row = $result->fetch_assoc() ){ 
  //   echo '<script language="javascript">';
  //   echo 'alert("' . $row['id'] . '")';
  //   echo '</script>';
  //   // printf("%s (%s)\n", $row['id'], $row['tweet']);
  // }
}
include_once('functions.php');

// если была произведена отправка формы
if(isset($_FILES['file'])) {
  // проверяем, можно ли загружать изображение
  $check = can_upload($_FILES['file']);

  
  if($check === true){
    
    // загружаем изображение на сервер
    make_upload($_FILES['file']);
    
    $filename=$_FILES['file']['name'];
    
   $qimg = "UPDATE parents SET ";

   $qimg .="parents_img = '".mysqli_real_escape_string($con, $filename)."' ";


   $qimg .="WHERE parents_id='".mysqli_real_escape_string($con, $id)."' ";
   $queryimg = mysqli_query($con, $qimg);
   
  //  $querys = mysqli_query($con, "SELECT parents_img FROM parents WHERE parents_id='".$current_user."'");
  //  $data = mysqli_fetch_assoc($querys);

  //  $img = $data['parents_img'];
   header("Refresh:0");
  //  echo "<strong>Файл успешно загружен!</strong>";

  }
  else{
    // выводим сообщение об ошибке
    echo "<strong>$check</strong>";  
  }
}

?>
<section class="auth1">
	<div class="container" style="width:97%;">
		<div class="row userIsActive" style="display:flex;justify-content: space-between;/* flex-direction: row; */">
			<div class="col-8">
				<div class="row">
					
        <div class="col-3">
						<img src="images/<?=$img;?>" class="img-responsive" style=" max-height:125px !important;"
						/>
						<form method="post" enctype="multipart/form-data">
							<div class="form-group">
								<input type="file" class="form-control-file" name="file">
                <input type="submit" class="form-control-file" value="Загрузить файл!">
                
							</div>
            </form>
            
      <span class=" statusSpan" style="display:none;"><?=$status;?></span>

      <a href="tweets.php" class="btn">Все твиты</a>
      <a href="tweetsprofile.php" class="btn">Мои твиты</a>
      <a href="allUsers.php" class="btn">Добавить друга</a>
      <a href="friends.php" class="btn">Мои друзья  <?=$countFR;?></a>
      <a href="outRequest.php" class="btn">Исходящие заявки  <?=$countOut;?> </a>
      <a href="inRequest.php" class="btn">Входящие заявки  <?=$countIn;?> </a>
      <a href="chats.php" class="btn">Чаты <?=$countM;?> </a>
					</div>

				
        <div class="col-9">

				<br />
				<h2 class="text">Ваш текущий пароль:  
					<?=$pas;?>
				</h2>
				<h2 class="text">Ваш ID:
					<?=$id;?>
				</h2>
				<h2 class="text">Ваш текущий Логин:
					<?=$login;?>
				</h2>
				<h2 class="text">Привет,
					<?=$current_user;?>
				</h2>
        </div>
        
        </div>
			</div>
			<div class="col-4">
        
				<form method="POST">
					<div class="form-group">
						<label for="id" class="text">Ваш ID:</label>
						<input name="id" readonly class="form-control" id="id" value="<?=$id;?>">
					</div>
					<div class="form-group">
						<label for="password" class="text">Ваш пароль:</label>
						<input name="password" type="password" class="form-control" id="password" value="<?=$pas;?>">
					</div>

					<div class="form-group">
						<label for="login" class="text">Ваш Логин:</label>
						<input name="login" class="form-control" id="login" value="<?=$login;?>">
					</div>
					<div class="form-group">
						<label for="mail" class="text">Ваш E-Mail:</label>
						<input name="mail" class="form-control" id="mail" value="<?=$mail;?>">
					</div>
          <input class="btn btn-primary" name="changeSubmit" type="submit" value="Изменить данные">
          <!-- <input class="btn btn-danger" onclick="deactivateUser()" name="deactive" type="submit" value="Деактивировать"> -->
          <input class="btn btn-secondary" style="margin: 4%;" name="logout" type="submit" value="Выйти">
				</form>
        <input class="btn btn-danger" onclick="UpdateUserStatus('<?=$id;?>', 0, 'deactivate')" name="deactive" type="submit" style="margin: 4%;" value="Деактивировать">


				<!-- <form method="POST">
					<div class="form-group">
						<label for="tweet" class="text">Текст:</label>
						<input name="tweet" class="form-control" id="tweet">
					</div>

					<input class="btn btn-primary" name="createTweet" type="submit" value="Добавить твит">
				</form>

				<form method="POST">
					<input class="btn btn-primary" name="getTweets" type="submit" value="Получить данные">
        </form> -->
        
        

			</div>
    </div>
    

    	<div class="row userIsDeactive" style="display:none;">
      <div class="container" style="width:50%;">
			  <div class="col-2">
          <h2 class="text">Юзер неактивирован</h2>
          <button class="btn btn-info" onclick="UpdateUserStatus('<?=$id;?>', 1, 'activate')" name="active" type="submit" value="Активировать профиль">Активировать профиль</button>
        </div>

        <div class="col-2">
          <form method="POST">
              <!-- <input class="btn btn-info" onclick="activateUser()" name="active" type="submit" value="Активировать профиль"> -->
              <input class="btn btn-secondary" name="logout" type="submit" value="Выйти">
          </form>
</div>
        </div>



      </div>
	</div>
</section>

<!-- Jquery JS file -->
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>

<!-- Bootstrap JS file -->
<script type="text/javascript" src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>

<!-- Custom JS file -->
<script type="text/javascript" src="js/modal.js"></script>

  <script>

    document.addEventListener("DOMContentLoaded", () => {

      var status= document.getElementsByClassName("statusSpan")[0].textContent; 
      console.log(status);
      if (status == 0){
        var deactiveUserInfo= document.getElementsByClassName("userIsDeactive");
        deactiveUserInfo[0].style.display = "block";

        var activeUserInfo= document.getElementsByClassName("userIsActive");
        activeUserInfo[0].style.display = "none";
      }else if(status == 1){
        var deactiveUserInfo= document.getElementsByClassName("userIsDeactive");
        deactiveUserInfo[0].style.display = "none";

        var activeUserInfo= document.getElementsByClassName("userIsActive");
        activeUserInfo[0].style.display = "flex";
      }else{
        console.log("status is undefined")
        console.log(status)
      }

    });

function deactivateUser() {
  var deactiveUserInfo= document.getElementsByClassName("userIsDeactive");
  deactiveUserInfo[0].style.display = "block";


  var activeUserInfo= document.getElementsByClassName("userIsActive");
  activeUserInfo[0].style.display = "none";

}

</script>

</body>

</html>