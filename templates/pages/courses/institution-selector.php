<?php
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	$page["title"] = ("Select an institution");
	
	include_once($page["rootPath"] . "templates/header.php");
	
	$departmentId = $_GET["department"];
	
	$action = $_GET["action"];
	
?>

  <div class="head-div"> <span style="display: flex; justify-content: center;
    height: 100%; align-items: center;">Institutions</span></div>
   
<h3>Select an institution</h3>


<?php
	
    		foreach($website["content"]["institutions"]["ids"] as $eachId) {
    		
 			echo '<div class="container">
 				
 				<p>
 					
 					<a href="?department=' . $departmentId . '&action=' . $action . '&institution=' . $eachId . '">' . institutionDetails($eachId)["name"] . '</a>
 					
 				</p>
 					
 			</div>';
 			
 		}
 		
?>

<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>