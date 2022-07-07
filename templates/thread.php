<?php
	
 ?>
 
 
       <div class="thread">
        <div style="color: grey;"> Posted by <?php echo accountDetails($topicDetails["posterUsercode"])["fullName"]; ?>: <?php echo $topicDetails["datePosted"]; ?> <?php echo $topicDetails["timePosted"]; ?></div> <hr>
       <div> &#8594;<a href="../../topic?id=<?php echo $topicDetails["topicId"]; ?>"> <?php echo $topicDetails["title"]; ?>
       </a></div>  </div>