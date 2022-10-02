<?php
	
	$departmentId = $_GET["department"];

	$institutionId = $_GET["institution"];

	require_once($page["rootPath"] . "scripts/php/connection.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
    	$departmentDetails = departmentDetails($departmentId);
 			
	$page["title"] = ("Select a course to study " . $departmentDetails["name"]);
	
	$action = $_GET["action"];
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>

  <div class="head-div"> <span style="display: flex; justify-content: center;
    height: 100%; align-items: center;"><?php echo $departmentDetails["name"]; ?></span></div>
   
<h3>Select a course title to view it`s materials</h3>
<h5>Notice: if you can't find the course you're looking for in our list, you can check further below the page at
  the "Materials Posted by Students" section, if it's been posted by a student or futher still send us an email at <?php echo $website["email"]["sender"]; ?>
  so we can include it.
</h5>



<?php
	
	$sql = "SELECT DISTINCT level FROM courses WHERE institution_id = '$institutionId' AND department_id = '$departmentId' ORDER BY level";
	
	if($result = mysqli_query($conn, $sql)) {
			
		while($row = mysqli_fetch_array($result)) {
				
			$eachLevel = $row["level"];
				
			echo '<h4>Courses for ' . $eachLevel . ' Level</h4>';
		
			echo '<ul>';
	
			foreach($website["content"]["courses"]["ids"] as $eachCourseId) {
				
				$courseDetails = courseDetails($eachCourseId);
				
				if($courseDetails["institutionId"] == $institutionId && $courseDetails["departmentId"] == $departmentId && $courseDetails["level"] == $eachLevel) {
				
					echo '<li> <a href="?department=' . $departmentId . '&action=' . $action . '&institution=' . $institutionId . '&course=' . $eachCourseId . '">' . $courseDetails["name"] . '</a> </li>';
				
				}
			
			}
			
			echo '</ul>';
	
		}
		
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