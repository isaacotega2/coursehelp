<?php
	
	session_start();
	
	$mainCourseId = $_GET["id"];

	$subCourseId = $_GET["sub-course"];

	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	
    	$mainCourseDetails = mainCourseDetails($mainCourseId);
 			
    	$subCourseDetails = subCourseDetails($subCourseId);
    	
 			
	$page["title"] = ($mainCourseDetails["name"] . " handouts >> " . $subCourseDetails["name"]);
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>



    <div class="head-div"> <span style="display: flex; justify-content: center;"> <?php echo $mainCourseDetails["name"]; ?> handouts</span></div>
       <hr>
       
       
    <div class="thread">
    
      <div style="color: grey;">
      
      	Course name: <?php echo $subCourseDetails["name"]; ?>

		<br>

		Level: <?php echo $subCourseDetails["level"]; ?> level

		<br>
		
		Posted on: <?php echo $subCourseDetails["datePosted"]; ?> | <?php echo $subCourseDetails["timePosted"]; ?>
		
		<br> Credit/Source: <?php echo $subCourseDetails["institution"]; ?>, <?php echo $subCourseDetails["department"]; ?> Department</div>
      
      	<hr>
      
     	<div>
     
 		    <b>
 		    	
 		    		<a href="?id=<?php echo $mainCourseId; ?>">
 		    			
 		    			<?php echo $mainCourseDetails["name"]; ?>
 		    			
 		    		</a>
 		    		
 		    		 >> 
 		    		 
 		    		<a href="?id=<?php echo $mainCourseId; ?>&action=handouts">handouts</a>
 		    		
 		    		  >> 
 		    	
 		    			<?php echo $subCourseDetails["name"]; ?>
 		    			
 		    	</b>
     	
     	</div>
     
     </div>
     
     <br><br>
     
     <?php
     
     	$_SESSION["showHandout"] = "true";
     		
     	for($i = 1; $i <= $subCourseDetails["pagesNumber"]; $i++) {
     		
     		echo '
     	
  			  <img alt="' . $subCourseDetails["name"] . ' >> page ' . $i . '" src="' . $page["rootPath"] . 'scripts/php/handout-page.php?sub-course-id=' . $subCourseId . '&page=' . $i . '">

			  <hr>
    
    			';
    			
     	}
     	
     ?>
     <!--
    <h3>Material Locked</h3>
    <h3> To unlock the rest of the material, Click <a href="#"> Here</a></h3>
    -->
    
<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>