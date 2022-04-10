<!DOCTYPE html>
<html lang="en">

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        
        <link rel="stylesheet" href="https://mdbootstrap.com/snippets/styles.e41eb5076eefabc7c908.css">
        <link rel="stylesheet" href="Media/css/style.css">
        <meta charset="utf-8">
        <title>Stay Fit</title>
    </head>

    <body>

<?php
session_name('Website');
session_start();
$host       = "localhost";
$user       = "seleri21";
$pwd        = "C5cCBIatVU";
$db         = "seleri21_db";
$mysqli = new mysqli($host, $user, $pwd, $db);

$navigation = <<<END
    
    <nav class="navbar navbar-expand-lg bg-light navbar-light">
        <div class="container">
            <a class="logga" href="#">
            <img id="logo" src="/~seleri21/ProjectHD/Media/images/brandstayfit.png" alt="Logo" draggable="false" height="30">
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <i class="fas fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto align-items-center">

                    <li class="nav-item">
                        <a class="nav-link mx-2" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link mx-2" href="about.php">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link mx-2" href="faq.php">FAQ</a>
                    </li>





END;
    if (!isset($_SESSION['userID'])) {
        $navigation .= <<<END

        <li class="nav-item ms-3">
            <a class="btn btn-black btn-rounded" href="login.php">Sign in</a>
        </li>
        
        <li class="nav-item ms-3">
            <a class="btn btn-black btn-rounded" href="register.php">Sign up</a>
        </li>
END;
    }
    elseif (isset($_SESSION['userID'])) {
        $navigation .= <<<END

        
        <li class="nav-item">
            <a class="nav-link mx-2" href="addExercise.php">Add exercise</a>
        </li>
      
        <li class="nav-item ms-3">
            <a class="btn btn-black btn-rounded" href="logout.php">Log out</a>
        </li>
        
END;
    }
    $navigation .='</ul>';
    $navigation .='</div>';
    $navigation .='</div>';
    $navigation .='</nav>';
    
?>
