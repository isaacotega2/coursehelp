<?php

	$page["title"] = "Select a departement to view courses";
	
	include_once($page["rootPath"] . "templates/header.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
?>

    <style>
    
    </style>
    
  <div class="head-div"> <span style="display: flex; justify-content: center;
    height: 100%; align-items: center;">Courses</span></div>
   
    <h3>Select a Department </h3>
    
    <?php
    	
    		foreach($website["content"]["departments"]["ids"] as $eachId) {
    		
			echo '<div class="container">
 				
 				<p>
 					
 					<a href="?department=' . $eachId . '">' . departmentDetails($eachId)["name"] . '</a>
 					
 				</p>
 					
 			</div>';
				
 		}
 		
 	?>
 	
<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>