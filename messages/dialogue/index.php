<?php
	
	$page = array("rootPath" => "../../", "restriction" => array("account"), "footer" => array("exists" => false) );
	
	
	include_once($page["rootPath"] . "scripts/php/functions.php");
	
	require_once($page["rootPath"] . "scripts/php/connection.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	
	$chatId = $_GET["id"];
	
	
	$chatDetails = dialogueDetails($chatId);
			
	$partner = accountDetails($chatDetails["user"]["partner"]["usercode"]);
		
	$page["title"] = ("Chat - ". $partner["nickname"]);
	
	
	if($chatDetails["firstPartnerUsercode"] == $user["account"]["usercode"]) {
		
		$column = "first_partner_seen";
		
	}
	
	else {
	
		$column = "second_partner_seen";
	
	}
	
	$usercode = $user["account"]["usercode"];
	
	$sql = "UPDATE dialogues SET $column = 'true' WHERE dialogue_id = '$chatId' ";
	
	mysqli_query($conn, $sql);
	
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>

<style>
/*
	.messageBox {
		border-top: 1px solid black;
		border-bottom: 1px solid black;
		height: 3cm;
	}
	
	.messageBox #imageHolder {
		width: 3cm;
		height: 3cm;
		display: inline-block;
		float: left;
	}

	.messageBox #imageHolder #profilePicture {
		width: 3cm;
		height: 3cm;
		border-radius: 50%;
	}

	.messageBox #contentHolder {
		display: inline-block;
		width: 80%;
		color: black
	}

	.messageBox #contentHolder #name {
		font-size: 30px;
		font-weight: 700;
	}

	.messageBox #contentHolder #message {
		font-size: 27px;
	}
	*/
	
	#messageFormHolder {
		width: 100%;
		position: fixed;
		bottom: 0;
		background-color: rgb(245, 244, 244);
	}
	
	#messageFormHolder #frmMessage {
		width: 100%;
		margin: 0;
		padding: 0;
	}

	#messageFormHolder [name=txtMessage] {
		width: 80%;
		margin: 0;
		padding: 4mm;
		height: 3cm;
		font-size: 25px;
		border-radius: 10px 0 0 10px;
	}

	#messageFormHolder [type=submit] {
		width: 15%;
		margin: 0;
		padding: 0 3mm;
		height: 3.8cm;
		font-size: 30px;
		font-weight: 700;
		border-radius: 0 10px 10px 0;
		color: white;
		background-color: rgb(131, 97, 97);
		transform: translateY(-45%);
	}
	
	
	#messagesHolder {
		overflow-y: scroll;
	}
	
	
	.messageBox #main {
		display: inline-block;
		text-align: left;
		background-color: rgba(0, 0, 0, 0.3);
		max-width: 80%;
		padding: 8mm 5mm;
		border-radius: 30px;
		margin: 3mm;
		color: white;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
	}
	
	[mine=true] {
		text-align: right;
	}
	
	[mine=true] #main {
		background-color: blue;
	}
	
	[sending] #main {
		background-color: indigo;
	}
	
	.messageBox #message {
		font-size: 30px;
	}

	.messageBox #time {
		font-size: 25px;
		float: right;
	}

</style>

    <div class="head-div"> <span style="display: flex; justify-content: center;
     height: 100%; align-items: center;">Chat - <?php echo $partner["nickname"]; ?></span></div>
     
     
	<div id="messagesHolder"></div>
	
	
	
     
     <?php
		/*
		foreach($accountDetails["dialogues"]["ids"] as $eachId) {
			
			$dialogueDetails = dialogueDetails($eachId);
			
			$partner = accountDetails($dialogueDetails["user"]["partner"]["usercode"]);
		
  		   echo '<a href="dialogue?id=' . $eachId . '">
  		   
  		   <div class="messageBox">
     
     	<div id="imageHolder">
     	
     		<img id="profilePicture" src="' . $partner["profilePicture"] . '" alt="' . $partner["nickname"] . '"></img>
     	
     	</div>
     
     	<div id="contentHolder">
     	
     		<label id="name">' . $partner["nickname"] . '</label>
     		
     		<br>
     		
     		<label id="message">Message</label>
     	
     	</div>
     
     </div>
     
     </a>';
  		   
  		}
  		*/
  	?>
  	
  	<div id="messageFormHolder">
  		
  		<form id="frmMessage">
  	
  			<textarea name="txtMessage" type="message" placeholder="Type . . ."></textarea>
  			
  			<input type="submit" value="Send">
  		
  		</form>
  	
  	</div>
  	
  	<script>
  		
  		$("#messagesHolder").css({
  			height: window.innerHeight - 520
  		});
  		
  		
  		var messageForm = $("#frmMessage");
  	
  		$(messageForm).submit(function() {
  		
  			event.preventDefault();
  			
  			var message = $(this).children("[name=txtMessage]").val();
  			
  			if(message == "") {
  				
  				return;
  			
  			}
  			
  			$(this).children("[name=txtMessage]").val("");
  			
  			$("#messagesHolder").append('<div class="messageBox" mine="true" sending> <div id="main"> <div id="messageHolder"> <label id="message">' + message + '</label> </div> <div id="timeHolder"> <label id="time">Sending . . .</label> </div> </div> </div>');
  			
  			scrollDown();
  			
  			$.ajax({
  				type: "POST",
  				url: "../../scripts/php/message.php",
  				dataType: "JSON",
  				data: {
  					request: "sendMessage",
  					chatId: '<?php echo $chatId; ?>',
  					message: message
  				},
  				success: function(response) {
  				
  				},
  				error: function(response) {
  			//		alert(JSON.stringify(response));
  				}
  				
  				
  			});
  		
  		});
  		
  		
  		loadMessages(true);
  		
  		setInterval(function() {
  			
  			loadMessages(false);
  		
  		}, 500);
  		
  		var messageResponse = [];
  		
  		function loadMessages(first) {
  	
  			$.ajax({
  				type: "POST",
  				url: "../../scripts/php/message.php",
  				dataType: "JSON",
  				data: {
  					request: "loadMessages",
  					chatId: '<?php echo $chatId; ?>'
  				},
  				success: function(response) {
  					
  					$("#messagesHolder").html("");
  				
  					for(var i = 0; i < response["messages"].length; i++) {
  						
  						var eachMessage = response["messages"][i];
  						
  						var senderUsercode = eachMessage["senderUsercode"];
  					
  						var message = eachMessage["text"];
  					
  						var date = eachMessage["dateSent"];
  					
  						var time = eachMessage["timeSent"];
  					
						$("#messagesHolder").append('<div class="messageBox" mine="' + (senderUsercode == '<?php echo $user["account"]["usercode"]; ?>' ? 'true' : 'false') + '"> <div id="main"> <div id="messageHolder"> <label id="message">' + message + '</label> </div> <div id="timeHolder"> <label id="time">' + date + ' | ' + time + '</label> </div> </div> </div>');
						
					}
					
					if(first) {
					
  						scrollDown();
  		
					}

					if(JSON.stringify(response) != JSON.stringify(messageResponse)) {
					
  						scrollDown();
  		
					}
					
					messageResponse = response;

  				},
  				error: function(response) {
  			//		alert(JSON.stringify(response));
  				}
  				
  				
  			});
  	
  		}
  		
  		function scrollDown() {
  		
			$("#messagesHolder").animate({
				'scrollTop': 1000000000000
			}, 100);
		
  		}
  		
  	</script>
       
<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>