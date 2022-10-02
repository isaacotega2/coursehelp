<?php
	
	$page = array("rootPath" => "../../", "restriction" => array("account"));
	
	
	include_once($page["rootPath"] . "scripts/php/access-restrictor.php");
		
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	require_once($page["rootPath"] . "scripts/php/connection.php");
	
	$request = $_POST["request"];
	
	
	if($request == "getCourses") {
	
		$department = mysqli_real_escape_string($conn, $_POST["department"]);
	
		$institution = mysqli_real_escape_string($conn, $_POST["institution"]);
	
		$sql = "SELECT * FROM courses WHERE department_id = '$department' AND institution_id = '$institution' ";
		
		if($result = mysqli_query($conn, $sql)) {
			
			$courses = array();
			
			while($row = mysqli_fetch_array($result)) {
			
				$courses[] = courseDetails($row["course_id"]);
			
			}
		
			$data = array("status" => "success", "courses" => $courses);
			
			echo json_encode($data);
		
		}
	
	}
	
	
	if($request == "loadMessages") {
	
		$chatId = mysqli_real_escape_string($conn, $_POST["chatId"]);
		
		$messages = array();
	
		foreach(dialogueDetails($chatId)["messages"]["ids"] as $eachId) {
		
			$messages[] = messageDetails($eachId);
		
		}
		
	
			$data = array("status" => "success", "messages" => $messages);
			
			echo json_encode($data);
		
		
	
	}
	
	if($request == "uploadPage") {
		
		$handoutId = $_POST["handoutId"];
		
		$page = $_POST["page"];
		
		$image = $_FILES["image"];
		
		$imagePath = ("../../images/handouts/" . $handoutId . "_" . $page . ".jpg");
		
		if(move_uploaded_file($image["tmp_name"], $imagePath)) {
	
			echo json_encode(array("status" => "success"));
			
		}
	
	}
	
 ?>