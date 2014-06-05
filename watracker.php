#!/usr/bin/php
<?php
date_default_timezone_set('Europe/Madrid');
require 'src/php/whatsprot.class.php';

function fgets_u($pStdn)
{
    $pArr = array($pStdn);

    if (false === ($num_changed_streams = stream_select($pArr, $write = NULL, $except = NULL, 0))) {
        print("\$ 001 Socket Error : UNABLE TO WATCH STDIN.\n");

        return FALSE;
    } elseif ($num_changed_streams > 0) {
        return trim(fgets($pStdn, 1024));
    }
    return null;
}

$ls = "";  // Type String. In here it will be the Last Seen String
//We pass this function our username (number with cc), our target (number with cc), msgid (not important at all),
// and it retrieve us the seconds since the last time online. Yeah, i know, i can make function more simple than this...
function onGetRequestLastSeen($username, $from, $msgid, $seconds)
{
	//echo "Received last seen seconds: '$seconds'";
    //$now = time();
    //$lastSeen = $now - $seconds;
   
    $secondsInAMinute = 60;
    $secondsInAnHour  = 60 * $secondsInAMinute;
    $secondsInADay    = 24 * $secondsInAnHour;

    // extract days
    $days = floor($seconds / $secondsInADay);

    // extract hours
    $hourSeconds = $seconds % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);

    // extract minutes
    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);

    // extract the remaining seconds
    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
    $seconds = ceil($remainingSeconds);

    // return the value
    if (($seconds==0) && ($minutes==0) && ($hours==0) && ($days==0))
    	echo "Now online";
    else
    	echo "- Last seen: " . $days . " days " . $hours . " hours " . $minutes . " minutes ago\n";
    	
    	global $ls;
    	$ls = "- Last seen: " . $days . " days " . $hours . " hours " . $minutes . " minutes ago\n";
  
}

$presence;
// We get on $presence a string (online or offline). $type
function onPresenceReceived($username, $from, $type)
{
    global $presence;
    $presence = $type;
    if($type == "available")
    	echo "- The user is online\n\n";
    else
    	echo "- The user is offline\n\n";

}

function secondsToTime($seconds) {
    $dtF = new DateTime("@0");
    $dtT = new DateTime("@$seconds");
    return $dtF->diff($dtT)->format('Last seen: %a days, %h hours, %i minutes and %s seconds ago');
}


$nickname = "WhatsApp Tracker";
// #### DO NOT ADD YOUR INFO AND THEN COMMIT THIS FILE! ####
$sender = 	""; // Number of the bot with country code
$imei = 	""; // Not used
$password =     ""; // Password you received from WhatsApp

if ($argc < 2) {
	echo "====================================================\n";
	echo "               WhatsApp Tracker v0.1                \n";
	echo "====================================================\n\n";
    echo "USAGE: php ".$_SERVER['argv'][0]." [-check <targetPhone>] [-cHidden <targetPhone>]\n [-cRemote0 <myPhone> <targetPhone>] [-cRemote1 <myPhone> <targetPhone>]\n";
    exit(1);
}

$dst=$_SERVER['argv'][2];

echo "====================================================\n";
echo "               WhatsApp tracker v0.1                \n";
echo "====================================================\n\n";
echo "[*] Logging in as '$nickname' ($sender)\n";
$wa = new WhatsProt($sender, $imei, $nickname, FALSE);

$wa->connect();
$wa->loginWithPassword($password);
$wa->eventManager()->bind('onGetRequestLastSeen', 'onGetRequestLastSeen');
$wa->eventManager()->bind("onPresence", "onPresenceReceived");


if (($_SERVER['argv'][1] == "-cRemote0") || ($_SERVER['argv'][1] == "-check")) {
	echo "\n[-] Tracker mode (ON):\n";
	    while (TRUE) {
	    	if($_SERVER['argv'][1] == "-check")
				$wa->sendGetRequestLastSeen($dst);
			else{
				$wa->sendGetRequestLastSeen($_SERVER['argv'][3]);
				$wa->sendMessage($dst, "(".$_SERVER['argv'][3].") ".$ls);
				}
    		sleep(60);
		}

}


if (($_SERVER['argv'][1] == "-cHidden") ||($_SERVER['argv'][1] == "-cRemote1")) {
	echo "\n[-] Tracker mode (ON): Waiting the user to get online...\n";
	$wa->SendPresenceSubscription($dst);
	$wa->PollMessages();
	
	if($presence == "available")
		echo "- The user is now online\n\n";
	else
		echo "- The user is offline\n\n";
		
	while(true){
		$wa->PollMessages();
		if(($lastpresence == "available") && ($presence == "unavailable")){
	
			$timeOffline = date("Y-m-d H:i:s");	
			while($presence == "unavailable"){
				$timeDiff = round(strtotime(date("Y-m-d H:i:s")) - strtotime($timeOffline));
				echo secondsToTime($timeDiff);
				if($_SERVER['argv'][1] == "-cRemote1")
					$wa->sendMessage($dst, "(".$_SERVER['argv'][3].") ".secondsToTime($timeDiff));
				$wa->PollMessages();
				sleep(5);
			}
	
		}
	$lastpresence = $presence;
	sleep(5);
	}
	
}