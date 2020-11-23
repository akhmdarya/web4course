<?php
// include Database connection file
$con=mysqli_connect("localhost", "root", "", "parents");

if(isset($_POST))
{
    $id = $_POST['id'];
    $active = $_POST['active'];

    $query = "UPDATE parents SET parents_active = '$active' WHERE parents_id='$id' ";
    if (!$result = mysqli_query($con, $query)) {
        exit(mysqli_error($con));
    }
}