<?php
	
	$departmentId = $_GET["department"];

	$institutionId = $_GET["institution"];

	$courseId = $_GET["course"];

	require_once($page["rootPath"] . "scripts/php/connection.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
    	$institutionDetails = institutionDetails($institutionId);
 			
    	$departmentDetails = departmentDetails($departmentId);
 			
    	$courseDetails = courseDetails($courseId);
 			
	$page["title"] = ("Select a handout - " . $departmentDetails["name"]);
	
	$action = $_GET["action"];
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>

<?php
	
	foreach($courseDetails["handouts"]["ids"] as $eachHandoutId) {
				
		$handoutDetails = officialHandoutDetails($eachHandoutId);
				
	     echo '<div class="thread">
      	
      		<div style="color: grey;">
      		
      			Posted on: ' . $handoutDetails["datePosted"] . ', ' . $handoutDetails["timePosted"] . '<br> Credit/Source: ' . $institutionDetails["name"] . ', ' . $departmentDetails["name"] . ' Department
      		
      	</div>
      	
      	<hr>
      	
	     <div> &#8594;
     
 		    <a href="handout?id=' . $handoutDetails["handoutId"] . '">' . $handoutDetails["name"] . '</a>
     	
     	</div>
     
     </div>';

//		echo '<li> <a href="?department=' . $departmentId . '&action=' . $action . '&institution=' . $institutionId . '&course=' . $eachCourseId . '">' . $courseDetails["name"] . '</a> </li>';
		
	}
			
?>

<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>