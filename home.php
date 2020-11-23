
<?php

// configuration

$con=mysqli_connect("localhost", "root", "", "parents");

$row = $_POST['row'];
$rowperpage = 3;


// $query = 'SELECT * FROM tweets limit '.$row.','.$rowperpage;
// $result = mysqli_query($con,$query);


//$result = mysqli_query($con,$query);


// selecting posts
$query = 'SELECT t.id as tweet_id, t.tweet as tweet, t.post_date as post_date,t.title as title,t.link as link, p.parents_login as parents_login, p.parents_img as img 
FROM tweets t LEFT JOIN parents p on t.user_id = p.parents_id 	ORDER BY id DESC limit '.$row.','.$rowperpage;
//$query = 'SELECT * FROM tweets limit '.$row.','.$rowperpage;

$result = mysqli_query($con,$query);

$html = '';

while($row = mysqli_fetch_array($result)){
    $img=$row['img'];
    $tweet_id=$row['tweet_id'];
    $id = $row['parents_login'];
    $title = $row['title'];
    $content = $row['tweet'];
    $shortcontent = substr($content, 0, 50)."...";
   $link = $row['link'];
    // Creating HTML structure


    $post=$row['tweet_id'];


            
    $html .= '<div id="post_'.$id.'" class="post">';



    $html .= '<div class="card text-left">';
    $html .=' <div class="card-header">';
    $html .='<button onclick="toReplyPost('.$row['tweet_id'].')" class="btn btn-primary" style="display:block;position:absolute;right:0;top:0;"  name="tweet_id">Reply</button>';
    $html .=  '<img src="images/'.$row['img'].'" class="img-responsive" style=" max-height:125px !important;"	/>Автор: ';
    $html .=  $row['parents_login'];
    $html .= '</div>';
    $html .= '</div>';


  
    $html .= '<h1>'.$title.'</h1>';
    $html .= '<p>'.$shortcontent.'</p>';
    $html .= '<span class="readmore12" id="readmore1"><p class="read">Read More...</p>';
    $html .= '<img class="caret1" id="caret12" src="images/caret-down.svg"/>';
    $html .= '</span>';
    $html .= '<div class="message">';
    $html .=  $content;
    $html .= '</div>';
    $html .= '<button onclick="toReplyPost('.$row['tweet_id'].')" class="btn btn-primary" style="display:block; margin-left:90% ;margin-bottom: 7px;"  name="tweet_id">Reply</button>';
    $html .= '<a href="'.$link.'" target="_blank" class="more">More</a>';
    $connect = new PDO('mysql:host=localhost;dbname=parents', 'root', '');
  
        
    // $query1 = "SELECT * FROM tweets  LEFT JOIN parents on tweets.user_id = parents.parents_id  LEFT JOIN comments on tweets.id = comments.com_post_id WHERE comments.com_post_id= '$post' ORDER BY comments.com_id DESC";
	$query1 = "SELECT 
					c.com_id, c.com_user, c.com_text, c.com_date, c.com_post_id, p.parents_login, p.parents_img 
				FROM 
					comments c 
				LEFT JOIN 
					parents p on c.com_user = p.parents_id 
				WHERE 
					c.com_post_id= '$post'
				ORDER BY 
					c.com_id DESC";
			
$statement = $connect->prepare($query1);

$statement->execute();

$result1 = $statement->fetchAll();
$output = '';
//$output1 = '';

foreach($result1 as $row)
{
$html .= '

<div class="post1">
<div class="panel-heading"><img src="images/'.$row['parents_img'].'" class="img-responsive" style=" max-height:70px !important;  border-radius: 100px;
box-shadow: 0 0 7px #666;max-width: 100px;"	/>By <b>'.$row["parents_login"].'</b> on <i>'.$row["com_date"].'</i></div>
<div class="panel-body">'.$row["com_text"].'</div>
<button onclick="DeleteComment('.$row['com_id'].')" class="btn btn-danger" style="display:block; margin-left:90% ;margin-bottom: 7px;">Delete</button>

<div class="panel-footer" align="right"></div>
</div>

';

}


$html .= '<div id="display_comment"></div>';

$html .= '</div>';

}

echo $html;
?>
<script >
    
    var acc = document.getElementsByClassName("readmore12");
    var imgclass = document.getElementById("caret12");
  
    // var readmore = document.getElementsByClassName("readmore1");
    
    var i;
    var j;
    var flag=false;
    
    
    for (i = 0; i < acc.length; i++) {
       // console.log(i);
      acc[i].addEventListener("click", function() {
        console.log('works');
        // console.log(i);
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");
        this.getElementsByTagName('img')[0].classList.toggle('rotate');
    var read= this.getElementsByClassName("read");
        var sh = this.previousElementSibling;
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
          panel.style.display = "none";
        //   $('.read').click(function(){
            sh.style.display = "block";
        $(read).text("read More..");
        // });
        } else {
    
    
          panel.style.display = "block";
          sh.style.display = "none";
        
                    $(read).text("Read LESS");
                  
           
            
        //   readmore.style.display = "none";
        }
      });
    }
    
    
    function toggleDropList(node) {
        imgclass.onclick = function(){
            this.classList.toggle('rotate');
                    // $(read).text("read More..");
        }
    }
</script>