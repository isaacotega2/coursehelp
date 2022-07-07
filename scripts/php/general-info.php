<?php
	
	date_default_timezone_set("Africa/Lagos");
	
	require_once("connection.php");
	
//	include_once("functions.php");
	
	$website = array(
		"name"=> "Coursehelp",
		"description" => "Study like a pro.",
		"url" => array(
			"scheme" => "https://",
			"domain" => "coursehelp.herokuapp",
			"extension" => ".com"
		),
		"email" => array(
		/*	"headers" => "From: mail@theshowglass.com \r\n To: [receiversMail] \r\n MIME-Version: 1.0\r\n Content-Type: text/html; charset=ISO-8859-1\r\n",
			"sender" => "mail@theshowglass.com",
			"maximumSendsNo" => array(
				"emailConfirmation" => 3
			)*/
		),
		"cookies" => array(
			"account" => array(
				"name" => "accountCookieCode",
				"lifetime" => 30
			),
			"admin" => array(
				"name" => "coursehelpAdminCookieCode",
				"lifetime" => 30
			)
		),
		"content" => array("forums" => array("ids" => array()), "mainCourses" => array("ids" => array()), "institutions" => array("ids" => array()))
	);
	
	$sql = "SELECT * FROM forums";
	
	if($result = mysqli_query($conn, $sql)) {
		
		while($row = mysqli_fetch_array($result)) {
	
			$website["content"]["forums"]["ids"][] = $row["forum_id"];
			
		}
	
	}
	
	$sql = "SELECT * FROM main_courses";
	
	if($result = mysqli_query($conn, $sql)) {
		
		while($row = mysqli_fetch_array($result)) {
	
			$website["content"]["mainCourses"]["ids"][] = $row["course_id"];
			
		}
	
	}
	
	$sql = "SELECT * FROM institutions";
	
	if($result = mysqli_query($conn, $sql)) {
		
		while($row = mysqli_fetch_array($result)) {
	
			$website["content"]["institutions"]["ids"][] = $row["institution_id"];
			
		}
	
	}
	
	$user = array(
		"account" => array(
			
		),
		"is" => array(
			"signedIn" => isset($_COOKIE[$website["cookies"]["account"]["name"]])
		)
	);
	
	if($user["is"]["signedIn"]) {
	
		$sql = "SELECT * FROM accounts WHERE cookie_code = '" . mysqli_real_escape_string($conn, $_COOKIE[$website["cookies"]["account"]["name"]]) . "' ";
		
		if($result = mysqli_query($conn, $sql)) {
			
			(mysqli_num_rows($result) > 0) or die( setcookie($website["cookies"]["account"]["name"], "", time() - 1, "/") );
		
			$row = mysqli_fetch_array($result);
			
			$user["account"]["usercode"] = $row["usercode"];
			
		}
		
	}
	
 ?>