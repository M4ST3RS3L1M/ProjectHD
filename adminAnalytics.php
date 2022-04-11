<?php
/*var_dump($_SERVER);*/
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

$ip = $_SERVER["REMOTE_ADDR"];
$page = basename($_SERVER["SCRIPT_NAME"]);
date_default_timezone_set("Europe/Stockholm");
$time = date("Y-m-d H:i:s",time()); 

echo $ip;
echo "<br>";
echo $page;
echo "<br>";
echo $time;
echo "<br>";
echo getBrowserName($_SERVER["HTTP_USER_AGENT"]);

?>