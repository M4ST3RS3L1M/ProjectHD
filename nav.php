
<link rel="stylesheet" property="stylesheet" type="text/css"href="Media/css/style.css?4">

<?php
session_name('Website');
session_start();
$host       = "localhost";
$user       = "seleri21"; // e.g. evanil18
$pwd        = "C5cCBIatVU"; // e.g takeAbath@06h30
$db         = "seleri21_db";
$mysqli = new mysqli($host, $user, $pwd, $db);
$navigation = <<<END
    <div class="topnav">

    <div class="logo">
    <img src="Media/images/cricket-meme-0aa7.jpg" alt="">
    </div>

    <div class="companyname">
    <h3>Company name</h3>
    </div>


    <nav class="navigation">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="faq.php">FAQ</a>
        <div class="login">

END;
    if (!isset($_SESSION['userId'])) {
        $navigation .= <<<END
        
        <a href="register.php">Register</a>
        <a href="login.php">Log in</a>
        

END;
    }


    elseif (isset($_SESSION['userId'])) {
        $navigation .= <<<END
        <div class="loggedinas"> 
        <p >Logged in as {$_SESSION['username']}</p>
        </div> 
        <a href="logout.php">Logout</a> 
        </div>
        
END;
    }

    $navigation .='</nav>';
    $navigation .='</div>';
?>
