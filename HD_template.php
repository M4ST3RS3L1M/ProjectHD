<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" property="stylesheet" type="text/css"href="Media/css/style.css">
    <meta charset="utf-8">
    <title>Login</title>
</head>
<?php
session_name('Website');
session_start();
$host = "localhost";
$user = "seleri21"; 
$pwd = "C5cCBIatVU"; 
$db = "seleri21_db"; 
$mysqli = new mysqli($host, $user, $pwd, $db);
?>