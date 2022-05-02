<?php
$memberOnly = true;
include ('nav.php'); //Required for db connection.
echo $navigation;
echo $extLinks;

//Below is the query to retrieve information about registered users.

$userInformationQuery = "SELECT * FROM HD_Users";
$result = $mysqli->query($userInformationQuery);

?>
<head>
</head>
<body>

    <!-- The user information table for the admins is created below. -->

    <table class="manageUsers">
        <thead>
        <tr>
            <th id="manageUsersHeadsFirst">Username</th> 
            <th id="manageUsersHeads">Password</th>
            <th id="manageUsersHeads">Firstname</th>
            <th id="manageUsersHeads">Lastname</th> 
            <th id="manageUsersHeads">Date of Birth</th>
            <th id="manageUsersHeads">Email</th> 
            <th id="manageUsersHeads">Sex</th>
            <th id="manageUsersHeadsLast">Edit</th>
        </tr>
        </thead>
        <tbody>
            <tr>

        <!-- For each row of user information, seven columns are created 
           with the corresponding values being echoed as the content. -->

        <?php while($row = mysqli_fetch_assoc($result)):
            ?>       
            <td id="manageUsersBodiesFirst"><?php echo $row['username']; ?></td>
            <td id="manageUsersBodies"><?php echo $row['password']; ?></td>
            <td id="manageUsersBodies"><?php echo $row['fName']; ?></td>
            <td id="manageUsersBodies"><?php echo $row['lName']; ?></td>
            <td id="manageUsersBodies"><?php echo $row['DOB']; ?></td>
            <td id="manageUsersBodies"><?php echo $row['eMail']; ?></td>
            <td id="manageUsersBodies"><?php echo $row['sex']; ?></td>
            <td id="manageUsersBodiesLast">

                <!-- At the end of every row, two links allow the admins to update or remove the user.
                     The userID is sent to the linked php files to ensure that the correct user is being updated or removed. -->

                <a href="updateUsers.php?id=<?php echo $row['userID'] ?>">Update user</a><br>
                <a href="deleteUsers.php?id=<?php echo $row['userID'] ?>" onclick="return confirm('WARNING! All information regarding this user will be removed, including logs and statistics. This cannot be undone. Are you sure?')" style="color: #FF0000;">Remove user</a>
            </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Another link is located below the table, which allow admins to add new users. -->

    <div id="adduserdiv">
        <a id="adduserlink" href="addUser.php">add a new user</a>
    </div>
</body>
      <?php
         include("footer.php")
      ?>
</html>