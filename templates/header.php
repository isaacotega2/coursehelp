<?php
	
	include_once($page["rootPath"] . "scripts/php/access-restrictor.php");
		
	include_once($page["rootPath"] . "scripts/php/general-info.php");

?>

<!DOCTYPE html>
<html>
  <head>
  
	<title><?php echo ($page["title"] . " - " . $website["name"]); ?></title>
	
		<link rel="stylesheet" type="text/css" href="<?php echo $page["rootPath"]; ?>styles/index.css">

		<script src="<?php echo $page["rootPath"]; ?>scripts/js/JQuery.js"></script>
		
    </head>
  <body>
<header> 
	
	<a href="<?php echo $page["rootPath"]; ?>">
		
		<img class="head-image" src="<?php echo $page["rootPath"]; ?>images/icon.png"></img>
		
	</a>
	
	<?php
		
		if($user["is"]["signedIn"]) {
		
      		echo '<a href="' . $page["rootPath"] . 'profile?id=' . $user["account"]["usercode"] . '">
      			
      			<button class="profile-button"> Profile</button>
      			
      		</a>';
      		
      	}
      	
      	else {
      	
      		echo '<a href="' . $page["rootPath"] . 'login">
      			
      			<button class="profile-button"> Login</button>
      			
      		</a>';
      		
      	}
      	
      ?>
      
     </header>
     <hr>
     
     <?php
     	
     	if(isset($page["buttonLine"])) {
     		
     		if($page["buttonLine"]["exists"]) {
     			
     			include($page["rootPath"] . "templates/top-ads.php");
     			
     			include($page["rootPath"] . "templates/button-line.php");
     			
     		}
     		
     		else {
     		
     		
     		}
     	
    		}
    		
    		else {
    		
     		include($page["rootPath"] . "templates/top-ads.php");
     			
     		include($page["rootPath"] . "templates/button-line.php");
     			
    		}
    		
    	?>