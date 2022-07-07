<?php
	
	$page = array("rootPath"  => "../../");
	
	require_once($page["rootPath"] . "scripts/php/connection.php");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	$request = $_POST["request"];
	
	$date = date("Y m d");
	
	$time = date("h:i");
		
	
	if($request == "getHandouts") {
		
		$handouts = array();
		
		foreach($website["content"]["mainCourses"]["ids"] as $mainCourseId) {
		
			foreach(mainCourseDetails($mainCourseId)["subCourses"]["ids"] as $subCourseId) {
				
				$eachHandout = subCourseDetails($subCourseId);
				
				$eachHandout["course"] = mainCourseDetails($mainCourseId)["name"];
		
				$handouts[] = $eachHandout;
				
			}
		
		}
	
		echo json_encode($handouts);
	
	}
	
	
	if($request == "newHandout") {
		
		$handoutDetails = $_POST["handoutDetails"];
		
		$subCourseId = randomDigits(20);
		
		$mainCourseId = mysqli_real_escape_string($conn, $handoutDetails["mainCourseId"]);
		
		$name = mysqli_real_escape_string($conn, $handoutDetails["subCourse"]);
		
		$level = mysqli_real_escape_string($conn, $handoutDetails["level"]);
		
		$pagesNumber = mysqli_real_escape_string($conn, $handoutDetails["pagesNumber"]);
		
		$institution = mysqli_real_escape_string($conn, $handoutDetails["institution"]);
		
		$department = mysqli_real_escape_string($conn, $handoutDetails["department"]);
		
		$sql = "INSERT INTO sub_courses (sub_course_id, main_course_id, name, level, pages_number, institution, department, date_posted, time_posted) VALUES ('$subCourseId', '$mainCourseId', '$name', '$level', '$pagesNumber', '$institution', '$department', '$date', '$time') ";
		
		if(mysqli_query($conn, $sql)) {
		
			echo json_encode(array("status" => "success", "subCourseId" => $subCourseId));
			
		}
		
	}
	
	if($request == "getSubCourseDetails") {
		
		$subCourseId = $_POST["subCourseId"];
		
		$subCourseDetails = subCourseDetails($subCourseId);
	
		$mainCourseDetails = mainCourseDetails($subCourseDetails["mainCourseId"]);
		
		$subCourseDetails["mainCourseDetails"] = $mainCourseDetails;
	
		echo json_encode($subCourseDetails);
	
	}
	
	
	if($request == "changeHandoutImage") {
		
		$subCourseId = $_POST["subCourseId"];
		
		$page = $_POST["page"];
		
		$image = $_FILES["image"];
		
		$imagePath = ("../../images/handouts/" . $subCourseId . "_" . $page . ".jpg");
		
		if(move_uploaded_file($image["tmp_name"], $imagePath)) {
	
			echo json_encode(array("status" => "success", "subCourseId" => $subCourseId));
			
		}
	
	}
	
	
 ?>