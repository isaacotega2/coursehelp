<?php

	$page = array("rootPath" => "../", "title" => "Forums");
	
	include_once($page["rootPath"] . "templates/header.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
?>

    <style>
    
.forum-container {
    border-style: solid;
    border-width: 1px;
    border-color: rgb(131, 97, 97);;
    border-radius: 10px;
    font-weight: 500;
    height: 50px;
    margin-bottom: 8px;
}

P {
  display: inline-block;
  margin-left: 2px;
  
  text-align: center;
  
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
    
  <div class="head-div"> <span style="display: flex; justify-content: center;
    height: 100%; align-items: center;">Forum</span></div>
   
    <h3>Select a Forum </h3>
    
    <?php
    	
    		foreach($website["content"]["forums"]["ids"] as $eachId) {
    		
 			echo '<div class="forum-container"><img style=" width: 50px; margin-top: 5px; float: left;" src="forumIMG/feedback-smallcanvas-1080x675.png"><p ><a href="' . $page["rootPath"] . forumDetails($eachId)["pageUri"] . '">' . forumDetails($eachId)["name"] . '</a></p></div>';
 			
 		}
 		
 	?>

<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>