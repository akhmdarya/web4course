<?php include 'header1.php';?>





<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js">
</script>
<script type="text/javascript" src="js/form-validation.js"></script>

	 <section class="register">
	 <div class="signin-form">
		<div class="container ">
			<div class="row">
				<div class="col">
					<form method="POST" id="register-form">
						<div class="form-group">
							<label  for="login">Login</label>
							<input name="login" type="text" class="form-control" placeholder="Login" id="login">
						</div>
						<br>
						<div class="form-group">
							<label for="password" >Password</label>
							<input name="password_1" type="password" class="form-control" id="password_1" placeholder="Password">
						</div>
						<div class="form-group">
							<label for="password" >Confirm password</label>
							<input name="password_2" type="password" class="form-control" id="password_2" placeholder="Password">
						</div>


 <div id="uname_response" ></div>

<div id="error">
            </div>

						<br>
						<input class="btn btn-primary" name="submit" type="submit" id="btn-submit" value="Зарегистрироваться">


					</form>
				</div>
			</div>
		</div>
</div>
		<section> 




<script>
$(document).ready(function(){

   $("#login").keyup(function(){

      var login = $(this).val().trim();

      if(login != ''){

         $.ajax({
            url: 'ajax.php',
            type: 'post',
            data: {login: login},
            success: function(response){

                $('#uname_response').html(response);

             }
         });
      }else{
         $("#uname_response").html("");
      }

    });

 });
</script>



<?php

// Страница регситрации нового пользователя


# Соединямся с БД

$con=mysqli_connect("localhost", "root", "", "parents");


# если ошибка
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}


if(($_POST))
{
    $err = array();
    # проверям логин
  /*  if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }
    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }
   
    if (strlen($_POST['password_1'])<1 || strlen($_POST['password_2']) < 1)
    {
        $err[] = "Введите пароль!";
	}
	if ($_POST['password_1']!=$_POST['password_2']){
		$err[] = " Пароли разные!!!";
	}*/

	 # проверяем, не сущестует ли пользователя с таким именем
	 if ($sql=mysqli_query($con, "SELECT * FROM parents WHERE parents_login='".mysqli_real_escape_string($con, $_POST['login'])."'") and mysqli_num_rows($sql)>0)
	 {
		 $err[] = "Пользователь с таким логином уже существует в базе данных";
	 }
    # Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    { 
      $login = $_POST['login'];
      # Убираем лишние пробелы и делаем двойное шифрование
      $password = $_POST['password_1'];
      mysqli_query($con, "INSERT INTO parents SET parents_login='".$login."' , parents_password='".$password."'");
      
     header("Location: index.php");exit();
    }
    else
    {

		$response = "<span style='color: red;'>Not Available.</span>";
        // print "<b>При регистрации произошли следующие ошибки:</b><br>";
        // foreach($err AS $error)
        // {
        //     print $error."<br>";
        // }
    }
}
?>







</body>




</html>