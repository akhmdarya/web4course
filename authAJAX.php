<?php
include "config.php";
$con=mysqli_connect("localhost", "root", "", "parents");




# если ошибка
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
//$login = $_POST['login'];



if(isset($_POST['login']) ){
   $login = $_POST['login'];
   //$password = $_POST['password'];
  // $password =  $_POST['password'];
   $query = "select count(*) as cntUser from parents where parents_login='".$login."'";

   $result = mysqli_query($con,$query);
   $response = "<span style='color: red;'>LOGIN NOT EXISTS.</span>";
   if(mysqli_num_rows($result)){
      $row = mysqli_fetch_array($result);

      $count = $row['cntUser'];
    
      if($count > 0){
          $response = "<span style='color: green;'>LOGIN EXISTS.</span>";
      }
   
   }




   echo $response;
  // echo $response1;
   die;
}



$password = mysqli_real_escape_string($con,$_POST['password']);
$uname = mysqli_real_escape_string($con,$_POST['uname']);

  if ( $password != ""){

    $sql_query = "select count(*) as cntUser from parents where parents_login='".$uname."' and parents_password='".$password."'";
    $result1 = mysqli_query($con,$sql_query);
    $row1 = mysqli_fetch_array($result1);

    $count1 = $row1['cntUser'];

    if($count1 <= 0){
       // $_SESSION['uname'] = $uname;
       $response1 = "<span style='color: red;'>WRONG PASS.</span>";

    }
    else{
        $response1 = "<span style='color: green;'>RIGHT PASS.</span>";

    }
     
    echo $response1;
    // }else{
    //     echo 0;
    // }
   }
