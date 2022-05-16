
<!--Simple logout. when clicked redirects to the home page.-->

<?php
$memberOnly = true;
include('nav.php');
$_SESSION = array();
session_destroy();
header("Location:index.php");
?>