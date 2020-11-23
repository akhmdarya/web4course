function readComments() {
    $.get("readComments.php", {}, function (data, status) {
        $(".coms").html(data);
   });
}

$(document).ready(function(){
        // get hidden field value
        var id = $("#tweet_id").val();
        readComments();
        // Update the details by requesting to the server using ajax
        //getComments();
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"ajax/add_comment.php",
   method:"POST",
   data:form_data,
   dataType:"JSON",
   success:function(data)
   {
   //readComments();

    if(data.error != '')
    {
     $('#comment_form')[0].reset();
     $('#comment_message').html(data.error);
     $('#comment_id').val('0');
     //load_comment();
     //readComments();
     $("#update_user_modal").modal("hide");
     //location.reload();
     readComments();
    }
   }
  })
 });
 //readComments();
 load_comment();
 //readComments();
 function load_comment()
 {
    //location.reload();

    //var form_data = $(this).serialize();
  $.ajax({
   url:"ajax/fetch_comment.php",
   method:"POST",

   success:function(data)
   {
   
   // $('#display_comment').html(data);
  //readComments();
  
   }
  })
 }

 $(document).on('click', '.reply', function(){
   // readComments();
  var comment_id = $(this).attr("id");
  $('#tweet_id').val(comment_id);
  $('#comment_name').focus();
  //readComments();

  
 });
 
 });





function toReplyPost(tweet_id) {
    // Add User ID to the hidden field for furture usage
    $("#tweet_id").val(tweet_id);
    $.post("ajax/fetch_comment.php", {
        tweet_id: tweet_id
        },
        function (data, status) {
            // PARSE json data
          //  var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            //$("#update_title").val(user.title);
            //$("#update_tweet").val(user.tweet);
           
        }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}
function DeleteComment(id) {
  
    $.post("ajax/deleteComment.php", {
            id: id
        },
        function (data, status) {
            // reload Users by using readRecords();
            readComments();
        }
    );

}



    function addComment() {
        // get values

        
    
        // get hidden field value
        var tweet_id = $("#tweet_id").val();
    
        // Update the details by requesting to the server using ajax
        $.post("ajax/fetch_comment.php", {
            tweet_id: tweet_id
            }
        );
    }













// $(document).ready(function () {
//     // READ recods on page load
//     //readRecords(); // calling function
// });