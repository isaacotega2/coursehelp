<div class="comment" function="reply" id="<?php echo $replyDetails["replyId"]; ?>"><p style="color: grey;"><a href="<?php echo $page["rootPath"]; ?>profile?id=<?php echo $replyDetails["replierUsercode"]; ?>"><?php echo accountDetails($replyDetails["replierUsercode"])["nickname"]; ?></a> replied: <?php echo $replyDetails["timePosted"]; ?> on <?php echo $replyDetails["datePosted"]; ?></p>

		<?php
		
		if($replyDetails["is"]["based"]) {
		
		echo '

		<div id="embededComment">
		
			<p id="name">' . accountDetails(replyDetails($replyDetails["baseId"])["replierUsercode"])["nickname"] . '</p>
		
			<p id="text">' . replyDetails($replyDetails["baseId"])["reply"] . '</p>
		
		</div>';
		
		}
		
		?>
		
        <p>
        	
        		<pre id="text"><?php echo $replyDetails["reply"]; ?></pre>
        		
     	<div class="imageContainer">
     	
     		<?php
     		
     			if(file_exists($page["rootPath"] . "images/posts/" . $replyDetails["replyId"] . "_1.jpg")) {
     			
     				echo '<img src="' . $page["rootPath"] . "images/posts/" . $replyDetails["replyId"] . "_1.jpg" . '"></img>';
     			
     			}
     		
     			if(file_exists($page["rootPath"] . "images/posts/" . $replyDetails["replyId"] . "_2.jpg")) {
     			
     				echo '<img src="' . $page["rootPath"] . "images/posts/" . $replyDetails["replyId"] . "_2.jpg" . '"></img>';
     			
     			}
     		
     			if(file_exists($page["rootPath"] . "images/posts/" . $replyDetails["replyId"] . "_3.jpg")) {
     			
     				echo '<img src="' . $page["rootPath"] . "images/posts/" . $replyDetails["replyId"] . "_3.jpg" . '"></img>';
     			
     			}
     		
     		?>
     	
     	</div>
     	
        	</p>
        
      	  <p class="down">
        	
      		  <a href="<?php echo $page["rootPath"]; ?>forum/actions/report?id=<?php echo $replyDetails["commentId"]; ?>">(Report)</a>
      	  
      		  <?php echo $replyDetails["likes"]["number"]; ?> Likes
      	  
      		  <a href="<?php echo $page["rootPath"]; ?><?php echo $baseFolder; ?>/actions/like?id=<?php echo $replyDetails["replyId"]; ?>&return=<?php echo urlencode("http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>"> (<?php echo (in_array($user["account"]["usercode"], $replyDetails["likes"]["usercodes"]) ? "Unlike" : "Like"); ?>)</a>
      	  
      		  <a href="<?php echo $page["rootPath"]; ?><?php echo $baseFolder; ?>/actions/reply?topic-id=<?php echo $replyDetails["topicId"]; ?>&base-id=<?php echo $replyDetails["replyId"]; ?>">(Reply)</a>
      	  
      	  </p>
        
        </div>