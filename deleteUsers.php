<?php
include('nav.php');

if (isset($_GET['id']) and isset($_SESSION['userID'])) {
 $stmt = "DELETE FROM HD_Users WHERE userID = '{$_GET['id']}'";
 $mysqli->query($stmt);
 header('Location:manageUsers.php');
}

?>
</html>