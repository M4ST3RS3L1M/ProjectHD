<?php
$memberOnly = true;
include ('nav.php'); //Required for db connection.
echo $navigation;
echo $extLinks;

//Query to see if the selected user is an admin.

if (isset($_SESSION['userID'])) {
    $checkadmin = ("SELECT userID 
            FROM HD_Admins
            WHERE userID = '{$_GET['id']}'");

    $result= $mysqli->query($checkadmin);
    $rowcount=mysqli_num_rows($result);
}

//If the form is submited, the new values are stored in variables, to be inserted into the db.

if (isset($_GET['id']) AND (isset($_POST['submit']))) {
 
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = $mysqli->real_escape_string($_POST['password']);
    $fName = $mysqli->real_escape_string($_POST['fName']);
    $lName = $mysqli->real_escape_string($_POST['lName']);
    $DOB = $mysqli->real_escape_string($_POST['DOB']);
    $eMail = $mysqli->real_escape_string($_POST['eMail']);
    $sex = $mysqli->real_escape_string($_POST['sex']);

    //Query to update the user with the information from the form.
    if ($_POST['password'] == "") {
        $stmt = "UPDATE HD_Users 
                SET username = '$username',
                fName = '$fName',
                lName = '$lName',
                DOB = '$DOB',
                eMail = '$eMail', 
                sex = '$sex'
                WHERE userID = '{$_GET['id']}';";
    }
    else {
    $md5pwd = md5($password);
    $stmt = "UPDATE HD_Users 
            SET username = '$username', 
            password = '$md5pwd', 
            fName = '$fName',
            lName = '$lName',
            DOB = '$DOB',
            eMail = '$eMail', 
            sex = '$sex'
            WHERE userID = '{$_GET['id']}';";
    }

    // If the checkbox switch to give the user admin privileges is checked, insert the users ID into the admin table.
    // Ignore the insert if the user already is an admin.

    if (isset($_POST['makeadmin'])) {
        $makeadmin = "INSERT IGNORE INTO HD_Admins(userID)
                  VALUES ((SELECT userID FROM HD_Users WHERE userID = '{$_GET['id']}'))";
        $mysqli->query($makeadmin);
    }

    // If the checkbox switch is not checked, delete the users ID from the admin table.

    if (!isset($_POST['makeadmin'])) {
        $removeadmin = "DELETE FROM HD_Admins WHERE userID = '{$_GET['id']}'";
        $mysqli->query($removeadmin);
    }

    $mysqli->query($stmt);
    header('Location:manageUsers.php');
 
}

//Query to retrieve the selected users information.

$userInformationQuery = "SELECT * FROM HD_Users WHERE userID = '{$_GET['id']}'";
$result = $mysqli->query($userInformationQuery);

//The results of the query are put into seven different variables, which will be echoed in the form as default values.

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

    <!-- The update users form is created below. -->

    <form class="updateUsersForm" method="post" name="updateUser" action="updateUsers.php?id=<?php echo $_GET['id']; ?>">
        
        <div class="row">
            <div class="col">
                <label for="username">Username:</label>
                <input class="form-control" id="username" type="text" name="username" value="<?php echo $username; ?>"><br>
                <div id="uname_response" class="mb-3"></div>
            </div>
            <div class="col">
                <label for="password">Password:</label>
                <input class="form-control" id="password" type="password" name="password"><br>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="fName">Firstname:</label>
                <input class="form-control" id="fname" type="text" name="fName" value="<?php echo $fName; ?>"><br>
            </div>
            <div class="col">
            <label for="lName">Lastname:</label>
            <input class="form-control" id="lname" type="text" name="lName" value="<?php echo $lName; ?>"><br>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label>Date of birth:</label>
                <input class="form-control" id="DOB" type="text" name="DOB" value="<?php echo $DOB; ?>"><br>
            </div>
            <div class="col-6">
                <label>Email address:</label>
                <input class="form-control" id="eMail" type="text" name="eMail" value="<?php echo $eMail; ?>"><br>
                <div id="email_response" class="form-text"></div>
            </div>
            <div class="col">
                <label>Sex:</label>
                <input class="form-control" id="sex" type="text" name="sex" value="<?php echo $sex; ?>"><br>
            </div>
        </div>

        <!-- Use the checkadmin query to notify the admin if the selected user is an admin or not. -->
        <p id="userisadmin"><?php if ($rowcount != 0) { echo 'this user is an admin'; } else { echo 'this user is not an admin'; }?></p>
        <div class="row">
            <div style="display: flex; justify-content: center;" class="form-check form-switch">

                <!-- Checkbox switch to add or remove admins. -->
                <input class="form-check-input" type="checkbox" role="switch" name="makeadmin" id="makeadmin" <?php if ($rowcount != 0) { echo 'checked'; } ?>>
                <label style="padding-top: 0px;" class="form-check-label" for="makeadmin">
                Admin privileges
                </label>
            </div>
        </div>
        <div id="error_msg" class="col-md-auto"></div>
        <input id="update_btn" style="margin: 25px 0px 0px;" class="btn btn-primary btn-block" type="submit" name="submit" onclick="return confirm('Are you sure you want to make these changes?')" value="Save changes">
    </form>

    <!--Required scripts-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="Media/js/jquery.validate.min.js"></script>
    <script src="Media/js/updateFormValidation.js"></script>


</body>

    <?php
        include("footer.php")
    ?>

</html>