<?php
	
	$page = array("rootPath"  => "../../");
	
	require_once($page["rootPath"] . "scripts/php/connection.php");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	$request = $_POST["request"];
	
	$date = date("Y m d");
	
	$time = date("h:i");
		
		
		
	
	if($request == "approveAndSaveHandout") {
		
		$handoutId = $_POST["handoutId"];
		
		$handoutDetails = donatedHandoutDetails($handoutId);
		
		$courseId = mysqli_real_escape_string($conn, $handoutDetails["courseId"]);
		
		$name = mysqli_real_escape_string($conn, $handoutDetails["name"]);
		
		$pagesNumber = mysqli_real_escape_string($conn, $handoutDetails["pagesNumber"]);
		
			$sql = "UPDATE donated_handouts SET status = 'approved' WHERE handout_id = '$handoutId' ";
			
			mysqli_query($conn, $sql);
		
			$sql = "INSERT INTO official_handouts (handout_id, course_id, name, pages_number, date_posted, time_posted, date_updated, time_updated) VALUES ('$handoutId', '$courseId', '$name', '$pagesNumber', '$date', '$time', '$date', '$time') ";
			
			if(mysqli_query($conn, $sql)) {
		
				echo json_encode(array("status" => "success"));
				
			}
		
	}
	
	if($request == "rejectHandout") {
		
		$handoutId = $_POST["handoutId"];
		
			$sql = "UPDATE donated_handouts SET status = 'rejected' WHERE handout_id = '$handoutId' ";
			
			if(mysqli_query($conn, $sql)) {
		
				echo json_encode(array("status" => "success"));
				
			}
		
	}
	
	if($request == "deleteDepartment") {
		
		$departmentId = $_POST["departmentId"];
		
		$sql = "DELETE FROM departments WHERE department_id = '$departmentId' ";
		
		if(mysqli_query($conn, $sql)) {
		
			echo json_encode(array("status" => "success", "departmentId" => $departmentId));
			
		}
		
	}
	
	if($request == "deleteSubscription") {
		
		$subscriptionId = $_POST["subscriptionId"];
		
		$sql = "DELETE FROM subscriptions WHERE subscription_id = '$subscriptionId' ";
		
		if(mysqli_query($conn, $sql)) {
		
			echo json_encode(array("status" => "success", "subscriptionId" => $subscriptionId));
			
		}
		
	}
	
	if($request == "activateSubscription") {
		
		$subscriptionId = $_POST["subscriptionId"];
		
		$sql = "SELECT active FROM subscriptions WHERE subscription_id = '$subscriptionId' ";
		
		if($result = mysqli_query($conn, $sql)) {
			
			$row = mysqli_fetch_array($result);
			
			if($row["active"] == "true") {
				
				$activeStatus = "false";
			
			}
			
			else {
			
				$activeStatus = "true";
			
			}
			
			$sql = "UPDATE subscriptions SET active = '$activeStatus' WHERE subscription_id = '$subscriptionId' ";
			
			if(mysqli_query($conn, $sql)) {
		
				echo json_encode(array("status" => "success", "active" => $activeStatus));
				
			}
			
		}
		
	}
	
	if($request == "getDonatedHandouts") {
		
		$handouts = array();
			
		foreach($website["content"]["donations"]["handouts"]["ids"] as $eachId) {
			
			$eachHandoutDetails = donatedHandoutDetails($eachId);
			
			$eachHandoutDetails["institution"] = institutionDetails($eachHandoutDetails["institutionId"]);
			
			$eachHandoutDetails["department"] = departmentDetails($eachHandoutDetails["departmentId"]);
			
			$eachHandoutDetails["course"] = courseDetails($eachHandoutDetails["courseId"]);
			
			$eachHandoutDetails["donator"] = accountDetails($eachHandoutDetails["donatorUsercode"]);
			
			$handouts[] = $eachHandoutDetails;
			
		}
		
		echo json_encode($handouts);
	
	}
	
	if($request == "getOfficialHandoutSubscriptions") {
		
		$subscriptions = array();
			
		foreach($website["content"]["subscriptions"]["ids"] as $eachId) {
			
			$eachSubscriptionDetails = subscriptionDetails($eachId);
			
			if($eachSubscriptionDetails["type"] == "official_handout") {
				
				$eachSubscriptionDetails["handout"] = officialHandoutDetails($eachSubscriptionDetails["productId"]);
			
				$eachSubscriptionDetails["subscriber"] = accountDetails($eachSubscriptionDetails["subscriberUsercode"]);
			
				$subscriptions[] = $eachSubscriptionDetails;
				
			}
			
		}
		
		echo json_encode($subscriptions);
	
	}
	
	if($request == "getOfficialHandoutSubscriptionDetails") {
		
		$subscriptionId = $_POST["subscriptionId"];
		
		$subscriptionDetails = subscriptionDetails($subscriptionId);
			
		$subscriptionDetails["handout"] = officialHandoutDetails($subscriptionDetails["productId"]);
			
		$subscriptionDetails["subscriber"] = accountDetails($subscriptionDetails["subscriberUsercode"]);
		
		$subscriptionDetails["course"] = courseDetails($subscriptionDetails["handout"]["courseId"]);
		
		$subscriptionDetails["institution"] = institutionDetails($subscriptionDetails["course"]["institutionId"]);
		
		$subscriptionDetails["department"] = departmentDetails($subscriptionDetails["course"]["departmentId"]);
		
		echo json_encode($subscriptionDetails);
	
	}
	
	
	if($request == "fetchOfficialHandouts") {
		
		$handouts = array();
		
		$institutionId = $_POST["handoutDetails"]["institutionId"];
		
		$departmentId = $_POST["handoutDetails"]["departmentId"];
		
		$level = $_POST["handoutDetails"]["level"];
		
		foreach($website["content"]["courses"]["ids"] as $courseId) {
			
			$eachCourseDetails = courseDetails($courseId);
			
			if($eachCourseDetails["institutionId"] == $institutionId && $eachCourseDetails["departmentId"] == $departmentId && $eachCourseDetails["level"] == $level) {
		
			foreach(courseDetails($courseId)["handouts"]["ids"] as $handoutId) {
				
				$eachHandout = officialHandoutDetails($handoutId);
				
				$eachHandout["courseDetails"] = $eachCourseDetails;
				
				$handouts[] = $eachHandout;
				
			}
			
			}
		
		}
	
		echo json_encode(array("status" => "success", "handouts" => $handouts));
			
	}
	if($request == "newOfficialHandout") {
		
		$handoutDetails = $_POST["handoutDetails"];
		
		$handoutId = randomDigits(20);
		
		$courseId = mysqli_real_escape_string($conn, $handoutDetails["courseId"]);
		
		$name = mysqli_real_escape_string($conn, $handoutDetails["name"]);
		
		$pagesNumber = mysqli_real_escape_string($conn, $handoutDetails["pagesNumber"]);
		
		$sql = "INSERT INTO official_handouts (handout_id, course_id, name, pages_number, date_posted, time_posted, date_updated, time_updated) VALUES ('$handoutId', '$courseId', '$name', '$pagesNumber', '$date', '$time', '$date', '$time') ";
		
		if(mysqli_query($conn, $sql)) {
		
			echo json_encode(array("status" => "success", "handoutId" => $handoutId));
			
		}
		
	}
	
	
	if($request == "newInstitution") {
		
		$institutionDetails = $_POST["institutionDetails"];
		
		$institutionId = randomDigits(20);
		
		$name = mysqli_real_escape_string($conn, $institutionDetails["name"]);
		
		$type = mysqli_real_escape_string($conn, $institutionDetails["type"]);
		
		$sql = "INSERT INTO institutions (institution_id, name, type) VALUES ('$institutionId', '$name', '$type') ";
		
		if(mysqli_query($conn, $sql)) {
		
			echo json_encode(array("status" => "success", "institutionId" => $institutionId));
			
		}
		
	}
	
	
	if($request == "editInstitution") {
		
		$institutionDetails = $_POST["institutionDetails"];
		
		$institutionId = $institutionDetails["institutionId"];
		
		$name = mysqli_real_escape_string($conn, $institutionDetails["name"]);
		
		$type = mysqli_real_escape_string($conn, $institutionDetails["type"]);
		
		$sql = "UPDATE institutions SET name = '$name', type = '$type' WHERE institution_id = '$institutionId' ";
		
		if(mysqli_query($conn, $sql)) {
		
			echo json_encode(array("status" => "success", "institutionId" => $institutionId));
			
		}
		
	}
	
	if($request == "editFunnyWierdQuestion") {
		
		$questionDetails = $_POST["questionDetails"];
		
		$questionId = $questionDetails["questionId"];
		
		$question = mysqli_real_escape_string($conn, $questionDetails["question"]);
		
		$sql = "UPDATE funny_wierd_questions SET question = '$question' WHERE question_id = '$questionId' ";
		
		if(mysqli_query($conn, $sql)) {
		
			echo json_encode(array("status" => "success", "questionId" => $questionId));
			
		}
		
	}
	
	if($request == "editDepartment") {
		
		$departmentDetails = $_POST["departmentDetails"];
		
		$departmentId = $departmentDetails["departmentId"];
		
		$name = mysqli_real_escape_string($conn, $departmentDetails["name"]);
		
		$sql = "UPDATE departments SET name = '$name' WHERE department_id = '$departmentId' ";
		
		if(mysqli_query($conn, $sql)) {
		
			echo json_encode(array("status" => "success", "departmentId" => $departmentId));
			
		}
		
	}
	
	
	if($request == "deleteInstitution") {
		
		$institutionId = $_POST["institutionId"];
		
		$sql = "DELETE FROM institutions WHERE institution_id = '$institutionId' ";
		
		if(mysqli_query($conn, $sql)) {
		
			echo json_encode(array("status" => "success", "institutionId" => $institutionId));
			
		}
		
	}
	
	
	if($request == "getCourseDetails") {
		
		$courseId = $_POST["courseId"];
		
		$courseDetails =  courseDetails($courseId);
	
		$departmentDetails = departmentDetails($courseDetails["departmentId"]);
		
		$courseDetails["department"] = $departmentDetails;
	
		$institutionDetails = institutionDetails($courseDetails["institutionId"]);
		
		$courseDetails["institution"] = $institutionDetails;
	
		$handoutDetails = array();
		
		foreach($courseDetails["handouts"]["ids"] as $eachId) {
			
			$eachHandoutDetails = officialHandoutDetails($eachId);
			
			$handoutDetails[] = $eachHandoutDetails;
			
		}
		
		$courseDetails["handoutDetails"] = $handoutDetails;
	
		echo json_encode($courseDetails);
	
	}
	
	
	if($request == "getFunnyWierdQuestionDetails") {
		
		$questionId = $_POST["questionId"];
		
		$questionDetails =  funnyWierdQuestionDetails($questionId);
	
		echo json_encode($questionDetails);
	
	}
	
	
	if($request == "getOfficialHandoutDetails") {
		
		$handoutId = $_POST["handoutId"];
		
		$officialHandoutDetails =  officialHandoutDetails($handoutId);
	
		$courseDetails = courseDetails($officialHandoutDetails["courseId"]);
		
		$officialHandoutDetails["course"] = $courseDetails;
	
		$departmentDetails = departmentDetails($courseDetails["departmentId"]);
		
		$officialHandoutDetails["department"] = $departmentDetails;
	
		$institutionDetails = institutionDetails($courseDetails["institutionId"]);
		
		$officialHandoutDetails["institution"] = $institutionDetails;
	
		echo json_encode($officialHandoutDetails);
	
	}
	
	
	if($request == "getDonatedHandoutDetails") {
		
		$handoutId = $_POST["handoutId"];
		
		$donatedHandoutDetails =  donatedHandoutDetails($handoutId);
	
		$courseDetails = courseDetails($donatedHandoutDetails["courseId"]);
		
		$donatedHandoutDetails["course"] = $courseDetails;
	
		$departmentDetails = departmentDetails($courseDetails["departmentId"]);
		
		$donatedHandoutDetails["department"] = $departmentDetails;
	
		$institutionDetails = institutionDetails($courseDetails["institutionId"]);
		
		$donatedHandoutDetails["institution"] = $institutionDetails;
	
		$donatedHandoutDetails["donator"] = accountDetails($donatedHandoutDetails["donatorUsercode"]);
			
		echo json_encode($donatedHandoutDetails);
	
	}
	
	if($request == "getDepartmentDetails") {
		
		$departmentId = $_POST["departmentId"];
		
		$departmentDetails = departmentDetails($departmentId);
	
		echo json_encode($departmentDetails);
	
	}
	
	if($request == "getInstitutionDetails") {
		
		$institutionId = $_POST["institutionId"];
		
		$institutionDetails = institutionDetails($institutionId);
	
		echo json_encode($institutionDetails);
	
	}
	
	if($request == "getForumDetails") {
		
		$forumId = $_POST["forumId"];
		
		$forumDetails = forumDetails($forumId);
		
		$forumDetails["membersDetails"] = array();
	
		foreach($forumDetails["members"]["usercodes"] as $eachUsercode) {
		
			$forumDetails["membersDetails"][] = forumMembersDetails($eachUsercode);
	
			$forumDetails["membersAccountDetails"][] = accountDetails($eachUsercode);
	
		}
		
		echo json_encode($forumDetails);
	
	}
	
	
	
	if($request == "changeHandoutImage") {
		
		$handoutId = $_POST["handoutId"];
		
		$page = $_POST["page"];
		
		$image = $_FILES["image"];
		
		$imagePath = ("../../images/handouts/" . $handoutId . "_" . $page . ".jpg");
		
		if(move_uploaded_file($image["tmp_name"], $imagePath)) {
	
			echo json_encode(array("status" => "success"));
			
		}
	
	}
	
	
	if($request == "getDepartments") {
		
		$departments = array();
		
		foreach($website["content"]["departments"]["ids"] as $departmentId) {
			
			$eachDepartment = departmentDetails($departmentId);
			
			$departments[] = $eachDepartment;
		
		}
	
		echo json_encode($departments);
	
	}
	
	
	if($request == "getFunnyWierdQuestions") {
		
		$questions = array();
		
		foreach($website["content"]["funnyWierdQuestions"]["ids"] as $questionId) {
			
			$eachQuestion = funnyWierdQuestionDetails($questionId);
			
			$questions[] = $eachQuestion;
		
		}
	
		echo json_encode($questions);
	
	}
	
	
	if($request == "getInstitutions") {
		
		$institutions = array();
		
		foreach($website["content"]["institutions"]["ids"] as $institutionId) {
			
			$eachInstitution = institutionDetails($institutionId);
			
			$institutions[] = $eachInstitution;
		
		}
	
		echo json_encode($institutions);
	
	}
	
	
	if($request == "getForums") {
		
		$forums = array();
		
		foreach($website["content"]["forums"]["ids"] as $forumId) {
			
			$eachForum = forumDetails($forumId);
			
			$forums[] = $eachForum;
		
		}
	
		echo json_encode($forums);
	
	}
	
	
	if($request == "getCourses") {
		
		$courses = array();
		
		foreach($website["content"]["courses"]["ids"] as $courseId) {
			
			$eachCourse = courseDetails($courseId);
			
			$eachCourse["department"] = departmentDetails($eachCourse["departmentId"]);
			
			$eachCourse["institution"] = institutionDetails($eachCourse["institutionId"]);
			
			$courses[] = $eachCourse;
		
		}
	
		echo json_encode($courses);
	
	}
	
	
	
	
	if($request == "newCourse") {
		
		$courseDetails = $_POST["courseDetails"];
		
		$courseId = randomDigits(20);
		
		$name = mysqli_real_escape_string($conn, $courseDetails["name"]);
		
		$institutionId = mysqli_real_escape_string($conn, $courseDetails["institutionId"]);
		
		$departmentId = mysqli_real_escape_string($conn, $courseDetails["departmentId"]);
		
		$level = mysqli_real_escape_string($conn, $courseDetails["level"]);
		
		$sql = "INSERT INTO courses (course_id, name, institution_id, department_id, level, date_posted, time_posted) VALUES ('$courseId', '$name', '$institutionId', '$departmentId', '$level', '$date', '$time') ";
		
		if(mysqli_query($conn, $sql)) {
		
			echo json_encode(array("status" => "success", "courseId" => $courseId));
			
		}
		
	}
	
	if($request == "newDepartment") {
		
		$departmentDetails = $_POST["departmentDetails"];
		
		$departmentId = randomDigits(20);
		
		$name = mysqli_real_escape_string($conn, $departmentDetails["name"]);
		
		$sql = "INSERT INTO departments (department_id, name) VALUES ('$departmentId', '$name') ";
		
		if(mysqli_query($conn, $sql)) {
		
			echo json_encode(array("status" => "success", "departmentId" => $departmentId));
			
		}
		
	}
	
	if($request == "newFunnyWierdQuestion") {
		
		$questionDetails = $_POST["questionDetails"];
		
		$questionId = randomDigits(20);
		
		$question = mysqli_real_escape_string($conn, $questionDetails["question"]);
		
		$sql = "INSERT INTO funny_wierd_questions (question_id, question, date_posted, time_posted) VALUES ('$questionId', '$question', '$date', '$time') ";
		
		if(mysqli_query($conn, $sql)) {
		
			echo json_encode(array("status" => "success", "questionId" => $questionId));
			
		}
		
	}
	
	if($request == "newSubscription") {
		
		$subscriptionDetails = $_POST["subscriptionDetails"];
		
		$subscriptionId = randomDigits(20);
		
		$subscriberUsercode = mysqli_real_escape_string($conn, $subscriptionDetails["subscriberUsercode"]);
		
		$type = mysqli_real_escape_string($conn, $subscriptionDetails["type"]);
		
		$productId = mysqli_real_escape_string($conn, $subscriptionDetails["productId"]);
		
		$duration = mysqli_real_escape_string($conn, $subscriptionDetails["duration"]);
		
		$sql = "INSERT INTO subscriptions (subscription_id, subscriber_usercode, type, product_id, duration, date_subscribed, time_subscribed) VALUES ('$subscriptionId', '$subscriberUsercode', '$type', '$productId', '$duration', '$date', '$time') ";
		
		if(mysqli_query($conn, $sql)) {
		
			echo json_encode(array("status" => "success", "subscriptionId" => $subscriptionId));
			
		}
		
	}
	
	
	if($request == "newForum") {
		
		$forumDetails = $_POST["forumDetails"];
		
		$forumId = randomDigits(20);
		
		$name = mysqli_real_escape_string($conn, $forumDetails["name"]);
		
		$usercode = mysqli_real_escape_string($conn, $user["account"]["usercode"]);
		
		$items = array("  ", " ");
		
		$replacements = array("-", "-");
		
		$folder = trim( strtolower( urlencode( str_replace($items, $replacements, $name) ) ) );
		
		$sql = "INSERT INTO forums (forum_id, name, creator_usercode, folder, date_created, time_created) VALUES ('$forumId', '$name', '$usercode', '$folder', '$date', '$time') ";
		
		if(mysqli_query($conn, $sql)) {
			
			$sql = "INSERT INTO forum_members (forum_id, member_usercode, admin, date_joined, time_joined) VALUES ('$forumId', '$usercode', 'true', '$date', '$time') ";
			
			mysqli_query($conn, $sql);
		
			$blueprintFile = ($page["rootPath"] . "templates/page-blueprints/forum.php");
			
			$folderPath = ($page["rootPath"] . "forum/" . $folder);
			
			$fileContent = str_replace("[forumId]", $forumId, file_get_contents($blueprintFile));
			
			mkdir($folderPath);
			
			file_put_contents($folderPath . "/index.php", $fileContent);
				
			echo json_encode(array("status" => "success", "forumId" => $forumId));
			
		}
		
	}
	
	if($request == "editForum") {
		
		$forumDetails = $_POST["forumDetails"];
		
		$forumId = $forumDetails["forumId"];
		
		$name = mysqli_real_escape_string($conn, $forumDetails["name"]);
		
		$usercode = mysqli_real_escape_string($conn, $user["account"]["usercode"]);
		
		$previousFolderPath = ($page["rootPath"] . "forum/" . forumDetails($forumId)["folder"]);
			
		$items = array("  ", " ");
		
		$replacements = array("-", "-");
		
		$folder = trim( strtolower( urlencode( str_replace($items, $replacements, $name) ) ) );
		
		$sql = "UPDATE forums SET name = '$name', folder = '$folder' WHERE forum_id = '$forumId' ";
		
		if(mysqli_query($conn, $sql)) {
		
			
			$blueprintFile = ($page["rootPath"] . "templates/page-blueprints/forum.php");
			
			$folderPath = ($page["rootPath"] . "forum/" . $folder);
			
			
			if(file_exists($previousFolderPath)) {
			
				unlink($previousFolderPath . "/index.php");
			
				rmdir($previousFolderPath);
				
			}
		
				
			$fileContent = str_replace("[forumId]", $forumId, file_get_contents($blueprintFile));
			
			mkdir($folderPath);
			
			file_put_contents($folderPath . "/index.php", $fileContent);
				
			echo json_encode(array("status" => "success", "forumId" => $forumId));
			
		}
		
	}
	
	if($request == "deleteForum") {
		
		$forumId = $_POST["forumId"];
		
		$folderPath = ($page["rootPath"] . "forum/" . forumDetails($forumId)["folder"]);
			
		$sql = "DELETE FROM forums WHERE forum_id = '$forumId' ";
		
		if(mysqli_query($conn, $sql)) {
		
			$sql = "DELETE FROM forum_members WHERE forum_id = '$forumId' ";
		
			mysqli_query($conn, $sql);
		
			if(file_exists($folderPath)) {
			
				unlink($folderPath . "/index.php");
			
				rmdir($folderPath);
				
			}
		
			echo json_encode(array("status" => "success", "forumId" => $forumId));
			
		}
		
	}
	
	if($request == "deleteFunnyWierdQuestion") {
		
		$questionId = $_POST["questionId"];
		
		$sql = "DELETE FROM funny_wierd_questions WHERE question_id = '$questionId' ";
		
		if(mysqli_query($conn, $sql)) {
		
			echo json_encode(array("status" => "success", "questionId" => $questionId));
			
		}
		
	}
	
 ?>