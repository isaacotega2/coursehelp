<?php
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
		
	include_once($page["rootPath"] . "scripts/php/methods.php");
		
	include_once($page["rootPath"] . "scripts/php/functions.php");
		
	
	if(isset($page["restriction"])) {
	
		if(in_array("account", $page["restriction"])) {
		
			if(!$user["is"]["signedIn"]) {
						
				relocate($page["rootPath"] . "login?next=" . urlencode("http://" . $_SERVER["HTTP_HOST"]) . $_SERVER["REQUEST_URI"]);
			
			}
		
		}
		
	}
	
 ?>