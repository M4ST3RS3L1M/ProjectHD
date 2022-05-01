<?php
include ('nav.php');
echo $navigation;
echo $extLinks;

if (isset($_SESSION['userID'])) {
    $checkadmin = ("SELECT userID 
            FROM HD_Admins
            WHERE userID = '{$_GET['id']}'");

    $result= $mysqli->query($checkadmin);
    $rowcount=mysqli_num_rows($result);
}

if (isset($_GET['id']) AND (isset($_POST['submit']))) {
 
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string($_POST['password']);
    $fName = $mysqli->real_escape_string($_POST['fName']);
    $lName = $mysqli->real_escape_string($_POST['lName']);
    $DOB = $mysqli->real_escape_string($_POST['DOB']);
    $eMail = $mysqli->real_escape_string($_POST['eMail']);
    $sex = $mysqli->real_escape_string($_POST['sex']);

    $stmt = "UPDATE HD_Users 
            SET username = '$username', 
            password = '$password', 
            fName = '$fName',
            lName = '$lName',
            DOB = '$DOB',
            eMail = '$eMail', 
            sex = '$sex'
            WHERE userID = '{$_GET['id']}';";

    if (isset($_POST['makeadmin'])) {
        $makeadmin = "INSERT INTO HD_Admins(userID)
                  VALUES ((SELECT userID FROM HD_Users WHERE userID = '{$_GET['id']}'))";
        $mysqli->query($makeadmin);
    }

    if (isset($_POST['removeadmin'])) {
        $removeadmin = "DELETE FROM HD_Admins WHERE userID = '{$_GET['id']}'";
        $mysqli->query($removeadmin);
    }

    $mysqli->query($stmt);
    header('Location:manageUsers.php');
 
}

$stmt = "SELECT * FROM HD_Users WHERE userID = '{$_GET['id']}'";
$result = $mysqli->query($stmt);

while($row = mysqli_fetch_assoc($result)) {
    $username = $row["username"];
    $password = $row["password"];
    $fName = $row["fName"];
    $lName = $row["lName"];
    $DOB = $row["DOB"];
    $eMail = $row["eMail"];
    $sex = $row["sex"];
  }
?>

<head>


</head>

<body>
    <h1 id="updateuserH1">update user: <?php echo strtolower($username); ?></h1>
    <form class="updateUsersForm" method="post" action="updateUsers.php?id=<?php echo $_GET['id']; ?>">
        
        <div class="row">
            <div class="col">
                <label for="username">Username:</label>
                <input class="form-control" type="text" name="username" value="<?php echo $username; ?>"><br>
            </div>
            <div class="col">
                <label for="password">Password:</label>
                <input class="form-control" type="text" name="password" value="<?php echo $password; ?>"><br>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="fName">Firstname:</label>
                <input class="form-control" type="text" name="fName" value="<?php echo $fName; ?>"><br>
            </div>
            <div class="col">
            <label for="lName">Lastname:</label>
            <input class="form-control" type="text" name="lName" value="<?php echo $lName; ?>"><br>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label>Date of birth:</label>
                <input class="form-control" type="text" name="DOB" value="<?php echo $DOB; ?>"><br>
            </div>
            <div class="col-6">
                <label>Email address:</label>
                <input class="form-control" type="text" name="eMail" value="<?php echo $eMail; ?>"><br>
            </div>
            <div class="col">
                <label>Sex:</label>
                <input class="form-control" type="text" name="sex" value="<?php echo $sex; ?>"><br>
            </div>
        </div>
        <p id="userisadmin"><?php if ($rowcount != 0) { echo 'this user is an admin'; } else { echo 'this user is not an admin'; }?></p>
        <div class="row">
            <div style="padding-right: 0px;" class="col-md-6">
                <input class="form-check-input" type="checkbox" name="makeadmin" id="makeadmin" <?php if ($rowcount != 0) { echo 'disabled'; } ?>>
                <label style="padding-top: 0px;" class="form-check-label" for="makeadmin">
                Give admin privileges to this user
                </label>
            </div>
            <div style="padding-left: 0px;" class="col-md-6">
                <input class="form-check-input" type="checkbox" name="removeadmin" id="removeadmin" <?php if ($rowcount == 0) { echo 'disabled'; } ?>>
                <label style="padding-top: 0px;" class="form-check-label" for="removeadmin">
                Remove admin privileges for this user
                </label>
            </div>
        </div>

        <input style="margin: 25px 0px 0px;" class="btn btn-primary btn-block" type="submit" name="submit" onclick="return confirm('Are you sure you want to make these changes?')" value="Save changes">
    </form>
</body>
    <?php
        include("footer.php")
    ?>

</html>