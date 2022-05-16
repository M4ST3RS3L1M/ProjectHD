$(document).ready(function() {
    
    var username_state = false;
    var email_state = false;

    // CHECKS IF USERNAME IS TAKEN
    $('#username').on('blur', function(){
        var username = $('#username').val();
        if (username == '') {
            username_state = false;
            return;
        }
        $.ajax( {
            url: 'register.php',
            type: 'POST',
            data: {
                'username_check' : 1,
                'username' : username,
            },
            success: function(response) {
                // If username is taken..
                if (response.includes('unavailable--')) {
                    username_state = false;
                    // ..add classes to indicate
                    $('#username').removeClass();
                    $('#username').addClass("form-control is-invalid");
                    $('#uname_response').removeClass();
                    $('#uname_response').addClass("mb-3 invalid-entry");
                    $('#uname_response').text("Username is already taken");
                }
                // If username is not taken..
                else if (response.includes('not_taken--')) {
                    username_state = true;
                    // ..add classes to indicate
                    $('#username').removeClass();
                    $('#username').addClass("form-control is-valid");
                    $('#uname_response').removeClass();
                    $('#uname_response').addClass("mb-3 valid-entry");
                    $('#uname_response').text("Username is available");
                }
            }
        });
    });

    // CHECKS IF EMAIL IS ALREADY REGISTERED
    $('#eMail').on('blur', function() {
        var email = $('#eMail').val();
        if (email == '') {
            email_state = false;
            return;
        }
        $.ajax( {
            url: 'register.php',
            type: 'POST',
            data: {
                'email_check' : 1,
                'eMail' : email,
            },
            success: function(response){
                // If email is already registered..
                if (response.includes('unavailable--')) {
                    email_state = false;
                    // ..add classes to indicate
                    $('#eMail').removeClass();
                    $('#eMail').addClass("form-control is-invalid");
                    $('#email_response').removeClass();
                    $('#email_response').addClass("form-text invalid-entry");
                    $('#email_response').text("This email is already registered");
                }
                // If email is available..
                else if (response.includes('not_taken--')) {
                    email_state = true;
                    // ..add classes to indicate
                    $('#eMail').removeClass();
                    $('#eMail').addClass("form-control is-valid");
                    $('#email_response').removeClass();
                    $('#email_response').addClass("form-text valid-entry");
                    $('#email_response').text("Email is available");
                }
            }
        });
    });
    
    // DATEPICKER FOR DATE OF BIRTH
    // Codelet from https://word-sentences.com/code-examples/bootstrap-5-datepicker-with-vanilla-js/
    const getDatePickerTitle = elem => {
        // From the label or the aria-label
        const label = elem.nextElementSibling;
        let titleText = '';
        if (label && label.tagName === 'LABEL') {
          titleText = label.textContent;
        }
        else {
          titleText = elem.getAttribute('aria-label') || '';
        }
        return titleText;
    }
      
      const elems = document.querySelectorAll('.datepicker_input');
      for (const elem of elems) {
        const datepicker = new Datepicker(elem, {
          'format': 'yyyy-mm-dd', // DB format
          title: getDatePickerTitle(elem)
        });
    }

    // PASSWORD REQUIREMENTS WHILE TYPING
    $(function(){
          $(".pr-password").passwordRequirements( {
              style:"light"
          });
    });
    
    // RULE TO FORCE STRONG PASSWORDS
    // Method by '@ketan chaudhari'
    // https://stackoverflow.com/a/69009376
    $.validator.addMethod("strong_password", function (value, element) {
        let password = value;
        if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%&])(.{8,20}$)/.test(password))) {
            return false;
        }
        return true;
    }, function (value, element) {
        let password = $(element).val();
        if (!(/^(.{8,20}$)/.test(password))) {
            return 'Password must be between 8 to 20 characters long.';
        }
        else if (!(/^(?=.*[A-Z])/.test(password))) {
            return 'Password must contain at least one uppercase.';
        }
        else if (!(/^(?=.*[a-z])/.test(password))) {
            return 'Password must contain at least one lowercase.';
        }
        else if (!(/^(?=.*[0-9])/.test(password))) {
            return 'Password must contain at least one digit.';
        }
        else if (!(/^(?=.*[@#$%&])/.test(password))) {
            return "Password must contain special characters from @#$%&.";
        }
        return false;
    }),
    
    // VALIDATION RULES FOR REGISTRATION FORM
    $(function() {
        $("form[name='registration']").validate({
            
            // Rules for each field
            rules: {
                username: "required",
                password: {
                    required: true,
                    strong_password: true
                },
                repeat_password: {
                    required: true,
                    equalTo: "#password"
                },
                fname: "required",
                lname: "required",
                DOB: "required",
                eMail: {
                    required: true,
                    email: true
                },
                terms: "required"
            },
            
            // Corresponding error messages
            messages: {
                username: {
                    required: "Please enter a username"
                },
                password: {
                    required: "Please enter a password",
                    minlength: "The password need to be between 8 and 20 characters long"
                },
                repeat_password: {
                    required: "Please repeat your chosen password",
                    equalTo: "The passwords do not match!"
                },
                fname: {
                    required: "Please enter your first name"
                },
                lname: {
                    required: "Please enter your last name"
                },
                DOB: {
                    required: "Please enter your date of birth"
                },
                eMail: {
                    required: "Please enter your email",
                    email: "Your entered email is not valid, make sure it follows the correct format."
                }
            },
            submitHandler: function(form, event) {
				// Prevent form submission if rules are not met
                event.preventDefault();
                
                // Gets data from fields when reg_bth is clicked
                $('#reg_btn').on('click', function() {
                    var username = $('#username').val();
                    var password = $('#password').val();
                    var repeat_password = $('#repeat_password').val();
                    var firstname = $('#fname').val();
                    var lastname = $('#lname').val();
                    var DOB = $('#datepicker').val();
                    var email = $('#eMail').val();
                    var sex = $("input[name='sex']:checked").val();
                    if (username_state == false || email_state == false) {
                        $('#error_msg').text('You have to fix the errors in the form before you can create your account');
                    }
                    else { // proceed with form submission
                        $.ajax( {
                            url: 'register.php',
                            type: 'POST',
                            data: {
                                'save' : 1,
                                'username' : username,
                                'password' : password,
                                'repeat_password' : repeat_password,
                                'fname' : firstname,
                                'lname' : lastname,
                                'DOB' : DOB,
                                'eMail' : email,
                                'sex' : sex,
                            },
                            // Redirects to login page upon successful registration
                            success: function(response) {
                                window.location.href = 'login.php';
                            }
                        });
                    }
                });
            }
        });
    });
});
