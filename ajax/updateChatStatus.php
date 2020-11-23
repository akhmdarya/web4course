  <!-- $q = INSERT INTO messages (chat_id, text, sender) VALUES (1, "Hello", 55) RETURNING id; -->
<!-- $data = mysqli_fetch_assoc($q);
$id = $data['id']; -->

<!-- UPDATE messages SET status = true WHERE id = $id -->

<!-- UPDATE messages SET status = true WHERE chat_id = 1 AND sender = !currentuser -->

<?php
$con=mysqli_connect("localhost", "root", "", "parents");
  session_start();
  $current_user = $_SESSION['user'];
// include Database connection file

 $id = $_POST['id'];


  
 $query = mysqli_query($con, "UPDATE messages SET status = 1 WHERE chat_id='$id' AND sender!=".$current_user);
    //    $query = "UPDATE tweets SET title = '$title', tweet = '$tweet' WHERE id='$id' ";
    // $query = "UPDATE messages SET status = 1, tweet = '$tweet' WHERE id='$id' ";
    ?>