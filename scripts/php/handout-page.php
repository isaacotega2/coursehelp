<?php
	
	session_start();
	
	isset($_SESSION["showHandout"]) or die();
	
	($_SESSION["showHandout"] == "true") or die();
	
	$subCourseId = $_GET["sub-course-id"];
	
	$page = $_GET["page"];
	
	$originalImage = "../../images/handouts/" . $subCourseId . "_" . $page . ".jpg";
	
	$emptyImage = "../../images/empty-image.jpg";
	
	if(file_exists($originalImage)) {
	
		$image = $originalImage;
	
	}
	
	else {
	
		$image = $emptyImage;
	
	}
	
	
	header("Content-type: image/JPG");
	
	readfile($image);
	
	exit;
	
 ?>