<?php

	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	
	$accountDetails = accountDetails($user["account"]["usercode"]);
	
	$unseenNotificationsNumber = 0;
	
	foreach($accountDetails["notifications"]["ids"] as $eachId) {
	
		if(!notificationDetails($eachId)["seen"]) {
		
			$unseenNotificationsNumber++;
		
		}
	
	}
	
	$unseenMessagesNumber = $accountDetails["unseenMessagesNumber"];

?>

     <div class="button-line">
     
       <button> <em><a class="button-link" href="<?php echo $page["rootPath"]; ?>funny-wierd-questions"> Funny/Weird Questions</a></em></button> 
       
       <!--
       <button> <em> <a class="button-link" href=""> Q/A game</a> </em></button>
       -->
       
       <button><em> <a class="button-link" href="<?php echo $page["rootPath"]; ?>messages"> Messages <?php echo ($unseenMessagesNumber > 0 ? "(" . $unseenMessagesNumber . ")" : ""); ?></a></em></button>
       <button> <em><a class="button-link" href="<?php echo $page["rootPath"]; ?>forum"> Forum </a></em></button> 
       
       <button><em> <a class="button-link" href="<?php echo $page["rootPath"]; ?>notifications"> Notifications <?php echo ($unseenNotificationsNumber > 0 ? "(" . $unseenNotificationsNumber . ")" : ""); ?> </a></em></button>
       
      <button><em><a class="button-link" href="<?php echo $page["rootPath"]; ?>courses"> Coursehelp</a></em></button> 
      
      <button><em><a class="button-link" href="<?php echo $page["rootPath"]; ?>donate"> Donate</a></em></button> 
      
    </div>
    