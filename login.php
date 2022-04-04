
<?php
include('nav.php');
echo $navigation;
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
        $_SESSION["username"]  = $row->username;
        $_SESSION["userID"]    = $row->userID;
        header("Location:index.php");
    } else {
        echo "Wrong username or password. Try again";
    }
}

$content = <<<END
<body id="login_body">
<form action="login.php" method="post" id="main">
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
</form>
</body>
END;
echo $content;

?>



</html>