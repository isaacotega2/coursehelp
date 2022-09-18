<?php
	
	session_start();
	
	
	$page = array("rootPath" => "../", "restriction" => array("account"));
	
	
	include_once($page["rootPath"] . "scripts/php/access-restrictor.php");
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	/*
	isset($_SESSION["showHandout"]) or die();
	
	($_SESSION["showHandout"] == "true") or die();
	*/
	
	
	$handoutId = $_GET["id"];
	
	$page = $_GET["page"];
	
	
	// I place that @ to prevent illegal string offset error originating from the accountDetails method in the methods.php file in the profile picture area which I cannot debug
	
  	 $accountDetails = @accountDetails($user["account"]["usercode"]);
  	  	
  	 $handoutDetails = officialHandoutDetails($handoutId);
    	
    	if(in_array($handoutDetails["handoutId"], $accountDetails["subscriptions"]["handout"]["active"]["ids"])) {
     	
     	$limit = $handoutDetails["pagesNumber"];
     	
    	}
     	
    	else {
     	
     	$limit = $website["constants"]["unsubscribedHandoutViewLimit"];
     	
    	}
     		
	
	$originalImage = "../images/handouts/" . $handoutId . "_" . $page . ".jpg";
	
	$emptyImage = "../images/empty-image.jpg";
	
	$lockedImage = "../images/locked-image.jpg";
	
	if(file_exists($originalImage)) {
	
		$image = $originalImage;
	
	}
	
	else {
	
		$image = $emptyImage;
	
	}
	
	
	header("Content-type: image/JPG");
	
	if(!$accountDetails["is"]["websiteAdmin"]) {
			
		($page <= $limit or die(readfile($lockedImage)));
		
	}
	
	readfile($image);
	
	exit;
	
 ?>