<?php

	$page = array("rootPath" => "../", "title" => "Topic");
	
	include_once("../scripts/php/methods.php");
	
	include_once("../scripts/php/general-info.php");
	
	$topicId = $_GET["id"];
	
	$topicDetails = topicDetails($topicId);
	
	
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
 .comment {
  background-color: rgb(211, 191, 191);
   width: 92%;
    height: 150px;
    margin-left: 20px;
    border-radius: 5px;
   position: relative;
}
 .down {
   color: gray;
   display: flex;
   position: absolute;
   bottom: 0;
   z-index: 100;
 }

 footer {
   width: 100%;
   height: 300px;
   background-color: rgb(131, 97, 97);
   margin-top: 50px;
   border-radius: 10px;
   
   }

   .footer-content {
     display: flex;
     align-items: center;
     justify-content: center;
     flex-direction: column;
     text-align: center;
      }

    .socials {
      list-style: none;
      display: flex;
      align-items: center;
      justify-content: center;
      
    }
    .socials li {
      margin: 0 10px;
    }
    .socials a {
      text-decoration: none;
      color: black;
      border: 1.1px solid black;
      padding: 5px;
      border-radius: 50%;
    }
  
    .footer-bottom span {
      float: left;
      font-size: 14px;
      word-spacing: 2px;
      text-transform: capitalize;
    }
      
    </style>

     <h3> <?php echo $topicDetails["title"]; ?> </h3>
     <p>Posted by <?php echo accountDetails($topicDetails["posterUsercode"])["fullName"]; ?>: <?php echo $topicDetails["datePosted"]; ?> <?php echo $topicDetails["timePosted"]; ?></p> <hr>
     
     <div><?php echo $topicDetails["body"]; ?> </div>
     
    <button class="comment-button"><a href="<?php echo $page["rootPath"]; ?>forum/actions/comment?id=<?php echo $topicDetails["topicId"]; ?>">Comment </a></button>
    <div class="FW" style="margin-top: 20px; height: 60%; background-color: rgb(238, 216, 216);">
    
    <?php
    
      	foreach($topicDetails["list"]["comments"]["ids"] as $eachId) {
      		
      		$commentDetails = commentDetails($eachId);
      	
      		echo '<div class="comment"><p style="color: grey;">' . accountDetails($commentDetails["commenterUsercode"])["fullName"] . ' reply: ' . $commentDetails["timePosted"] . ' on ' . $commentDetails["datePosted"] . '</p>
        <p>' . $commentDetails["comment"] . '</p>
        <p class="down"> <a href="#"> (Reply)</a> <a href="#">(Report) </a>  34 Likes <a href="#"> (Like)</a></p></div>';
        		
        	}
        
     ?>
    
    
    <!--
  
      <div class="comment"><p style="color: grey;">Sarah reply: 2:32am on july 10th 2022</p>
        <p>gutted TJ monny didnt win, well Congratulations to aluta Standard</p>
        <p class="down"> <a href="#"> (Reply)</a> <a href="#">(Report) </a>  34 Likes <a href="#"> (Like)</a></p></div>
    
        <div class="comment"><p style="color: grey;">Benardinho reply: 2:32am on july 10th 2022</p>
          <p> Congratulations. we believe you can move the university forward
          </p>
          <p class="down"> <a href="#"> (Reply)</a> <a href="#">(Report) </a>  54 Likes <a href="#"> (Like)</a> </p> </div>
    </div>
    
    -->
    
<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>