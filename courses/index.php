<?php
	
	$page = array("rootPath" => "../", "restriction" => array("account"));
	
	if(isset($_GET["department"])) {
	
		if(isset($_GET["action"])) {
	
			if($_GET["action"] == "handouts") {
	
				if(isset($_GET["institution"])) {
	
					if(isset($_GET["course"])) {
	
						include($page["rootPath"] . "templates/pages/courses/handout-list.php");
						
					}
					
					else {
			
						include($page["rootPath"] . "templates/pages/courses/course-selector.php");
				
					}
			
				}
				
				else {
			
					include($page["rootPath"] . "templates/pages/courses/institution-selector.php");
				
				}
			
			}
			
		}
		
		else {
	
			include($page["rootPath"] . "templates/pages/courses/action-selector.php");
			
		}
	
	}
	
	else {
	
		include($page["rootPath"] . "templates/pages/courses/department-selector.php");
	
	}
	
 ?>