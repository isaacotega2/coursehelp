<div class="comment" function="reply"><p style="color: grey;"><a href="<?php echo $page["rootPath"]; ?>profile?id=<?php echo $replyDetails["replierUsercode"]; ?>"><?php echo accountDetails($replyDetails["replierUsercode"])["nickname"]; ?></a> replied: <?php echo $replyDetails["timePosted"]; ?> on <?php echo $replyDetails["datePosted"]; ?></p>
        <p><pre id="text"><?php echo $replyDetails["reply"]; ?></pre></p>
        
      	  <p class="down">
        	
      		  <a href="<?php echo $page["rootPath"]; ?>forum/actions/report?id=<?php echo $replyDetails["commentId"]; ?>">(Report)</a>
      	  
      		  <?php echo $replyDetails["likes"]["number"]; ?> Likes
      	  
      		  <a href="<?php echo $page["rootPath"]; ?>forum/actions/like?id=<?php echo $replyDetails["replyId"]; ?>&return=<?php echo urlencode("http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>"> (<?php echo (in_array($user["account"]["usercode"], $replyDetails["likes"]["usercodes"]) ? "Unlike" : "Like"); ?>)</a>
      	  
      	  </p>
        
        </div>