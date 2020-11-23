<?php

$con=mysqli_connect("localhost", "root", "", "parents");


# если ошибка
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['login'])){
   $login = $_POST['login'];

   $query = "select count(*) as cntUser from parents where parents_login='".$login."'";

   $result = mysqli_query($con,$query);
   $response = "<span style='color: green;'>LOGIN Available.</span>";
   if(mysqli_num_rows($result)){
      $row = mysqli_fetch_array($result);

      $count = $row['cntUser'];
    
      if($count > 0){
          $response = "<span style='color: red;'>LOGIN Not Available.</span>";
      }
   
   }

   echo $response;
   die;
}



