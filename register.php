<?php

include('nav.php');

if (isset($_POST['username']) and isset($_POST['password'])) {
    $name       = $mysqli->real_escape_string($_POST['username']);
    $pwd        = $mysqli->real_escape_string($_POST['password']);
    $firstname  = $mysqli->real_escape_string($_POST['fname']);
    $lastname   = $mysqli->real_escape_string($_POST['lname']);
    $DOB        = $mysqli->real_escape_string($_POST['DOB']);
    $eMail      = $mysqli->real_escape_string($_POST['eMail']);
    $sex        = $mysqli->real_escape_string($_POST['sex']);
    
    $query = <<<END
    INSERT INTO HD_Users (username, password, fname, lname, DOB, eMail, sex)
        VALUES ('{$_POST['username']}', '{$_POST['password']}', '{$_POST['fname']}', '{$_POST['lname']}', '{$_POST['DOB']}', '{$_POST['eMail']}', '{$_POST['sex']}')

END;
    
    if ($mysqli-> query($query) !== TRUE) {
        die("Could not query database" . $mysqli->errno . " : " . $mysqli->error);
        header('Location:index.php');
    }
}

echo $navigation;

?>

<html>
	<head>
        
        <title>Register</title>
        <meta charset="utf-8">
	</head>

	<body>
		<h1>Register an account</h1>
		
        <!--nav and shit-->

        <?php
            if (isset($success) && $success == true) {
                echo 'Your account has been created. <a href="login.php">Click here</a> to login';
            }
            //dubbelt???
        ?>
        
        <form action="register.php" class="form" method="POST">
            <h1>Create account</h1>

            <div class="">
                <?php
                    if (isset($success) && $success == true) {
                        echo '<p>Your account has been created. <a href="./login.php">Click here</a> to login!</p>';
                    }
                    else if (isset($error_msg)) {
                        echo '<p>'.$error_msg.'</p>';
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
                <input type="text" name="fname" placeholder="First Name" autocomplete="off" required />
            </div>
            <div class="">
                <input type="text" name="lname" placeholder="Last Name" autocomplete="off" required />
            </div>
            <div class="">
                <input type="text" name="DOB" placeholder="Date of Birth" autocomplete="off" required />
            </div>
            <div class="">
                <input type="text" name="eMail" placeholder="eMail" autocomplete="off" required />
            </div>
            <div class="">
                <input type="text" name="sex" placeholder="Sex" autocomplete="off" required />
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