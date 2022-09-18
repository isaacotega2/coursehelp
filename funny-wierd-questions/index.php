<?php
	
	$page = array("rootPath" => "../", "title" => "Funny/Wierd Questions", "restriction" => array("account"));
	
	
	include_once("../scripts/php/general-info.php");
	
	include_once("../scripts/php/functions.php");
	
	include_once("../scripts/php/methods.php");
	
	
	$questionId = $website["content"]["funnyWierdQuestions"]["currentId"];
	
	$questionDetails = funnyWierdQuestionDetails($questionId);
	
	$discussionType = "funny-wierd-questions";
	
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>

   <div class="head-div"> <span style="display: flex; justify-content: center;
    height: 100%; align-items: center;">Funny/Weird Questions</span></div>
    
    <br><br>

<div class="FW">

<span style="display: flex; justify-content: center;
  height: 100%; align-items: center; font-size: larger;
  font-weight: 500;"><?php echo $questionDetails["question"]; ?></span>
  
<button class="comment-button"><a href="actions/comment?id=<?php echo $questionId; ?>"> Post Reply </a></button>
</div> 
  <div class="FW" style="margin-top: 48px; height: 60%; background-color: rgb(238, 216, 216);">
  
    <?php
    
      	foreach($questionDetails["list"]["comments"]["ids"] as $eachId) {
      		
      		$commentDetails = commentDetails($eachId);
      	
      		include($page["rootPath"] . "templates/comment.php");
        		
     	 	foreach($commentDetails["replies"]["ids"] as $eachId) {
      		
      			$replyDetails = replyDetails($eachId);
      	
      			include($page["rootPath"] . "templates/reply.php");
      			
      		}
        
        	}
        
     ?>
    
  </div>
       
<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>