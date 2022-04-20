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

        // Query to see if username is already in db
        if (isset($_POST['username_check'])) {
            $username = $_POST['username'];
            $query = "SELECT * FROM HD_Users WHERE username='$username'";
            $output = mysqli_query($mysqli, $query);
            if (mysqli_num_rows($output) > 0) {
                echo "unavailable--";	
            }
            else {
                echo 'not_taken--';
            }
            exit();
        }
        // Query to see if email is already in db
        if (isset($_POST['email_check'])) {
            $email = $_POST['eMail'];
            $query = "SELECT * FROM HD_Users WHERE eMail='$email'";
            $output = mysqli_query($mysqli, $query);
            if (mysqli_num_rows($output) > 0) {
                echo "unavailable--";	
            }
            else{
                echo 'not_taken--';
            }
            exit();
        }
        // Get data from form when register button is clicked
        if (isset($_POST['save'])) {
            $username       = $mysqli->real_escape_string($_POST['username']);
            $pwd        = $mysqli->real_escape_string($_POST['password']);
            $repeat_pwd = $mysqli->real_escape_string($_POST['repeat_password']);
            $firstname  = $mysqli->real_escape_string($_POST['fname']);
            $lastname   = $mysqli->real_escape_string($_POST['lname']);
            $DOB        = $mysqli->real_escape_string($_POST['DOB']);
            $eMail      = $mysqli->real_escape_string($_POST['eMail']);
            $sex        = $mysqli->real_escape_string($_POST['sex']);
    
            $query = "SELECT * FROM HD_Users WHERE username='$username'";
            $output = mysqli_query($mysqli, $query);
            if (mysqli_num_rows($output) > 0) {
                echo "exists";	
                exit();
            }
            else {
                // Encrypt password
                $pwd = md5($pwd);
                // Insert query to create the user
                $query = "INSERT INTO HD_Users (username, password, fname, lname, DOB, eMail, sex) VALUES ('{$username}', '{$pwd}', '{$firstname}', '{$lastname}', '{$DOB}', '{$eMail}', '{$sex}')";
                $output = mysqli_query($mysqli, $query);
                echo 'Saved!';
                exit();
            }
        }

        ?>

        <style>
            .regHead {
                margin: 15px;
            }
            #datetimepicker1{
                display: none;
            }
            #curr_usr {
                font-size: 1em;
            }
            
        </style>

        <link rel="stylesheet" href="Media/css/jquery.passwordRequirements.css" />
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/css/datepicker.min.css'>   

        <title>Register</title>
	</head>

	<body>
        <?php
            echo $navigation;
        ?>
        <div class="container">
            <div class="row">
		        
            </div>
            <div class="row text-center">
                <h1 class="regHead">Register your account</h1>
                <h4 class="regHead">Get started today!</h4>
            </div>
            <div class="row">
                <div class="col">
                    <form action="register.php" class="form row g-3" name="registration" method="POST">
                        <div class="col-md-4">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="username" class="form-control" name="username" placeholder="Username" autocomplete="off" required />
                            <div id="uname_response" class="mb-3"></div>
                        </div>

                        <div class="col-md-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="pr-password form-control" name="password" placeholder="Password" autocomplete="off" required />
                            
                        </div>
                        

                        <div class="col-md-4">
                            <label for="repeat_password" class="form-label">Repeat Password</label>
                            <input type="password" id="repeat_password" class="form-control" name="repeat_password" placeholder="Repeat Password" autocomplete="off" required />
                        </div>
                        <div id="passwordHelpBlock" class="col-md-12 form-text">
                            Your password must be 8-20 characters long, contain at least 1 uppercase letter, 1 lowercase letter, 1 number and 1 special character. It must also not contain spaces.
                        </div>

                        <div class="col-md-6">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" id="fname" class="form-control" name="fname" placeholder="First Name" autocomplete="off" />
                        </div>

                        <div class="col-md-6">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" id="lname" class="form-control" name="lname" placeholder="Last Name" autocomplete="off" />
                        </div>

                        <div class="col-md-6">
                            <i id="datetimepicker1" class="bi bi-calendar-date input-group-text"></i>
                            <label for="DOB" class="form-label">Date of birth</label>
                            <input type="text" id="datepicker" class="datepicker_input form-control" name="DOB" placeholder="YYYY-MM-DD" required aria-label="Select your date of birth">
                        </div>

                        <div class="col-md-6">
                            <label for="eMail" class="form-label">Email</label>
                            <input type="email" id="eMail" class="form-control" name="eMail" placeholder="Email" autocomplete="off" required />
                            <div id="email_response" class="form-text">
                                Must be a valid email e.g. name@domain.com
                            </div>
                        </div>
                    
                        <div class="row justify-content-md-center">
                            <label for="sex" class="form-label text-center">Select your sex</label>
                            <div class="input-group-text col-md-2">
                                <input type="radio" name="sex" value="M" id="sexM" class="form-check-input mt-0">
                                <label class="form-check-label" for="sexM">
                                    Male
                                </label>
                            </div>
                            <div class="input-group-text col-md-2">
                                <input type="radio" name="sex" value="F" id="sexF" class="form-check-input mt-0">
                                <label class="form-check-label" for="sexF">
                                    Female
                                </label>
                            </div>
                            <div class="input-group-text col-md-2">
                                <input type="radio" name="sex" value="O" id="sexO" class="form-check-input mt-0">
                                <label class="form-check-label" for="sexO">
                                    Other
                                </label>
                                <br>
                            </div>
                        </div>

                        <div class="row g-3-center create_account">
                            <div id="error_msg" class="mb-4">
                        </div>

                        
                        <div class="row justify-content-md-center">
                            <br>
                            <input type="submit" id="reg_btn" class="btn btn-primary col-md-10" name="register_button" value="Create Account" />
                            <div class="row justify-content-md-center">
                                <span id="curr_usr" class="form-text col-md text-center">
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
        
        <!--Required scripts-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src='https://cdn.jsdelivr.net/npm/vanillajs-datepicker@1.1.4/dist/js/datepicker-full.min.js'></script>
        <script src="Media/js/jquery.passwordRequirements.min.js"></script>
        <script src="Media/js/jquery.validate.min.js"></script>
        <script src="Media/js/formValidation.js"></script>

    </body>
</html>