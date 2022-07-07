<?php
	
//	include_once($page["rootPath"] . "scripts/php/access-restrictor.php");
		
	include_once($page["rootPath"] . "scripts/php/general-info.php");

?>

<!DOCTYPE html>
<html>
  <head>
  
	<title><?php echo ($page["title"] . " - " . $website["name"]); ?></title>
	
		<link rel="stylesheet" type="text/css" href="<?php echo $page["rootPath"]; ?>styles/index.css">

	
		
    </head>
  <body>
<header> <img class="head-image" src="<?php echo $page["rootPath"]; ?>images/icon.png"> 
	
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
       <div class="ads"> ads </div>
     <hr>
     <div class="button-line">
     
       <button><em> <a class="button-link" href="<?php echo $page["rootPath"]; ?>courses">Courses</a></em></button>
       
       <button> <em><a class="button-link" href=""> Funny/Weird Questions</a></em></button> 
       <button> <em> <a class="button-link" href=""> Q/A game</a> </em></button>
       <button><em> <a class="button-link" href=""> Messages</a></em></button>
       <button> <em><a class="button-link" href="<?php echo $page["rootPath"]; ?>forum"> Forum </a></em></button> 
       <button><em> <a class="button-link" href=""> Notifications</a></em></button>
      <button><em><a class="button-link" href=""> Coursehelp</a></em></button> 
    </div>