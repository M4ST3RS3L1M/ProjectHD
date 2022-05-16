<?php

$extLinks = <<<END

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Stay Fit</title>
        
        <!--CSS-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/dist/mdb5/standard/core.min.css">
        <link rel="stylesheet" type="text/css" href="Media/css/style.css">
        
        <!--JS-->
        <script src="https://getbootstrap.com/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/docsearch.js@2/dist/cdn/docsearch.min.js"></script>
        <script src="https://getbootstrap.com//docs/5.1/assets/js/docs.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

END;


// DB Connection
session_name('Website');
session_start();
$host       = "localhost";
$user       = "seleri21";
$pwd        = "C5cCBIatVU";
$db         = "seleri21_db";
$mysqli = new mysqli($host, $user, $pwd, $db);

if (isset($_SESSION['userID'])) {
        $stmt = ("SELECT u.userID 
                FROM HD_Users u
                INNER JOIN HD_Admins a ON a.userID = u.userID
                WHERE u.userID = '{$_SESSION['userID']}'");

        $result= $mysqli->query($stmt);
        $rowcount=mysqli_num_rows($result);
}

// Redirect user to index if not logged in and trying to access pages which require an account
if (isset($memberOnly)) {
    if (!isset($_SESSION['userID'])) {
      header('Location: index.php');
      exit;
    }
}

// Creates navbar for all pages
$navigation = <<<END
    
    <nav class="navbar navbar-expand-lg bg-light navbar-light">
        <div class="container">
            <a class="logga" href="index.php">
            <img id="logo" src="Media/images/brandstayfit.png" alt="Logo" draggable="false" height="30">
            </a>

            <button
                class="navbar-toggler collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>
            </button>

            

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto align-items-center">

                    
END;

// Adds login and register buttons if user isn't logged in
    if (!isset($_SESSION['userID'])) {
        $navigation .= <<<END

        <li class="nav-item">
        <a class="nav-link mx-2" href="index.php">Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link mx-2" href="about.php">About</a>
        </li>

        <li class="nav-item">
            <a class="nav-link mx-2" href="faq.php">FAQ</a>
        </li>

        <li class="nav-item ms-3">
            <a class="btn btn-black btn-rounded" href="login.php">Sign in</a>
        </li>
        
        <li class="nav-item ms-3">
            <a class="btn btn-black btn-rounded" href="register.php">Register</a>
        </li>
END;
    }

// Navbar items for user who is logged in and admin
    elseif (isset($_SESSION['userID']) AND ($rowcount != 0)) {
    $navigation .= <<<END
    
    <li class="nav-item">
        <a class="nav-link mx-2" href="healthDashboard.php">Health Dashboard</a>
    </li>

    <li class="nav-item">
    <a class="nav-link mx-2" href="addExercise.php#top">Exercise & Health</a>
    </li>

    <li class="nav-item">
        <a class="nav-link mx-2" href="adminAnalytics.php">Analytics</a>
    </li>

    <li class="nav-item">
        <a class="nav-link mx-2" href="manageUsers.php">Manage Users</a>
    </li>

    <li class="nav-item">
    <a class="nav-link mx-2" href="about.php">About</a>
    </li>

    <li class="nav-item">
        <a class="nav-link mx-2" href="faq.php">FAQ</a>
    </li>

    <li class="nav-item ms-3">
        <a class="btn btn-black btn-rounded" href="logout.php">Log out</a>
    </li>
    
END;
    }

// Navbar items for regular user who is logged in
    elseif (isset($_SESSION['userID'])) {
        $navigation .= <<<END

        <li class="nav-item">
            <a class="nav-link mx-2" href="healthDashboard.php">Health Dashboard</a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link mx-2" href="addExercise.php">Add exercise</a>
        </li>

        <li class="nav-item">
            <a class="nav-link mx-2" href="about.php">About</a>
        </li>

        <li class="nav-item">
            <a class="nav-link mx-2" href="faq.php">FAQ</a>
        </li>
      
        <li class="nav-item ms-3">
            <a class="btn btn-black btn-rounded" href="logout.php">Log out</a>
        </li>
        
END;
    }

// Closing tags
    $navigation .='</ul>';
    $navigation .='</div>';
    $navigation .='</div>';
    $navigation .='</nav>';
include_once ('log.php');        
?>