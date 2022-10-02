<?php
	
	$mainCourseId = $_GET["id"];

	include_once($page["rootPath"] . "scripts/php/methods.php");
	
    	$courseDetails = mainCourseDetails($mainCourseId);
 			
	$page["title"] = $courseDetails["name"];
	
	include_once($page["rootPath"] . "templates/header.php");
	
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
    height: 100%; align-items: center;"><?php echo $courseDetails["name"]; ?></span></div>
   
   
<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>