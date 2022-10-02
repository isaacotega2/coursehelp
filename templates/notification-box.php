     <a href="view?id=<?php echo ($notificationDetails["notificationId"]); ?>">
     
     	<div class="notification" <?php echo ($notificationDetails["viewed"]) ? "" : "unread"; ?>>
     	
     		<div id="imageHolder">
     		
     			<img id="image" src="<?php echo $page["rootPath"] . $notificationDetails["imageSrc"]; ?>"></img>
     		
     		</div>
     	
     		<div id="textHolder"><?php echo $notificationDetails["text"]; ?></div>
     	
     		<div id="dateHolder"><?php echo $notificationDetails["dateSent"]; ?>, <?php echo $notificationDetails["timeSent"]; ?></div>
     	
     	</div>
     	
     </a>