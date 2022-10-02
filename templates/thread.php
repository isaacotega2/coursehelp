<?php
	
 ?>
 
 
       <div class="thread">
        <div style="color: grey;"> Posted by <a href="<?php echo $page["rootPath"]; ?>profile?id=<?php echo accountDetails($topicDetails["posterUsercode"])["usercode"]; ?>"><?php echo accountDetails($topicDetails["posterUsercode"])["nickname"]; ?></a>: <?php echo $topicDetails["datePosted"]; ?> <?php echo $topicDetails["timePosted"]; ?></div> <hr>
       <div> &#8594;<a href="../../topic?id=<?php echo $topicDetails["topicId"]; ?>"> <?php echo $topicDetails["title"]; ?>
       </a></div>  </div>