<!DOCTYPE html>
<html lang="en">
	<head>

        <?php
        include('nav.php');
        echo $extLinks;

        if (isset($_POST['username']) and isset($_POST['password'])) {

            $username  = $mysqli->real_escape_string($_POST['username']);
            $pwd       = $mysqli->real_escape_string($_POST['password']);
            $pwd       = substr(md5($pwd), 0, 24);

            $query = "SELECT username, password, userID FROM HD_Users WHERE username='$username' AND password='$pwd'";
            $result = mysqli_query($mysqli, $query);

            if (mysqli_num_rows($result) > 0) {
                $obj                   = mysqli_fetch_object($result);
                $_SESSION["username"]  = $obj->username;
                $_SESSION["userID"]    = $obj->userID;
                echo "cred--match";
            }
            else {
                echo 0;
            }
        }
        
        ?>

        <style>
            #card-div {
                border-radius: 1rem;
            }
        </style>

        <title>Log in</title>

    </head>

    <body>

    <?php
        echo $navigation;
    ?>
    
    <!--<form action="login.php" method="post" id="main">
        <h1 id="login_h1">BrandName</h1>
        <div class="login_p">
            <p>Login to start your journey!</p>
        </div>
        <div class="loginbox">
            <label id="login_label" for="username">Enter your username</label>
            <input id="login_input" type="text" name="username" placeholder="username">
            <label id="login_label" for="password">Enter your password</label>
            <input id="login_input" type="password" name="password" placeholder="password">
            <button id="login_button" type="submit">Login</button>
            <div class="login_register_link">
                <a href="register.php">Dont have an account yet? Sign up</a>
            </div>
        </div>
    </form>-->

        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center py-5 h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div id="card-div" class="card bg-dark text-white">
                            <div class="card-body p-5 text-center">
                                <div class="mb-md-1 mt-md-1">
                                    
                                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                    <p class="text-white-50 mb-2">Please enter your username and password to start your journey!</p>
                    
                                    <form action="login.php" method="post" name="login" id="main">  
                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label text-white" for="username">Username</label>
                                            <input id="loginName" type="text" name="username" class="form-control form-control-lg">
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label text-white" for="typePasswordX">Password</label>
                                            <input id="typePasswordX" type="password" name="password" class="form-control form-control-lg">
                                        </div>
                                        <div id="error_msg" class="mb-4"></div>
                                        <button id="login_btn" class="btn btn-outline-light px-5" type="button">Login</button>
                                    </form>
                                </div>

                                <div>
                                    <p class="mb-0">Don't have an account yet? <a href="register.php" class="text-white-50 fw-bold">Sign Up!</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        include("footer.php")
        ?>

        <!--Required scripts-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="Media/js/jquery.validate.min.js"></script>
        <script src="Media/js/login.js"></script>

    </body>
</html>