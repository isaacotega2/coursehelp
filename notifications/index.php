<?php

	$page = array("rootPath" => "../", "title" => "Notifications");
	
	include_once("../scripts/php/methods.php");
	
	include_once("../scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "templates/header.php");
	
	require_once($page["rootPath"] . "scripts/php/connection.php");
	
	$accountDetails = accountDetails($user["account"]["usercode"]);
	
?>

    <style>
    	
    		#container {
    			padding: 1cm 0;
    		}
		
		#container .notification {
			width: 96%;
			min-height: 2cm;
			padding: 5mm 5mm;
			border-top: 1px solid rgba(0, 0, 0, 0.2);
			border-bottom: 1px solid rgba(0, 0, 0, 0.2);
			transition: background-color 0.2s;
			color: black;
		}
		
		#container [unread] {
			background-color: rgba(100, 100, 0, 0.1);
		}
		
		#container .notification:active {
			background-color: rgba(0, 0, 0, 0.1);
		}
		
		#container .notification #textHolder {
			font-size: 12px;
			min-height: 2cm;
			overflow: hidden;
		}
		
		#container .notification #dateHolder {
			text-align: right;
			font-size: 12px;
		}
		
		#container .notification #imageHolder {
			width: 2.5cm;
			height: 2.5cm;
			float: left;
			transform: translateY(-0.25cm) translateX(-0.25cm);
		}
		
		#container .notification #imageHolder #image {
			width: 100%;
			height: 100%;
			background-color: rgba(100, 100, 0, 0.1);
			border-radius: 50%;
		}
		
    </style>

    <div class="head-div"> <span style="display: flex; justify-content: center;
     height: 100%; align-items: center;">Notifications</span></div>
     
     
     <div id="container">
     
     	<?php
     	
     		foreach($accountDetails["notifications"]["ids"] as $eachId) {
     			
     			$notificationDetails = notificationDetails($eachId);
     		
     			include($page["rootPath"] . "templates/notification-box.php");
     			
     			$sql = "UPDATE notifications SET seen = 'true' WHERE notification_id = '$eachId' ";
     			
     			mysqli_query($conn, $sql);
     		
     		}
     	
     	?>
     
     </div>
     
<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>