<!DOCTYPE html>
<html lang="en">
	<head>

        <?php
        require_once('nav.php'); // Needed for db connection
        echo $extLinks;

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Check to see if user is already logged in
        if (isset($_SESSION['username']) && isset($_SESSION['userid'])) {
            header("Location: ./index.php");
        }

        // Get data from form when register button is clicked
        if (isset($_POST['register_button'])) {
            $name       = $mysqli->real_escape_string($_POST['username']);
            $pwd        = $mysqli->real_escape_string($_POST['password']);
            $repeat_pwd = $mysqli->real_escape_string($_POST['repeat_password']);  // DEN FÅR SITT VÄRDE HÄR SÅ ÄR DECLARED
            $firstname  = $mysqli->real_escape_string($_POST['fname']);
            $lastname   = $mysqli->real_escape_string($_POST['lname']);
            $DOB        = $mysqli->real_escape_string($_POST['DOB']);
            $eMail      = $mysqli->real_escape_string($_POST['eMail']);
            $sex        = $mysqli->real_escape_string($_POST['sex']); 
        }
        ?>

        <style>
            #date-label {
                margin: 0rem!important;
            }
            
        </style>

        <link rel="stylesheet" href="Media/css/jquery.passwordRequirements.css" />
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/css/datepicker.min.css'>   

        <title>Register</title>
	</head>

	<body>
        <div class="container">
            <div class="row">
		        <?php
                echo $navigation;
                ?>
            </div>
            <div class="row">
                <h1>Register your account</h1>
                <h4>Get started today!</h4>
            </div>
            <div class="row">
                <div class="col">
                    <form action="register.php" class="form" name="registration" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" required />
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="pr-password form-control" name="password" placeholder="Password" autocomplete="off" required />
                            <div id="passwordHelpBlock" class="form-text">
                                Your password must be 8-20 characters long, contain at least 1 uppercase letter, 1 lowercase letter, 1 number and 1 special character. It must also not contain spaces.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="repeat_password" class="form-label">Repeat Password</label>
                            <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password" autocomplete="off" required />
                        </div>

                        <div class="mb-3">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="fname" placeholder="First Name" autocomplete="off" />
                        </div>

                        <div class="mb-3">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="lname" placeholder="Last Name" autocomplete="off" />
                        </div>

                        <div class="mb-3" id="date-label">
                            <label for="DOB" class="form-label">Date of birth</label>
                        </div>

                        <div class="input-group mb-3">
                            <i class="bi bi-calendar-date input-group-text"></i>
                            <input type="text" id="datepicker" class="datepicker_input form-control" name="DOB" placeholder="YYYY-MM-DD" required aria-label="Select your date of birth">
                        </div>

                        <div class="mb-3">
                            <label for="eMail" class="form-label">Email</label>
                            <input type="email" class="form-control" name="eMail" placeholder="Email" autocomplete="off" required />
                            <div id="emailHelp" class="form-text">Must be a valid email e.g. name@domain.com</div>
                        </div class="mb-3">
                    
                        <div class="form-check">
                            <input type="radio" name="sex" value="M" id="sexM" class="form-check-input">
                            <label class="form-check-label" for="sexM">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="sex" value="F" id="sexF" class="form-check-input">
                            <label class="form-check-label">
                                Female
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="sex" value="O" id="sexO" class="form-check-input">
                            <label class="form-check-label">
                                Other
                            </label>
                            <br>
					    </div>
                        <div id="errorMsg"></div>

                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <br>
                                <input type="submit" class="btn btn-primary" name="register_button" value="Create Account" />
                            </div>
                            <div class="col-auto">
                                <span class="form-text">
                                    Already have an account? <a href="login.php">Login here</a>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
            include('footer.php');
        ?>
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker-full.min.js'></script>
        <script src="Media/js/jquery.passwordRequirements.min.js"></script>
        <script src="Media/js/jquery.validate.min.js"></script>
        <script src="Media/js/formValidation.js"></script>

    </body>
</html>

<!-- Förmodligen skräp
    // Verify entered data
            if ($name != "" && $pwd != "" && $repeat_pwd != "" && $eMail != "") {
                // Check that entered passwords match
                if (true) { //($pwd === $repeat_pwd) {  // NÅGOT STÄMMER INTE HÄR | STÅR UNDEFINED VARIABLE PÅ REPEAT_PWD MEN VISAR VÄRDET I DEN
                    // Check that pwd meets min req
                    if (strlen($pwd) >= 5 && strpbrk($pwd, "!#$.,:;()") != false) {
                        // Check if username is taken
                        $query = mysqli_query($mysqli, "SELECT * FROM users WHERE username='{$name}'");
                        if (mysqli_num_rows($query) == 1) { // sdasdasdasSADSDASDDSA
                            // Encrypt password
                            $pwd = md5($pwd);
                            // Insert query to create the user
                            $query = "INSERT INTO HD_Users (username, password, fname, lname, DOB, eMail, sex) VALUES ('{$name}', '{$pwd}', '{$firstname}', '{$lastname}', '{$DOB}', '{$eMail}', '{$sex}')";
                            $mysqli-> query($query);
                            // Verify account creation
                            $query = "SELECT * FROM HD_Users WHERE username='{$name}'";
                            if ($mysqli->query($query) == TRUE) {
                                $success = true;
                            }
                            else
                                $error_msg = 'An error occurred and your account was not created.';
                        }
                        else
                            $error_msg = 'The username <i>'.$name.'</i> is already taken. Please use another.';
                    }
                    else
                        $error_msg = 'Password is not strong enough, make sure it meets the minimum requirements.';
                }
                else
                    $error_msg = 'The passwords do not match.';
            }
            else
                $error_msg = 'Please fill out all the required fields.'; 
-->


<!-- Förmodligen  mer skräp
            <div class="">
            <?php
                    /*if (isset($success) && $success == true) {
                        echo '<p color="green">Your account has been created. <a href="./login.php">Click here</a> to login!</p>';
                    }
                    else if (isset($error_msg)) {
                        echo '<p color="red">'.$error_msg.'</p>';
                    }
                    else {
                        echo ''; // do nothing
                    }*/
                ?>
            </div>
            -->