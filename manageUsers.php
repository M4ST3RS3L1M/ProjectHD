<?php
$memberOnly = true;
include ('nav.php');
echo $navigation;
echo $extLinks;

$sql = "SELECT * FROM HD_Users";
$result = $mysqli->query($sql);

?>
<head>
</head>
<body>
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
                <a href="updateUsers.php?id=<?php echo $row['userID'] ?>">Update user</a><br>
                <a href="deleteUsers.php?id=<?php echo $row['userID'] ?>" onclick="return confirm('WARNING! All information regarding this user will be removed, including logs and statistics. This cannot be undone. Are you sure?')" style="color: #FF0000;">Remove user</a>
            </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <div id="adduserdiv">
        <a id="adduserlink" href="addUser.php">add a new user</a>
    </div>
</body>
      <?php
         include("footer.php")
      ?>
</html>