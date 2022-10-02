<?php

	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/functions.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	require_once($page["rootPath"] . "scripts/php/connection.php");
	
	
	isset($_GET["id"]) or die(relocate("../"));
	
	$notificationId = $_GET["id"];
	
	$accountDetails = accountDetails($user["account"]["usercode"]);
	
	$notificationDetails = notificationDetails($notificationId);
	
	
     $sql = "UPDATE notifications SET viewed = 'true' WHERE notification_id = '$notificationId' ";
     			
     if(mysqli_query($conn, $sql)) {
     
     	relocate($page["rootPath"] . $notificationDetails["link"]);
     
     }
     		
	
?>