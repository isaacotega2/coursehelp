<?php
	
	$page = array("rootPath" => "../");
	
	if(isset($_GET["id"])) {
	
		if(isset($_GET["action"])) {
	
			if($_GET["action"] == "handouts") {
	
				if(isset($_GET["sub-course"])) {
	
					include($page["rootPath"] . "templates/pages/courses/handout.php");
					
				}
				
				else {
			
					include($page["rootPath"] . "templates/pages/courses/sub-course-selector.php");
				
				}
			
			}
			
		}
		
		else {
	
			include($page["rootPath"] . "templates/pages/courses/action-selector.php");
			
		}
	
	}
	
	else {
	
		include($page["rootPath"] . "templates/pages/courses/list.php");
	
	}
	
 ?>