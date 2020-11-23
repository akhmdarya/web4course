$(document).ready(function(){
 $("#tweet").append("<img class='img-responsive' style=' max-height:50px !important' src='images/not-found.svg'</a>");
 $("#parents_login").append("Ничего не найдено");
$("#txt_search").keyup(function(){
    var search = $(this).val();

    if(search != ""){

        $.ajax({
            url: 'ajax/getSearch.php',
            type: 'post',
            data: {search:search, type:1},
            dataType: 'json',
            success:function(response){
            
                var len = response.length;
                $("#searchResult").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var title = response[i]['title'];

                    $("#searchResult").append("<li value='"+id+"'>"+title+"</li>");

                }

                // binding click event to li
                $("#searchResult li").bind("click",function(){
                    setText(this);
                });

            }
        });
    }

});

});

// Set Text to search box and get details
function setText(element){

var value = $(element).text();
var postid = $(element).val();

$("#txt_search").val(value);
$("#searchResult").empty();

// Request User Details
$.ajax({
    url: 'ajax/getSearch.php',
    type: 'post',
    data: {postid:postid, type:2},
    dataType: 'json',
    success: function(response){

        var len = response.length;
        $("#postDetail").empty();
        $("#tweet").empty();
        $("#title").empty();
        $("#img").empty();
        $("#parents_login").empty();
        $("#post_date").empty();
        if(len > 0){
            var tweet = response[0]['tweet'];
            var post_date = response[0]['post_date'];
            var parents_login = response[0]['parents_login'];
            var title = response[0]['title'];
            var img = response[0]['img'];
           // $("#postDetail").append("Username : " + tweet + "<br/>");
           // $("#postDetail").append("Email : " + post_date);
           //$("#body").val();
            $("#tweet").append("" + tweet);
            $("#post_date").append("Дата : " + post_date);
            $("#parents_login").append("Автор : " + parents_login);
            $("#title").append("" +  title);
            $("#img").append("<img class='img-responsive' style='max-height:125px !important' src='images/"+img +"'/>");
        }
    }

});
}
