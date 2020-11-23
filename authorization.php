
<?php include 'header1.php';?>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js">
</script>
<script type="text/javascript" src="js/login-valid.js"></script>
<?php
# Соединямся с БД
$message1 = '';


$con=mysqli_connect("localhost", "root", "", "parents");


if(isset($_POST['submit']))

{

    # Вытаскиваем из БД запись, у которой логин равняеться введенному

    $query = mysqli_query($con, "SELECT parents_id,parents_img,parents_mail, parents_password, parents_login FROM parents WHERE parents_login='".mysqli_real_escape_string($con, $_POST['login'])."' LIMIT 1");

    $data = mysqli_fetch_assoc($query);


	session_start();
	$sql = "Select * from parents where parents_login = '" . $_POST["login"] . "'";
	if(!isset($_COOKIE["member_login"])) {
		$sql .= " AND parents_password = '" . $_POST["password"] . "'";
}

$result = mysqli_query($con,$sql);
$user = mysqli_fetch_array($result);
if($user) {
	$_SESSION['user'] = $data['parents_id'];
		
		if(!empty($_POST["remember"])) {
			setcookie ("member_login",$_POST["login"],time()+ (10 * 365 * 24 * 60 * 60));
			setcookie ("member_password",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
		} else {
			if(isset($_COOKIE["member_login"])) {
				setcookie ("member_login","");
			}
			if(isset($_COOKIE["member_password"])) {
				setcookie ("member_password","");
			}
		}
}
    
    # Соавниваем пароли


    if($data['parents_password'] === $_POST['password'])

    {
        // print "Привет, ".$data['parents_login'].". Всё работает!";
       
        $_SESSION['user'] = $data['parents_id'];

        // $_COOKIE[$data['parents_login']] = $var_login;
		header("Location: profile.php");
		exit();
         
    }

    else
	{

		$message1 = '
		<div class="alert alert-primary" role="alert">
  неправильный логин или пароль!
</div>
	 ';
		
	}
	   
}

?>





<?php
// session_start();
// if(!empty($_POST["login"])) {
// 	$conn = mysqli_connect("localhost", "root", "", "blog_samples");
// 	$sql = "Select * from members where member_name = '" . $_POST["member_name"] . "'";
//         if(!isset($_COOKIE["member_login"])) {
//             $sql .= " AND member_password = '" . md5($_POST["password"]) . "'";
// 	}
//         $result = mysqli_query($conn,$sql);
// 	$user = mysqli_fetch_array($result);
// 	if($user) {
// 			$_SESSION["member_id"] = $user["member_id"];
			
// 			if(!empty($_POST["remember"])) {
// 				setcookie ("member_login",$_POST["member_name"],time()+ (10 * 365 * 24 * 60 * 60));
// 			} else {
// 				if(isset($_COOKIE["member_login"])) {
// 					setcookie ("member_login","");
// 				}
// 			}
// 	} else {
// 		$message = "Invalid Login";
// 	}
// }
?>





<section class="register">
<div class="signin-form">
	<div class="container ">
		<div class="row">
			<div class="col" style="align-items:center!important; justify-content:center!important;">
				<form method="POST" id="auth-form" style="align-items:center!important; justify-content:center!important;">
					<div class="form-group">
						<label for="login">Login</label>
						<input name="login" type="text" class="form-control" id="login" style="width: 100%!important;" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" class="input-field">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input name="password" type="password" class="form-control" id="password"  style="width: 100%!important;" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>"  type="password">
					</div>


<div class="field-group">
		<div><input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
		<label for="remember-me">Remember me</label>
	</div>


					<input class="btn btn-primary" name="submit" type="submit" value="Войти">
					<a href="registration.php" class="btn btn-primary">Зарегистрироваться</a>
				</form>
			</div>
			<div class="table-responsive">
				<div id="uname_response"></div>
				<div id="uname_response1"></div>
				<div id="error">
				<?php echo $message1; ?>
			</div>
		</div>
</div>
		<section>




			</body>


			<script>
				$(document).ready(function() {
					$("#login").keyup(function() {
						var login = $(this).val().trim();
						if (login != '') {
							$.ajax({
								url: 'authAJAX.php',
								type: 'post',
								data: {
									login: login
								},
								success: function(response) {
									$('#uname_response').html(response);
								}
							});
						} else {
							$("#uname_response").html("");
						}
					});


						$("#password").keyup(function() {
							var uname = $("#login").val().trim();
						var password = $("#password").val().trim();
						if (password != '') {
							$.ajax({
								url: 'authAJAX.php',
								type: 'post',
								data: {
									password: password,uname:uname
								},
								success: function(response) {
									$('#uname_response1').html(response);
								}
							});
						} else {
							$("#uname_response1").html("");
						}
					});

				});
			</script>

			<!-- <script>
				$(document).ready(function() {
				

				});
			</script> -->

			<!-- </html> -->