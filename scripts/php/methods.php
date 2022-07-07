<?php
	
	require_once("connection.php");
	
	require_once("general-info.php");
	
	function accountDetails($usercode) {
		
		global $conn, $page, $website;
		
		$sql = "SELECT * FROM accounts WHERE usercode = '$usercode' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$accountDetails = array();
			
			$accountDetails["is"] = array();
			
			$accountDetails["usercode"] = $row["usercode"];
		
			$accountDetails["fullName"] = $row["full_name"];
		
			$accountDetails["gender"] = $row["gender"];
		
			$accountDetails["emailAddress"] = $row["email_address"];
		
			$accountDetails["password"] = $row["password"];
		
			$accountDetails["institution"] = $row["institution"];
		
			$accountDetails["course"] = $row["course"];
		
			$accountDetails["level"] = $row["level"];
		
			$accountDetails["usercode"] = $row["usercode"];
		
			$accountDetails["cookieCode"] = $row["cookie_code"];
		
			$accountDetails["date_registered"] = $row["date_registered"];
		
			$accountDetails["time_registered"] = $row["time_registered"];
			
			
			if(isset($_COOKIE[$website["cookies"]["admin"]["name"]])) {
			
				$accountDetails["is"]["websiteAdmin"] = true;
			
			}
			
			else {
			
				$accountDetails["is"]["websiteAdmin"] = false;
			
			}
			
			return $accountDetails;
	
		}
		
	}
	 
	
	function forumDetails($forumId) {
		
		global $conn, $page;
		
		$sql = "SELECT * FROM forums WHERE forum_id = '$forumId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$forumDetails = array();
			
			$forumDetails["forumId"] = $row["forum_id"];
		
			$forumDetails["name"] = $row["name"];
		
			$forumDetails["creatorUsercode"] = $row["creator_usercode"];
		
			$forumDetails["folder"] = $row["folder"];
		
			$forumDetails["pageUri"] = ("forum/" . $forumDetails["folder"]);
		
			$forumDetails["dateCreated"] = $row["date_created"];
		
			$forumDetails["timeCreated"] = $row["time_created"];
		
			$forumDetails["list"] = array();
					
			$sql = "SELECT * FROM topics WHERE forum_id = '$forumId' ";
		
			if($result = mysqli_query($conn, $sql)) {
			
				$forumDetails["list"]["topics"] = array();
					
				while($row = mysqli_fetch_array($result)) {
					
					$forumDetails["list"]["topics"][] = $row["topic_id"];
					
				}
			
			}
		
			return $forumDetails;
	
		}
		
	}
	
	function topicDetails($topicId) {
		
		global $conn, $page;
		
		$sql = "SELECT * FROM topics WHERE topic_id = '$topicId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$topicDetails = array();
			
			$topicDetails["topicId"] = $row["topic_id"];
		
			$topicDetails["forumId"] = $row["forum_id"];
		
			$topicDetails["posterUsercode"] = $row["poster_usercode"];
		
			$topicDetails["title"] = $row["title"];
		
			$topicDetails["body"] = $row["body"];
		
			$topicDetails["datePosted"] = $row["date_posted"];
		
			$topicDetails["timePosted"] = $row["time_posted"];
		
			$topicDetails["list"] = array();
			
			$sql = "SELECT * FROM comments WHERE topic_id = '" . $topicDetails["topicId"] . "' ORDER BY date_posted, time_posted ";
					
			if($result = mysqli_query($conn, $sql)) {
				
				$topicDetails["list"]["comments"]["ids"] = array();
		
				while($row = mysqli_fetch_array($result)) {
				
					$topicDetails["list"]["comments"]["ids"][] = $row["comment_id"];
				
				}
			
			}
			
			return $topicDetails;
	
		}
		
	}
	
	function commentDetails($commentId) {
		
		global $conn, $page;
		
		$sql = "SELECT * FROM comments WHERE comment_id = '$commentId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$commentDetails = array();
			
			$commentDetails["commentId"] = $row["comment_id"];
		
			$commentDetails["commenterUsercode"] = $row["commenter_usercode"];
		
			$commentDetails["topicId"] = $row["topic_id"];
		
			$commentDetails["comment"] = $row["comment"];
		
			$commentDetails["datePosted"] = $row["date_posted"];
		
			$commentDetails["timePosted"] = $row["time_posted"];
		
			$commentDetails["list"] = array();
			
			return $commentDetails;
	
		}
		
	}
	 
	
	function mainCourseDetails($courseId) {
		
		global $conn, $page;
		
		$sql = "SELECT * FROM main_courses WHERE course_id = '$courseId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$mainCourseDetails = array();
			
			$mainCourseDetails["courseId"] = $row["course_id"];
		
			$mainCourseDetails["name"] = $row["name"];
		
			$mainCourseDetails["levelType"] = $row["level_type"];
		
			$mainCourseDetails["subCourses"] = array("ids" => array(), "levels" => array() );
		
			$sql = "SELECT * FROM sub_courses WHERE main_course_id = '$courseId' ";
			
			if($result = mysqli_query($conn, $sql)) {
		
				while($row = mysqli_fetch_array($result)) {
			
					$mainCourseDetails["subCourses"]["ids"][] = $row["sub_course_id"];
					
				}
				
			}
	
		}
		
		return $mainCourseDetails;
	
	}
	
	
	function subCourseDetails($subCourseId) {
		
		global $conn, $page;
		
		$sql = "SELECT * FROM sub_courses WHERE sub_course_id = '$subCourseId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$subCourseDetails = array();
			
			$subCourseDetails["subCourseId"] = $row["sub_course_id"];
		
			$subCourseDetails["mainCourseId"] = $row["main_course_id"];
		
			$subCourseDetails["name"] = $row["name"];
		
			$subCourseDetails["level"] = $row["level"];
		
			$subCourseDetails["pagesNumber"] = $row["pages_number"];
		
			$subCourseDetails["institution"] = $row["institution"];
		
			$subCourseDetails["department"] = $row["department"];
		
			$subCourseDetails["datePosted"] = $row["date_posted"];
		
			$subCourseDetails["timePosted"] = $row["time_posted"];
		
		

		}
		
		return $subCourseDetails;
	
	}
	
	function institutionDetails($institutionId) {
		
		global $conn, $page, $website;
		
		$sql = "SELECT * FROM institutions WHERE institution_id = '$institutionId' ";
		
		if($result = mysqli_query($conn, $sql)) {
		
			$row = mysqli_fetch_array($result);
			
			$institutionDetails = array();
			
			$accountDetails["is"] = array();
			
			$institutionDetails["institutionId"] = $row["institution_id"];
		
			$institutionDetails["name"] = $row["name"];
		
			$institutionDetails["type"] = $row["type"];
		
		}
		
		return $institutionDetails;
	
	}
	
/*
	function icon($name, $type = "svg") {
		
		global $page;
	
		switch($type) {
		
			case "svg" :
			
				return file_get_contents($page["rootPath"] . "icons/" . $name . ".svg");
				
				break;
				
			case "image" :
			
				return file_get_contents($page["rootPath"] . "icons/" . $name . ".jpg");
				
				break;
				
			default :
			
				return file_get_contents($page["rootPath"] . "icons/" . $name . ".svg");
				
				
		}
	
	}
	*/
	function randomDigits($length) {
	
		$digits = "";						
						
		for($i = 0; $i < $length; $i++) {
						
			$digits .= rand(0, 9);
						
		}
		
		return $digits;
		
	}
					
 ?>