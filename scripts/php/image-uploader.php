<?php
	
	$page = array("rootPath" => "../../", "title" => "Edit Profile", "restriction" => array("account"));
	
	
	include_once($page["rootPath"] . "scripts/php/functions.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	
	$returnPage = $_GET["next"];
	
	$file = $_FILES["profilePicture"];
	
	$filePath = $page["rootPath"] . $_GET["path"];
	
	if(move_uploaded_file($file["tmp_name"], $filePath)) {
	
	}
	
	else {
	
		echo '<script> alert("Error uploading image!"); </script>';
	
	}
	
	relocate($returnPage);
	
 ?>