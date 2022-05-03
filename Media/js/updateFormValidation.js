$(document).ready(function() {
    
    // VALIDATION RULES FOR REGISTRATION FORM
    $(function() {
        $("form[name='updateUser']").validate({
            
            // Rules for each field
            rules: {
                username: "required",
                fName: "required",
                lName: "required",
                DOB: "required",
                eMail: {
                    required: true,
                    email: true
                },
                sex: true
            },
            
            // Corresponding error messages
            messages: {
                username: {
                    required: "Please enter a username"
                },
                fname: {
                    required: "Please enter first name of user"
                },
                lname: {
                    required: "Please enter last name of user"
                },
                DOB: {
                    required: "Please enter user's date of birth"
                },
                eMail: {
                    required: "Please enter user's email",
                    email: "The entered email is not valid, make sure it follows the correct format"
                },
                sex: {
                    required: "Please enter sex of user (M, F or O)"
                }
            }
        });
    });
});