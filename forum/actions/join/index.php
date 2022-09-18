<?php

	$page = array("rootPath" => "../../../", "restriction" => array("account"));
	
	include_once($page["rootPath"] . "scripts/php/connection.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	include_once($page["rootPath"] . "scripts/php/functions.php");
	
	
	$forumId = mysqli_real_escape_string($conn, $_GET["id"]);
	
	$usercode = mysqli_real_escape_string($conn, $user["account"]["usercode"]);
	
	
	$date = date("Y m d");
	
	$time = date("h:i");
		
		
	$sql = "INSERT INTO forum_members (forum_id, member_usercode, admin, date_joined, time_joined) VALUES ('$forumId', '$usercode', 'false', '$date', '$time') ";
			
	if(mysqli_query($conn, $sql)) {
	
		relocate("../../" . forumDetails($_GET["id"])["folder"]);
	
	}
		
?>