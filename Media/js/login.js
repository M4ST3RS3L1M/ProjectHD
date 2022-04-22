$(document).ready(function() {

    var credentials_state = false;

    $('#login_btn').on('click', function() {
        var username = $('#loginName').val();
        var password = $('#typePasswordX').val();
        if (username == '' || password == '') {
            credentials_state = false;
        }
        $.ajax( {
            url: 'login.php',
            type: 'POST',
            data: {
                'credentials_check' : 1,
                'username' : username,
                'password' : password,
            },
            success: function(response) {
                // If credentials are incorrect
                if (response.includes('incorrect--')) {
                    credentials_state = false;
                }
                // If credentials are correct
                else if (response.includes('cred--match')) {
                    credentials_state = true;
                }
            }
        })
        $(function() {
            $("form[name='login']").validate({

                rules: {
                    username: "required",
                    password: "required"
                },

                messages: {
                    username: {
                        required: "This field is required"
                    },
                    password: {
                        required: "This field is required"
                    }
                },
                submitHandler: function(form, event) {
                    event.preventDefault();

                    if (credentials_state == false) {
                        $('#error_msg').text("Wrong username or password. Try again");
                    }
                    else {
                        window.location.href = 'index.php';
                    }
                }
            })
        })
    });
});