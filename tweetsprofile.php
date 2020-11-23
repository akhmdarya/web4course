<!-- <script src="//code.jquery.com/jquery-1.11.0.min.js"></script> -->
<!-- <script type="text/javascript" src="js/bootstrap.js"></script>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />-->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 


 Latest compiled and minified CSS -->
 <!-- <link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.css"/> -->

<?php
include 'header2.php';

  $con=mysqli_connect("localhost", "root", "", "parents");

    session_start();
    $current_user = $_SESSION['user'];
 


    $query = mysqli_query($con, "SELECT * FROM parents WHERE parents_id='".$current_user."'");
    $data = mysqli_fetch_assoc($query);
    $login = $data['parents_login'];
    $mail = $data['parents_mail'];
    $img = $data['parents_img'];




    // $queryTweets = mysqli_query($con, "SELECT * FROM tweets");
    // $data = mysqli_fetch_assoc($queryTweets);
    // $id = $data['id'];
    // $date = $data['post_date'];
    // $tweet = $data['tweet'];  
    // $user_id = $data['user_id'];
    
    $result = mysqli_query($con, "SELECT t.id as id,t.title as title, t.tweet as tweet, t.post_date as post_date, p.parents_login as parents_login, p.parents_img as img FROM tweets t LEFT JOIN parents p on t.user_id = p.parents_id WHERE p.parents_id = ".mysqli_real_escape_string($con, $current_user));
?>




<html lang="en">
<head>
    <meta charset="UTF-8">
  

    <!-- Bootstrap CSS File  -->
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.css"/>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" -->
</head>
<body>

<section class="tweets">
  <div class="container1 ">
    <div class="row">
        <div class="col-md-12">
           
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Add New Record</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Records:</h3>

            <div class="records_content"></div>
        </div>
    </div>
</div>
</div>
<!-- /Content Section -->


<!-- Bootstrap Modals -->
<!-- Modal - Add New Record/User -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" placeholder="title" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="tweet">Tweet</label>
                    <input type="text" id="tweet" placeholder="tweet" class="form-control"/>
                </div>

             

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addRecord()">Add Record</button>
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->

<!-- Modal - Update User details -->
<div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="update_title">Title</label>
                    <input type="text" id="update_title" placeholder="title" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="update_tweet">Tweet</label>
                    <input type="text" id="update_tweet" placeholder="tweet" class="form-control"/>
                </div>

                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="UpdateUserDetails()" >Save Changes</button>
                <input type="hidden" id="tweet_id"  name="tweet_id">
            </div>
        </div>
    </div>

<!-- // Modal -->

<!-- Jquery JS file -->
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>

<!-- Bootstrap JS file -->
<script type="text/javascript" src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>

<!-- Custom JS file -->
<script type="text/javascript" src="js/modal.js"></script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-75591362-1', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>
