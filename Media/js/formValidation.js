$(document).ready(function() {
    $(function() {
        $("form[name='registration']").validate({
            rules: {
                username: "required",
                password: {
                    required: true,
                    minlength: {
                        text: "be at least minLength characters long",
                        minLength: 8,
                    },
                    containSpecialChars: {
                        text: "Your input should contain at least minLength special character",
                        minLength: 1,
                        regex: new RegExp('([^!,%,&,@,#,$,^,*,?,_,~])', 'g')
                    },
                    containLowercase: {
                        text: "Your input should contain at least minLength lower case character",
                        minLength: 1,
                        regex: new RegExp('[^a-z]', 'g')
                    },
                    containUppercase: {
                        text: "Your input should contain at least minLength upper case character",
                        minLength: 1,
                        regex: new RegExp('[^A-Z]', 'g')
                    },
                    containNumbers: {
                        text: "Your input should contain at least minLength number",
                        minLength: 1,
                        regex: new RegExp('[^0-9]', 'g')
                    }
                },
                repeat_password: "required",
                fname: "required",
                lname: "required",
                DOB: "required",
                eMail: {
                    required: true,
                    email: true
                },
                sex: "required",
                
                messages: {
                    username: "Please enter a username",
                    password: "Please enter a password",
                    repeat_password: "Please repeat your chosen password",
                    fname: "Please enter your first name",
                    lname: "Please enter your last name",
                    DOB: "Please enter your date of birth",
                    eMail: "Please enter your email"
                },
                sex: "required",
            }
        });
    });
});