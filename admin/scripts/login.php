<?php

	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	

	if($_POST["password"] == "inevitablesuccess") {
	
		setcookie($website["cookies"]["admin"]["name"], "true", (time() + (86400 * 1)), "/");
		
		echo '<script> window.location.href = "../"; </script>';
		
	}
	
	else {
	
		echo '<script> alert("Access denied!"); window.location.href = "../"; </script>';
		
	}
	
 ?>