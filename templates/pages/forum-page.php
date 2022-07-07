<?php
	
	$page = array("rootPath" => "../../");
	
	include_once("../../scripts/php/methods.php");
	
	include_once("../../scripts/php/general-info.php");
	
	$forumDetails = forumDetails($forumId);
	
	$page["title"] = $forumDetails["name"];
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>

    <style>
.thread{
   width: 100%;
   height: 100px;
   background-color: rgb(211, 191, 191);
   margin-top: 25px;
  border-radius: 5px;
  
  
 }
  p{
   display: block;
}
.create {
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

.create:active {
border-color: #4a4a4a;
outline: 0;
}

.create:focus {
border-color: #485fc7;
outline: 0;
}

.create:hover {
border-color: #b5b5b5;
}

.create:focus:not(:active) {
box-shadow: rgba(72, 95, 199, .25) 0 0 0 .125em;
}
    </style>
    
    
    <div class="head-div"> <span style="display: flex; justify-content: center;
     height: 100%; align-items: center;"><?php echo $forumDetails["name"]; ?></span></div>
     
     <button class="create"><a style="color: black;" href="../actions/create-topic?id=<?php echo $forumId; ?>"> Create a Topic </a></button>
     
     <div id="threadHolder">
     
     	<?php
     	
     		foreach($forumDetails["list"]["topics"] as $eachId) {
     			
     			$topicDetails = topicDetails($eachId);
     		
     			include("../../templates/thread.php");
     		
     		}
     	
     	?>
     
     </div>

<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>