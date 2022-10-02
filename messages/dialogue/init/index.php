<?php
	
	$page = array("rootPath" => "../../../", "restriction" => array("account"));
	
	
	include_once($page["rootPath"] . "scripts/php/access-restrictor.php");
		
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/functions.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	require_once($page["rootPath"] . "scripts/php/connection.php");
	
	
	$partner = $_GET["partner"];
	
	
	$accountDetails = accountDetails($user["account"]["usercode"]);
	
	
	foreach($accountDetails["dialogues"]["ids"] as $eachId) {
		
		$dialogueDetails = dialogueDetails($eachId);
	
		if($dialogueDetails["firstPartnerUsercode"] == $partner || $dialogueDetails["secondPartnerUsercode"] == $partner) {
		
			relocate($page["rootPath"] . "messages/dialogue?id=" . $dialogueDetails["dialogueId"]);
			
			break;
			
			exit();
		
		}
	
	}
	
	
	$dialogueId = mysqli_real_escape_string($conn, randomDigits(20));
	
	$firstPartnerUsercode = mysqli_real_escape_string($conn, $user["account"]["usercode"]);
	
	$secondPartnerUsercode = mysqli_real_escape_string($conn, $partner);
	
	
	$sql = "INSERT INTO dialogues (dialogue_id, first_partner_usercode, second_partner_usercode) VALUES ('$dialogueId', '$firstPartnerUsercode', '$secondPartnerUsercode') ";
	
	if(mysqli_query($conn, $sql)) {
	
		relocate($page["rootPath"] . "messages/dialogue?id=" . $dialogueId);
	
	}
	
?>