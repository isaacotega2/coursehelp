<?php

	$page = array("rootPath" => "../../../", "restriction" => array("account"));
	
	include_once($page["rootPath"] . "scripts/php/connection.php");
	
	include_once($page["rootPath"] . "scripts/php/functions.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	$resourceId = $_GET["id"];
	
	$returnPage = $_GET["return"];
	
	$date = date("Y m d");
	
	$time = date("h:i");
		
	$sql = "SELECT * FROM likes WHERE resource_id = '$resourceId' AND liker_usercode = '" . $user["account"]["usercode"] . "' ";
	
	if($result = mysqli_query($conn, $sql)) {
		
		if(mysqli_num_rows($result) > 0) {
		
			$sql = "DELETE FROM likes WHERE resource_id = '$resourceId' AND liker_usercode = '" . $user["account"]["usercode"] . "'  ";
			
		}
		
		else {
		
			$sql = "INSERT INTO likes (resource_id, liker_usercode, date_liked, time_liked) VALUES ('$resourceId', '" . $user["account"]["usercode"] . "', '$date', '$time') ";
			
		}
		
		if(mysqli_query($conn, $sql)) {
		
			$replyId = $resourceId;
			
			$topicId = replyDetails($replyId)["topicId"];
		
			notify(replyDetails($replyId)["replierUsercode"], accountDetails($user["account"]["usercode"])["profilePicture"], ("topic?id=" . $topicId . "#" . $replyId), (accountDetails($user["account"]["usercode"])["nickname"] . " liked your comment, click to view."));
		
			echo '<script> window.location.href = "' . $returnPage . '"; </script>';
		
		}
		
	}
	
?>