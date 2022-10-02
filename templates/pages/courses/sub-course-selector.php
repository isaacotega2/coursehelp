<?php
	
	$mainCourseId = $_GET["id"];

	include_once($page["rootPath"] . "scripts/php/methods.php");
	
    	$mainCourseDetails = mainCourseDetails($mainCourseId);
 			
	$page["title"] = ("Choose an action to study " . $mainCourseDetails["name"]);
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>

  <div class="head-div"> <span style="display: flex; justify-content: center;
    height: 100%; align-items: center;"><?php echo $mainCourseDetails["name"]; ?></span></div>
   
<h3>Select a course title to view it`s materials</h3>
<h5>Notice: if you can't find the course you're looking for in our list, you can check further below the page at
  the "Materials Posted by Students" section, if it's been posted by a student or futher still send us an email at coursehelpforum@gmail.com
  so we can include it.
</h5>


<?php
	
	if($mainCourseDetails["levelType"] == "level") {
		
		$levels = array("100", "200", "300", "400");
	
	}
	
	else if($mainCourseDetails["levelType"] == "diploma") {
	
		$levels = array("ND1", "ND2", "HND1", "HND2");
	
	}
	
	else {}
	
	foreach($levels as $eachLevel) {
		
		echo '<h4>Courses for ' . $eachLevel . ' Level</h4>';
		
		echo '<ul>';
	
		foreach($mainCourseDetails["subCourses"]["ids"] as $eachId) {
	
			$subCourseDetails = subCourseDetails($eachId);
			
			if($subCourseDetails["level"] == $eachLevel) {
			
				echo '<li> <a href="?id=' . $mainCourseId . '&action=handouts&sub-course=' . $eachId . '">' . $subCourseDetails["name"] . '</a> </li>';
				
			}
	
		}
	
		echo '</ul>';
	
	}
	
?>

<!--

<h4> Materials Posted by Students</h4>
<h5> Notice: Students can upload materials/handout on the website and earn 60% from the sales of that material/handouts

  <br> Click <a href="#">Here</a> to read more about it</h5>
  <ul>
    <li> <a href="#"> History of Geography (Posted by Sarah43 from University of Benin)</a> </li>
    <li> <a href="#"> </a> </li>
    <li> <a href="#"> </a> </li>
  </ul>
  -->
  
<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>