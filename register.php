<!DOCTYPE html>
<html lang="en">
	<head>

        <?php
        require_once('nav.php'); // Needed for db connection

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Check to see if user is already logged in
        if (isset($_SESSION['username']) && isset($_SESSION['userid'])) {
            header("Location: ./index.php");
        }

        // Get data from form whne register button is clicked
        if (isset($_POST['register_button'])) {
            $name       = $mysqli->real_escape_string($_POST['username']);
            $pwd        = $mysqli->real_escape_string($_POST['password']);
            $repeat_pwd = $mysqli->real_escape_string($_POST['repeat_password']);  // DEN FÅR SITT VÄRDE HÄR SÅ ÄR DECLARED
            $firstname  = $mysqli->real_escape_string($_POST['fname']);
            $lastname   = $mysqli->real_escape_string($_POST['lname']);
            $DOB        = $mysqli->real_escape_string($_POST['DOB']);
            $eMail      = $mysqli->real_escape_string($_POST['eMail']);
            $sex        = $mysqli->real_escape_string($_POST['sex']);
            
            // Verify entered data
            if ($name != "" && $pwd != "" && $repeat_pwd != "" && $eMail != "") {
                // Check that entered passwords match
                if (true) { //($pwd === $repeat_pwd) {  // NÅGOT STÄMMER INTE HÄR | STÅR UNDEFINED VARIABLE PÅ REPEAT_PWD MEN VISAR VÄRDET I DEN
                    // Check that pwd meets min req
                    if (strlen($pwd) >= 5 && strpbrk($pwd, "!#$.,:;()") != false) {
                        // Check if username is taken
                        $query = mysqli_query($mysqli, "SELECT * FROM users WHERE username='{$name}'");
                        if (mysqli_num_rows($query) == 1) {
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
        }
        ?>

        <title>Register</title>
        <meta charset="utf-8">
	</head>

	<body>
		
        <?php
        echo $navigation;
        ?>

        <h1>Register an account</h1>

        <form action="register.php" class="form" method="POST">
            <h1>Create account</h1>

            <div class="">
                <?php
                    if (isset($success) && $success == true) {
                        echo '<p color="green">Your account has been created. <a href="./login.php">Click here</a> to login!</p>';
                    }
                    else if (isset($error_msg)) {
                        echo '<p color="red">'.$error_msg.'</p>';
                    }
                    else {
                        echo ''; // do nothing
                    }
                ?>
            </div>

            <div class="">
                <input type="text" name="username" placeholder="Username" autocomplete="off" required />
            </div>
            <div class="">
                <input type="password" name="password" placeholder="Password" autocomplete="off" required />
            </div>
            <div class="">
                <p>password must be at least 5 characters and<br /> have a special character, e.g. !#$.,:;()</font>
            </div>
            <div class="">
                <input type="password" name="repeat_password" placeholder="Repeat Password" autocomplete="off" required />
            </div>
            <div class="">
                <input type="text" name="fname" placeholder="First Name" autocomplete="off" />
            </div>
            <div class="">
                <input type="text" name="lname" placeholder="Last Name" autocomplete="off" />
            </div>
            <div class="">
                <input type="text" name="DOB" placeholder="Date of Birth" autocomplete="off" />
            </div>
            <div class="">
                <input type="text" name="eMail" placeholder="eMail" autocomplete="off" required />
            </div>
            <div class="">
                <input type="text" name="sex" placeholder="Sex" autocomplete="off" />
            </div>

            <div class="">
                <input class="" type="submit" name="register_button" value="Create Account" />
            </div>

            <p class="center"><br />
                Already have an account? <a href="login.php">Login here</a>
            </p>
        </form>    
        
    </body>
</html>