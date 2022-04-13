$(document).ready(function() {
    
    // DATEPICKER
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
              style:"dark"
          });
    });
    
    // RULE TO FORCE STRONG PASSWORDS
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
                sex: "required",
            },
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
            submitHandler: function(form) {
                form.submit();}
        });
    });
});