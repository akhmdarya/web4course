// Add Record
function addRecord() {
    // get values
    var title = $("#title").val();
    var tweet = $("#tweet").val();
  

    // Add record
    $.post("ajax/addRecord.php", {
        title: title,
        tweet: tweet
    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        readRecords();

        // clear fields from the popup
        $("#title").val("");
        $("#tweet").val("");
       
    });
}

// READ records
function readRecords() {
    $.get("ajax/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
    });
}


function DeleteUser(id) {
  
        $.post("ajax/deleteUser.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readRecords();
            }
        );
    
}

function UpdateUserStatus(id,active,operation) {
  console.log("UpdateUserStatus works!")
  console.log(id, active, operation )
    $.post("ajax/userStatus.php", {
            id: id,
            active:active
        },
        function (data, status) {
            if (operation=="activate"){
                console.log("Activate case works!")
                var deactiveUserInfo= document.getElementsByClassName("userIsDeactive");
                deactiveUserInfo[0].style.display = "none";
              
                var activeUserInfo= document.getElementsByClassName("userIsActive");
                activeUserInfo[0].style.display = "flex";

            }else if (operation =="deactivate"){
                console.log("Deactivate case works!")
                var deactiveUserInfo= document.getElementsByClassName("userIsDeactive");
                deactiveUserInfo[0].style.display = "block";
            
                var activeUserInfo= document.getElementsByClassName("userIsActive");
                activeUserInfo[0].style.display = "none";

            }else{
                console.log("Laja")
            }
        }
    );

}

function GetUserDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#tweet_id").val(id);
    $.post("ajax/readUserDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#update_title").val(user.title);
            $("#update_tweet").val(user.tweet);
           
        }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}

function UpdateUserDetails() {
    // get values
    var title = $("#update_title").val();
    var tweet = $("#update_tweet").val();
    

    // get hidden field value
    var id = $("#tweet_id").val();

    // Update the details by requesting to the server using ajax
    $.post("ajax/updateUserDetails.php", {
            id: id,
            title: title,
            tweet: tweet
        },
        function (data, status) {
            // hide modal popup
            $("#update_user_modal").modal("hide");
            // reload Users by using readRecords();
            readRecords();
        }
    );
}

$(document).ready(function () {
    // READ recods on page load
    readRecords(); // calling function
});