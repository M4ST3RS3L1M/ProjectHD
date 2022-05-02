<?php
$memberOnly = true;
include('nav.php'); //Required for db connection.

//Query to delete the selected user from the db.

if (isset($_GET['id']) and isset($_SESSION['userID'])) {
 $deleteUserQuery = "DELETE FROM HD_Users WHERE userID = '{$_GET['id']}'";
 $mysqli->query($deleteUserQuery);
 header('Location:manageUsers.php');
}

?>
</html>