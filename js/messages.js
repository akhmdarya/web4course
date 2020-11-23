var id;
function updateChatStatus(id) {

 

$.post("ajax/updateChatStatus.php", {id:id}, function (data, status) {
    
   console.log("kek");
   readchat(id);
});  
}


function readchat(id) {
    $.post("ajax/messages.php", {id:id}, function (data, status) {
        $(".card").hide();
        $(".chats").html(data);
      id=id; 
    });    
}
// 
var id;
function openChat(id) {
    console.log("Open Chat ID :"+id);
updateChatStatus(id);


$.post("ajax/messages.php", {id:id}, function (data, status) {
    $(".card").hide();
    $(".chats").html(data);
  id=id; 
  
});   
}
console.log(id);

function writeMessage(id) {
    // get values

    var message = $("#message").val();
  

    // Add record
    $.post("ajax/writeMessage.php", {
       
        message: message,
        id:id
    }, function (data, status) {
        // close the popup
        // $("#add_new_record_modal").modal("hide");

        // read records again
        openChat(id);

        // clear fields from the popup
      
        $("#message").val("");
       
    });
}


