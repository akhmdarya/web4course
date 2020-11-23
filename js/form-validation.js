$('document').ready(function()
{

    /* validation */
    $("#register-form").validate({
        rules:
        {
            login: {
                required: true,
                minlength: 3
            },
            password_1: {
                required: true,
                minlength: 3,
                maxlength: 15
            },
            password_2: {
                required: true,
                equalTo: '#password_1',
                minlength: 3
            },
            // user_email: {
            //     required: true,
            //     email: true
            // },
        },
        messages:
        {
            //login: "Enter a Valid Username",
            password:{
                required: "Provide a Password",
                minlength: "Password Needs To Be Minimum of 3 Characters"
            },
            // user_email: "Enter a Valid Email",
            password_2:{
                required: "Retype Your Password",
                equalTo: "Password Mismatch! Retype"
            }
        },

        
        submitHandler: function(form) {

           
          //  $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span></div>');
            form.submit();
          }
    });
    /* validation */

    /* form submit */
    // function submitForm()
    // {
    //     var data = $("#register-form").serialize();

    //     $.ajax({

    //         type : 'POST',
    //         url  : 'registration.php',
    //         data : data,
    //         beforeSend: function()
    //         {
    //             $("#error").fadeOut();
    //             $("#btn-submit").html('<span class="glyphicon glyphicon-transfer"></span>   sending ...');
    //         },
    //         success :  function(data)
    //         {
    //             if(data==0){

    //                 $("#error").fadeIn(1000, function(){


    //                     $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span>   Sorry email already taken !</div>');

    //                     $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span>   Create Account');

    //                 });

    //             }
    //             else if(data=="registered")
    //             {

    //                 $("#btn-submit").html('Signing Up');
    //                 setTimeout('$(".form-signin").fadeOut(500, function(){ $(".signin-form").load("registration.php"); }); ',5000);

    //             }
    //             else{

    //                 $("#error").fadeIn(1000, function(){

    //                     $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span>   '+data+' !</div>');

    //                     $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span>   Create Account');

    //                 });

    //             }
    //         }
    //     });
    //     return false;
    // }
    /* form submit */

});