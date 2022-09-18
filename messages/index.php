<?php
	
	$page = array("rootPath" => "../", "title" => "Messages", "restriction" => array("account"));
	
	
	include_once("../scripts/php/functions.php");
	
	include_once("../scripts/php/methods.php");
	
	
	$accountDetails = accountDetails($user["account"]["usercode"]);
	
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>

<style>

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

</style>

    <div class="head-div"> <span style="display: flex; justify-content: center;
     height: 100%; align-items: center;">Messages</span></div>
     
     

	<?php
		
		if(count($accountDetails["dialogues"]["ids"]) == 0) {
			
			echo '<div class="placeholder">You have no messages!</div>';
		
		}
			
		foreach($accountDetails["dialogues"]["ids"] as $eachId) {
			
			$dialogueDetails = dialogueDetails($eachId);
			
			$partner = accountDetails($dialogueDetails["user"]["partner"]["usercode"]);
			
			$lastMessage = messageDetails($dialogueDetails["messages"]["ids"][(count($dialogueDetails["messages"]["ids"]) - 1)])["text"];
		
  		   echo '<a href="dialogue?id=' . $eachId . '">
  		   
  		   <div class="messageBox">
     
     	<div id="imageHolder">
     	
     		<img id="profilePicture" src="' . $partner["profilePicture"] . '" alt="' . $partner["nickname"] . '"></img>
     	
     	</div>
     
     	<div id="contentHolder">
     	
     		<label id="name">' . $partner["nickname"] . '</label>
     		
     		<br>
     		
     		<label id="message">' . $lastMessage . '</label>
     	
     	</div>
     
     </div>
     
     </a>';
  		   
  		}
  		
  	?>
       
<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>