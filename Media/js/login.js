$(document).ready(function() {

    // Clear error message when typing
    $("#loginName").focus(function() {
        $('#error_msg').text('');
    });
    $("#typePasswordX").focus(function() {
        $('#error_msg').text('');
    });
    
    // Gets data from fields when the button is clicked
    $("#login_btn").on('click', function() {
        var username = $("#loginName").val().trim();
        var password = $("#typePasswordX").val().trim();

        if( username != "" && password != "" ) {
            $.ajax({
                url:'login.php',
                type:'POST',
                data: {
                    username:username,
                    password:password},
                success:function(response) {
                    if(response.includes('cred--match')) {
                        window.location.href = 'visualizeUserData.php';
                    }
                    else {
                        $('#error_msg').text("Wrong username or password. Try again");
                    }
                }
            });
        }
    });
    $(function() {
        $("form[name='login']").validate({

            rules: {
                username: "required",
                password: "required"
            },

            messages: {
                username: {
                    required: "Enter your username"
                },
                password: {
                    required: "Enter your password"
                }
            },
            submitHandler: function(form, event) {
                event.preventDefault();
            }
        })
    })
});