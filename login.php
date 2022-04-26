<!DOCTYPE html>
<html lang="en">
	<head>

        <?php
        include('nav.php');
        echo $extLinks;
        ?>

    </head>

    <body>

        <?php
        echo $navigation;
        ?>

        <?php
        if (isset($_POST['username']) and isset($_POST['password'])) {
            $name  =    $mysqli->real_escape_string($_POST['username']);
            $pwd   =     $mysqli->real_escape_string($_POST['password']);
            $query = <<<END
            SELECT username, password, userID FROM HD_Users
            WHERE username = '{$name}'
            AND password = '{$pwd}'
END;
            $result = $mysqli->query($query);
            if ($result->num_rows > 0) {
                $row                   = $result->fetch_object();
                $_SESSION['username']  = $row->username;
                $_SESSION['userID']    = $row->userID;
                header("Location:index.php");
            } else {
                echo "Wrong username or password. Try again";
            }
        }
        ?>

        <section class="vh-100">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center py-5 h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">

                                <div class="mb-md-1 mt-md-1">

                                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                    <p class="text-white-50 mb-2">Please enter your username and password to start your journey!</p>
                    
                                    <form action="login.php" method="post" id="main">  
                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label text-white" for="username">Username</label>
                                            <input id="loginName" type="text" name="username" class="form-control form-control-lg">
                        
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label text-white" for="typePasswordX">Password</label>
                                            <input id="typePasswordX" type="password" name="password" class="form-control form-control-lg">
                        
                                        </div>


                                        <button class="btn btn-outline-light px-5" type="submit">Login</button>
                                    </form>
                                </div>

                                <div>
                                    <p class="mb-0">Don't have an account yet? <a href="register.php" class="text-white-50 fw-bold">Sign Up</a>
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
    </body>
</html>