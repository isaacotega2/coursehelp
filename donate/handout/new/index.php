<?php
	
	$page = array("rootPath" => "../../../", "title" => "New - Donate material", "restriction" => array("account"), "buttonLine" => array("exists" => false), "footer" => array("exists" => false));
	
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/functions.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	$date = date("Y m d");
	
	$time = date("h:i");
		
	
	if(isset($_POST["course"])) {	
		
		$handoutId = randomDigits(20);
		
		$courseId = mysqli_real_escape_string($conn, $_POST["course"]);
		
		
		$courseDetails = courseDetails($courseId);
		
		
		$name = mysqli_real_escape_string($conn, $courseDetails["name"] . " handout");
		
		$institutionId = mysqli_real_escape_string($conn, $courseDetails["institutionId"]);
		
		$departmentId = mysqli_real_escape_string($conn, $courseDetails["departmentId"]);
		
		$level = mysqli_real_escape_string($conn, $courseDetails["level"]);
		
		$donatorUsercode = mysqli_real_escape_string($conn, $user["account"]["usercode"]);
		
		$sql = "INSERT INTO donated_handouts (handout_id, course_id, donator_usercode, name, institution_id, department_id, level, date_posted, time_posted) VALUES ('$handoutId', '$courseId', '$donatorUsercode', '$name', '$institutionId', '$departmentId', '$level', '$date', '$time') ";
		
		if(mysqli_query($conn, $sql)) {
		
			relocate("../edit?id=" . $handoutId);
			
		}
		
		die;
	
	}
	
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>

<style>

	.heading {
		font-size: 40px;
		padding: 1cm 0;
	
	}
	
	.formPage {
	}
	
	.formPage #content {
		max-height: 10cm;
		overflow-y: auto;
		background-color: rgba(0, 0, 0, 0.1);
	}
	
	.formPage #content .holder {
		display: block;
		margin: 3mm 0;
	}

	.formPage #content [type=radio] {
		height: 1cm;
		width: 1cm;
	}

	.formPage #content  label {
		font-size: 40px;
	}

	.formPage #searchInput {
		font-size: 34px;
		width: 94%;
		border-radius: 40px;
		height: 2cm;
		margin: 0 0 5mm 1%;
		padding: 0 2%;
		box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.5);
		transition: box-shadow font-size 0.3s;
	}

	.formPage #searchInput:focus {
		font-size: 36px;
		box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.5);
	}

	#submitButton {
		padding: 1cm 3cm;
		border-radius: 5px;
		font-size: 35px;
	}

	[disabled] {
		background-color: rgba(0, 0, 0, 0.1);
	}

</style>

<script src="<?php echo $page["rootPath"]; ?>scripts/js/donate/new.js"></script>

<form id="newDonationForm" method="post">

<div class="formPage">

	<h2 class="heading">Select a department</h2>
	
	<input id="searchInput" placeholder="Search departments" for="department">

	<div id="content">
	
		<?php
    	
    			foreach($website["content"]["departments"]["ids"] as $eachId) {
    			
    				$departmentDetails = departmentDetails($eachId);
    		
 				echo '<div class="holder"><input type="radio" name="department" id="chk' . $departmentDetails["name"] . '" value="' . $eachId . '" text="' . $departmentDetails["name"] . '"> <label for="chk' . $departmentDetails["name"] . '">' . $departmentDetails["name"] . '</label> </div>';
 			
 			}
 		
 		?>
 	
	</div>
	
</div>

<hr>

<div class="formPage">

	<h2 class="heading">Select an institution</h2>

	<input id="searchInput" placeholder="Search instititions" for="institution">

	<div id="content">
	
		<?php
    	
    			foreach($website["content"]["institutions"]["ids"] as $eachId) {
    			
    				$institutionDetails = institutionDetails($eachId);
    		
 				echo '<div class="holder"> <input type="radio" name="institution" id="chk' . $institutionDetails["name"] . '" value="' . $eachId . '" text="' . $institutionDetails["name"] . '"> <label for="chk' . $institutionDetails["name"] . '">' . $institutionDetails["name"] . '</label> </div>';
 			
 			}
 		
 		?>
 	
	</div>
	
</div>

<hr>

<div class="formPage" id="coursesHolder">

	<h2 class="heading">Select a course</h2>

	<div id="content"><div class="placeholder">No details given yet</div></div>
	
</div>


<div class="centerHolder">
	
	<a href="../new">

		<button id="submitButton" type="submit" disabled="true">Submit</button>
		
	</a>
	
</div>



</form>
		
<hr>



<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>