function addFriend(id) {
    $.post("ajax/addFriend.php", {
        id: id
    }, function () {
        $("#btn-add-friend-"+id).text("Запрос отправлен");
    });
    
}

function acceptFriend(id) {
    $.post("ajax/acceptFriend.php", {
        id: id
    }, function () {
        $("#btn-accept-friend-"+id).text("ДРУГ ДОБАВЛЕН");
        console.log($("#btn-reject-friend-"+id));
        $("#btn-reject-friend-"+id).hide();
        // .display="none";
    });
    
}

function rejectFriend(id) {
    $.post("ajax/rejectFriend.php", {
        id: id
    }, function () {
        $("#btn-reject-friend-"+id).text("ЗАПРОС ОТКЛОНЕН");
        $("#btn-accept-friend-"+id).hide();
    });
    
}

function cancelOutRequest(id) {
    $.post("ajax/cancelOutRequest.php", {
        id: id
    }, function () {
        $("#btn-cancelOutRequest-friend-"+id).text("ОТМЕНЕН");

    });
    
}

function changeCancelOutRequestTextOver(id,text){
    // console.log("changeCancelOutRequestTextOver");
    $("#btn-cancelOutRequest-friend-"+id).text(text);
}

function changeCancelOutRequestTextOut(id){
    console.log("changeCancelOutRequestTextOut");
    $("#btn-cancelOutRequest-friend-"+id).text("Запрос отправлен");
}
