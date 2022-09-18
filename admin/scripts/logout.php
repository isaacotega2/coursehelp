<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	setcookie($website["cookies"]["admin"]["name"], "true", (time() - 1), "/");
		
	echo '<script> window.location.href = "../"; </script>';
		
 ?>