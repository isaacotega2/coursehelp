<?php

	if(!isset($discussionType)) {
	
		$discussionType = "forum";
	
	}

?>

<div class="comment"><p style="color: grey;"><a href="<?php echo $page["rootPath"]; ?>profile?id=<?php echo $commentDetails["commenterUsercode"]; ?>"><?php echo accountDetails($commentDetails["commenterUsercode"])["nickname"]; ?></a> commented: <?php echo $commentDetails["timePosted"]; ?> on <?php echo $commentDetails["datePosted"]; ?></p>
        <p><pre id="text"><?php echo $commentDetails["comment"]; ?></pre></p>
        
      	  <p class="down">
        	
      		  <a href="<?php echo $page["rootPath"]; ?><?php echo $discussionType; ?>/actions/reply?id=<?php echo $commentDetails["commentId"]; ?>"> (Reply)</a>
      	  
      		  <a href="<?php echo $page["rootPath"]; ?><?php echo $discussionType; ?>/actions/report?id=<?php echo $commentDetails["commentId"]; ?>">(Report)</a>
      	  
      		  <?php echo $commentDetails["likes"]["number"]; ?> Likes
      	  
      		  <a href="<?php echo $page["rootPath"]; ?><?php echo $discussionType; ?>/actions/like?id=<?php echo $commentDetails["commentId"]; ?>&return=<?php echo urlencode("http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>"> (<?php echo (in_array($user["account"]["usercode"], $commentDetails["likes"]["usercodes"]) ? "Unlike" : "Like"); ?>)</a>
      	  
      	  </p>
        
        </div>