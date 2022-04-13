<?php

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

$ip = $mysqli->real_escape_string($_SERVER['REMOTE_ADDR']);
$page = $mysqli->real_escape_string(basename($_SERVER["SCRIPT_NAME"]));
date_default_timezone_set("Europe/Stockholm");
$time = $mysqli->real_escape_string(date("Y-m-d H:i:s",time()));
$browser = $mysqli->real_escape_string(getBrowserName($_SERVER["HTTP_USER_AGENT"]));

$stmt = "INSERT INTO HD_WebAnalytics(browserID,pageID,IP_Address,timestamp)
VALUES ((SELECT browserID FROM HD_Browser WHERE browserName = '$browser'),
(SELECT pageID FROM HD_PageIndex WHERE pageTitle = '$page'),'$ip','$time');";

$result = $mysqli->query($stmt);
$lastID = $mysqli->insert_id;

if (isset($_SESSION['userID'])) {
 $stmt2 = "INSERT INTO HD_UserRequest(userID,requestID)
 VALUES ((SELECT userID FROM HD_Users WHERE userID = '{$_SESSION['userID']}'), 
 (SELECT requestID FROM HD_WebAnalytics WHERE requestID = '$lastID'));";
 $mysqli->query($stmt2);
}

?>