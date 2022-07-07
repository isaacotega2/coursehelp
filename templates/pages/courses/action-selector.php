<?php
	
	$mainCourseId = $_GET["id"];

	include_once($page["rootPath"] . "scripts/php/methods.php");
	
    	$mainCourseDetails = mainCourseDetails($mainCourseId);
 			
	$page["title"] = ("Choose an action to study " . $mainCourseDetails["name"]);
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>


  <div class="head-div"> <span style="display: flex; justify-content: center;
    height: 100%; align-items: center;"><?php echo $mainCourseDetails["name"]; ?></span></div>
   
    <h4>Select an option</h4>
    <ul>
      <li> <a href="?id=<?php echo $mainCourseId; ?>&action=handouts"> View Handouts/Materials</a> </li>
      <li> <a href="#"> View Past Questions</a> </li>
      <li> <a href="#"> Find a study Partner</a> </li>
      <li> <a href="#"> Find a study Group</a> </li>
      <li> <a href="#"> Watch detailed video Explanation</a> </li>
      <li> <a href="#"> Get E-Book</a> </li>
    </ul>
   
<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>