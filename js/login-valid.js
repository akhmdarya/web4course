$('document').ready(function()
{

    /* validation */
    $("#auth-form").validate({
        rules:
        {
            login: {
                required: true,
                minlength: 3
            },
            password: {
                required: true,
                minlength: 3,
                maxlength: 15
            },
         
        },
        messages:
        {
            //login: "Enter a Valid Username",
            password:{
                required: "Provide a Password",
                minlength: "Password Needs To Be Minimum of 3 Characters"
            },
           
        },

        
        submitHandler: function(form) {

           
          //  $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span></div>');
            form.submit();
          }
    });


});