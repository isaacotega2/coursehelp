<?php

	$page = array("rootPath" => "../");
	
	include_once("../scripts/php/methods.php");
	
	include_once("../scripts/php/general-info.php");
	
	$topicId = $_GET["id"];
	
	$topicDetails = topicDetails($topicId);
	
	$page["title"] = $topicDetails["title"];
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>

    <style>
 body{
        font-family: -apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue",Ubuntu,sans-serif;
      }

    a {
        text-decoration: none;
      }

      h3 {
        display: flex;
        justify-content: center;
      }
      .comment-button {
align-items: center;
appearance: none;
background-color: rgb(211, 191, 191);
border: 1px solid #dbdbdb;
border-radius: .375em;
box-shadow: none;
box-sizing: border-box;
color: #363636;
cursor: pointer;
display: inline-flex;
font-family: BlinkMacSystemFont,-apple-system,"Segoe UI",Roboto,Oxygen,Ubuntu,Cantarell,"Fira Sans","Droid Sans","Helvetica Neue",Helvetica,Arial,sans-serif;
font-size: 1rem;
height: 2.5em;
justify-content: center;
line-height: 1.5;
padding: calc(.5em - 1px) 1em;
position: relative;
text-align: center;
user-select: none;
-webkit-user-select: none;
touch-action: manipulation;
vertical-align: top;
white-space: nowrap;
}

.comment-button:active {
border-color: #4a4a4a;
outline: 0;
}

.comment-button:focus {
border-color: #485fc7;
outline: 0;
}

.comment-button:hover {
border-color: #b5b5b5;
}

.comment-button:focus:not(:active) {
box-shadow: rgba(72, 95, 199, .25) 0 0 0 .125em;
}
.FW {
height: 100px;
  background-color: rgb(211, 191, 191);
  color: black;
  margin-top: 10px;
  border-radius: 10px;
}

	#topicBody {
		text-align: left;
		padding: 5mm;
	}
	
    </style>

     <h3> <?php echo $topicDetails["title"]; ?> </h3>
     
     <p>Posted by <a href="<?php echo $page["rootPath"]; ?>profile?id=<?php echo accountDetails($topicDetails["posterUsercode"])["usercode"]; ?>"><?php echo accountDetails($topicDetails["posterUsercode"])["nickname"]; ?></a>: <?php echo $topicDetails["datePosted"]; ?> <?php echo $topicDetails["timePosted"]; ?> >> 
     
     	<a href="<?php echo $page["rootPath"]; ?>forum/<?php echo forumDetails($topicDetails["forumId"])["folder"]; ?>">
     		
     		<?php echo forumDetails($topicDetails["forumId"])["name"]; ?>
     		
     	</a>
     
     </p>
     
     <hr>
     
     <div id="topicBody">
     	
     	<pre><?php echo $topicDetails["body"]; ?></pre>
     	
     	<div class="imageContainer">
     	
     		<?php
     		
     			if(file_exists($page["rootPath"] . "images/posts/" . $topicId . "_1.jpg")) {
     			
     				echo '<img src="' . $page["rootPath"] . "images/posts/" . $topicId . "_1.jpg" . '"></img>';
     			
     			}
     		
     			if(file_exists($page["rootPath"] . "images/posts/" . $topicId . "_2.jpg")) {
     			
     				echo '<img src="' . $page["rootPath"] . "images/posts/" . $topicId . "_2.jpg" . '"></img>';
     			
     			}
     		
     			if(file_exists($page["rootPath"] . "images/posts/" . $topicId . "_3.jpg")) {
     			
     				echo '<img src="' . $page["rootPath"] . "images/posts/" . $topicId . "_3.jpg" . '"></img>';
     			
     			}
     		
     		?>
     	
     	</div>
     	
     </div>
     
<button class="comment-button"><a href="../forum/actions/reply?topic-id=<?php echo $topicId; ?>&unbased"> Post Reply </a></button>

    <div class="FW" style="margin-top: 20px; height: 60%; background-color: rgb(238, 216, 216);">
    
    <?php
    	
    		$baseFolder = "forum";
    	
    		$commentArray = array();
    
      	foreach($topicDetails["list"]["replies"]["ids"] as $eachId) {
      		
      		$replyDetails = replyDetails($eachId);
      		
      		include($page["rootPath"] . "templates/reply.php");
      			
        	}
        
     ?>
    
 
    
<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>