<?php
	
	$page = array("rootPath" => "../../", "restriction" => array("account"));
	
	
	include_once($page["rootPath"] . "scripts/php/access-restrictor.php");
		
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	require_once($page["rootPath"] . "scripts/php/connection.php");
	
	$request = $_POST["request"];
	
	
	if($request == "sendMessage") {
	
		$chatId = mysqli_real_escape_string($conn, $_POST["chatId"]);
	
		$text = mysqli_real_escape_string($conn, $_POST["message"]);
	
		$messageId = mysqli_real_escape_string($conn, randomDigits(20));
		
		$usercode = mysqli_real_escape_string($conn, $user["account"]["usercode"]);
		
		$sql = "INSERT INTO messages (message_id, chat_id, text, sender_usercode, date_sent, time_sent) VALUES ('$messageId', '$chatId', '$text', '$usercode', '$date', '$time')";
		
		if(mysqli_query($conn, $sql)) {
		
			$data = array("status" => "success");
			
			echo json_encode($data);
		
		}
	
	}
	
	
	if($request == "loadMessages") {
	
		$chatId = mysqli_real_escape_string($conn, $_POST["chatId"]);
		
		$messages = array();
	
		foreach(dialogueDetails($chatId)["messages"]["ids"] as $eachId) {
		
			$messages[] = messageDetails($eachId);
		
		}
		
	
			$data = array("status" => "success", "messages" => $messages);
			
			echo json_encode($data);
		
		
	
	}
	
 ?>