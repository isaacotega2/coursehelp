<?php
	
	session_start();
	
	$page = array("rootPath" => "../../", "restriction" => array("account"));
	
	$handoutId = $_GET["id"];
	

	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	require_once($page["rootPath"] . "scripts/php/connection.php");
	
	
    	$handoutDetails = officialHandoutDetails($handoutId);
    	
    	$courseDetails = courseDetails($handoutDetails["courseId"]);
 			
    	$departmentDetails = departmentDetails($courseDetails["departmentId"]);
 			
    	$institutionDetails = institutionDetails($courseDetails["institutionId"]);
 			
 			
	$page["title"] = ($departmentDetails["name"] . " handout > " . $handoutDetails["name"]);
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>

<style>


	.handoutPages {
		
	}
	
	#imageContainer {
		width: 100%;
		text-align: center;
	}

 	#imageContainer .imageHolder {
 		width: 8cm;
		height: 8cm;
 		margin: 1mm;
 		display: inline-block;
 		overflow: scroll;
 		position: relative;
 		box-shadow: 0 0 5px 0 black;
 		overflow: hidden;
 	}
 
 	#imageContainer .imageHolder #image {
 		width: 100%;
 		height: 100%;
 	}
 
 	#imageContainer .imageHolder #page {
 		width: 1cm;
 		height: 1cm;
 		background-color: rgba(0, 0, 0, 0.2);
 		line-height: 1cm;
 		padding: 2mm;
 		position: absolute;
 		bottom: 0;
 		right: 0;
 		color: black;
 		font-weight: 700;
 	}
 
 </style>

    <div class="head-div"> <span style="display: flex; justify-content: center;"><?php echo $handoutDetails["name"]; ?></span></div>
       <hr>
       
       
    <div class="thread">
    
      <div style="color: grey;">
      
      	Course name: <?php echo $courseDetails["name"]; ?>

		<br>

		Level: <?php echo $courseDetails["level"]; ?> level

		<br>
		
		Posted on: <?php echo $handoutDetails["datePosted"]; ?> | <?php echo $handoutDetails["timePosted"]; ?>
		
		<br> Credit/Source: <?php echo $institutionDetails["name"]; ?>, <?php echo $departmentDetails["name"]; ?> Department</div>
      
      	<hr>
      
     	<div>
     
 		    <b>
 		    	
 		    		<a href="../?department=<?php echo $departmentDetails["departmentId"]; ?>&action=handouts">
 		    			
 		    			<?php echo $institutionDetails["name"]; ?>
 		    			
 		    		</a>
 		    		
 		    		 >
 		    		 
 		    		<a href="../">
 		    			
 		    			<?php echo $departmentDetails["name"]; ?>
 		    			
 		    		</a>
 		    		
 		    		 >
 		    		 
 		    		<a href="../?department=<?php echo $departmentDetails["departmentId"]; ?>&action=handouts&institution=<?php echo $institutionDetails["institutionId"]; ?>">
 		    			
 		    			<?php echo $courseDetails["level"]; ?>
 		    			
 		    		</a>
 		    		
 		    		 >
 		    		 
 		    		<a href="../?department=<?php echo $departmentDetails["departmentId"]; ?>&action=handouts&institution=<?php echo $institutionDetails["institutionId"]; ?>">
 		    			
 		    			<?php echo $courseDetails["name"]; ?>
 		    			
 		    		</a>
 		    		
 		    		 >
 		    		 
 		    		<a href="../?department=<?php echo $departmentDetails["departmentId"]; ?>&action=handouts&institution=<?php echo $institutionDetails["institutionId"]; ?>&course=<?php echo $courseDetails["courseId"]; ?>">
 		    			
 		    			handouts
 		    			
 		    		</a>
 		    		
 		    		 >
 		    		 
 		    		<a>
 		    			
 		    			<?php echo $handoutDetails["name"]; ?>
 		    			
 		    		</a>
 		    		
 		    	</b>
 		    	
 		    	<br><br>
     	
     	</div>
     
     </div>
     
     <br><br>
     
     <div id="imageContainer">
     
     <?php
     
     //	$_SESSION["showHandout"] = "true";
     	
  	  	$accountDetails = accountDetails($user["account"]["usercode"]);
    	
     	if(in_array($handoutDetails["handoutId"], $accountDetails["subscriptions"]["handout"]["active"]["ids"])) {
     	
			$sql = "SELECT * FROM subscriptions WHERE subscriber_usercode = '" . $user["account"]["usercode"] . "' AND product_id = '" . $handoutDetails["handoutId"] . "' ";
		
			if($result = mysqli_query($conn, $sql)) {
			
				$row = mysqli_fetch_array($result);
					
				$subscriptionDate = $row["date_subscribed"];
				
				$duration = $row["duration"];
				
			}
				
     		echo '
    <h3>You are subscribed to view this handout</h3>
    <h3>Subscription began in ' . $subscriptionDate . ' with a duration of ' . $duration . ' days</h3>';
     	
     	//	$limit = $handoutDetails["pagesNumber"];
     	
     	}
     	
     	else {
     	
     		echo '
    <h3>Material Locked</h3>
    <h3> To unlock the rest of the material, Click <a href="unlock?id=' . $handoutId . '"> Here</a></h3>';
     	
     	}
     		
     	for($i = 0; $i < $handoutDetails["pagesNumber"]; $i++) {
     		
     		$index = ($i + 1);
     		
     		echo '
     			
     		<div class="imageHolder"> 
     		
     		<a target="_blank" href="' . $page["rootPath"] . 'handout-page?id=' . $handoutId . '&page=' . $index . '">
     	
  				<img alt="' . $handoutDetails["name"] . ' >> page ' . $index . '. ' . $departmentDetails["name"] . ' department" src="' . $page["rootPath"] . 'handout-page?id=' . $handoutId . '&page=' . $index . '" id="image"><!img>
  				
  			 <span id="page">' . $index . '</span>
  			   
  			  </a>
  			  
  			  </div>

    			';
    			
     	}
     	
     ?>
     
     </div>
     
<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>