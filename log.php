<?php
$memberOnly = true;

//Function to retrieve the connected users browser information.

function getBrowserName($userAgent) {
    if(strpos($userAgent, "Opera") || strpos($userAgent, "OPR/"))
    {
        return "Opera";
    }
    elseif(strpos($userAgent, "MSIE") || strpos($userAgent, "Trident/7"))
    {
        return "Internet Explorer";
    }
    elseif(strpos($userAgent, "Edge") || strpos($userAgent, "Edg/"))
    {
        return "Microsoft Edge";
    }
    elseif(strpos($userAgent, "Chrome") || strpos($userAgent, "CriOS/"))
    {
        return "Chrome";
    }
    elseif(strpos($userAgent, "Safari"))
    {
        return "Safari";
    }
    elseif(strpos($userAgent, "Firefox"))
    {
        return "Firefox";
    }
    else
    {
        return "Other";
    }
}   

// Use the $_SERVER global variable to retrieve the users IP address, 
// the current page, the current time and the browser used. 

$ip = $mysqli->real_escape_string($_SERVER['REMOTE_ADDR']);
$page = $mysqli->real_escape_string(basename($_SERVER["SCRIPT_NAME"]));
date_default_timezone_set("Europe/Stockholm");
$time = $mysqli->real_escape_string(date("Y-m-d H:i:s",time()));
$browser = $mysqli->real_escape_string(getBrowserName($_SERVER["HTTP_USER_AGENT"]));

//Query to insert the information gathered above into the db.

$logQuery = "INSERT INTO HD_WebAnalytics(browserID,pageID,IP_Address,timestamp)
VALUES ((SELECT browserID FROM HD_Browser WHERE browserName = '$browser'),
(SELECT pageID FROM HD_PageIndex WHERE pageTitle = '$page'),'$ip','$time');";

$result = $mysqli->query($logQuery);

//Get the last inserted requestID.

$lastID = $mysqli->insert_id;

//If the user is logged in to the website, insert the userID and the last requestID into the User Request table. 

if (isset($_SESSION['userID'])) {
 $stmt2 = "INSERT INTO HD_UserRequest(userID,requestID)
 VALUES ((SELECT userID FROM HD_Users WHERE userID = '{$_SESSION['userID']}'), 
 (SELECT requestID FROM HD_WebAnalytics WHERE requestID = '$lastID'));";
 $mysqli->query($stmt2);
}

?>