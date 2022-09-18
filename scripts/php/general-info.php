<?php
	
	date_default_timezone_set("Africa/Lagos");
	
	$date = date("Y m d");
	
	$time = date("h:i");
		
	require_once("connection.php");
	
//	include_once("functions.php");
	
	$website = array(
		"name"=> "Coursehelp",
		"description" => "Study like a pro.",
		"url" => array(
			"scheme" => "https://",
			"domain" => "coursehelp",
			"extension" => ".com"
		),
		"email" => array(
			"sender" => "mail@coursehelp.com"
		/*	"headers" => "From: mail@theshowglass.com \r\n To: [receiversMail] \r\n MIME-Version: 1.0\r\n Content-Type: text/html; charset=ISO-8859-1\r\n",
			"sender" => "mail@theshowglass.com",
			"maximumSendsNo" => array(
				"emailConfirmation" => 3
			)*/
		),
		"whatsapp" => array(
			"sender" => "+2340000000000"
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
		"constants" => array(
			"unsubscribedHandoutViewLimit" => 7,
			"handoutUnlockPrice" => "₦200",
			"handoutUnlockDuration" => 30
		),
		"bankAccounts" => array(
			"main" => array(
				"name" => "bla bla",
				"number" => "00000000000",
				"bank" => "blo blo"
			)
		),
		"content" => array("forums" => array("ids" => array()), "departments" => array("ids" => array()), "courses" => array("ids" => array()), "institutions" => array("ids" => array()), "topics" => array("ids" => array()), "accounts" => array("usercodes" => array()), "subscriptions" => array("ids" => array()), "funnyWierdQuestions" => array("ids" => array(), "currentId" => 0), "donations" => array("handouts" => array("ids" => array())) )
	);
	
	$sql = "SELECT * FROM donated_handouts";
	
	if($result = mysqli_query($conn, $sql)) {
		
		while($row = mysqli_fetch_array($result)) {
	
			$website["content"]["donations"]["handouts"]["ids"][] = $row["handout_id"];
			
		}
	
	}
	
	$sql = "SELECT * FROM funny_wierd_questions ORDER BY date_posted, time_posted";
	
	if($result = mysqli_query($conn, $sql)) {
		
		$lastId = 0;
		
		while($row = mysqli_fetch_array($result)) {
	
			$website["content"]["funnyWierdQuestions"]["ids"][] = $row["question_id"];
			
			$lastId = $row["question_id"];
			
		}
	
		$website["content"]["funnyWierdQuestions"]["currentId"] = $lastId;
			
	}
	
	$sql = "SELECT * FROM forums";
	
	if($result = mysqli_query($conn, $sql)) {
		
		while($row = mysqli_fetch_array($result)) {
	
			$website["content"]["forums"]["ids"][] = $row["forum_id"];
			
		}
	
	}
	
	$sql = "SELECT * FROM subscriptions";
	
	if($result = mysqli_query($conn, $sql)) {
		
		while($row = mysqli_fetch_array($result)) {
	
			$website["content"]["subscriptions"]["ids"][] = $row["subscription_id"];
			
		}
	
	}
	
	$sql = "SELECT * FROM departments";
	
	if($result = mysqli_query($conn, $sql)) {
		
		while($row = mysqli_fetch_array($result)) {
	
			$website["content"]["departments"]["ids"][] = $row["department_id"];
			
		}
	
	}
	
	$sql = "SELECT * FROM topics ORDER BY date_posted, time_posted";
	
	if($result = mysqli_query($conn, $sql)) {
		
		while($row = mysqli_fetch_array($result)) {
	
			$website["content"]["topics"]["ids"][] = $row["topic_id"];
			
		}
	
	}
	
	$sql = "SELECT * FROM institutions";
	
	if($result = mysqli_query($conn, $sql)) {
		
		while($row = mysqli_fetch_array($result)) {
	
			$website["content"]["institutions"]["ids"][] = $row["institution_id"];
			
		}
	
	}
	
	$sql = "SELECT * FROM courses";
	
	if($result = mysqli_query($conn, $sql)) {
		
		while($row = mysqli_fetch_array($result)) {
	
			$website["content"]["courses"]["ids"][] = $row["course_id"];
			
		}
	
	}
	
	$sql = "SELECT * FROM accounts";
	
	if($result = mysqli_query($conn, $sql)) {
		
		while($row = mysqli_fetch_array($result)) {
	
			$website["content"]["accounts"]["usercodes"][] = $row["usercode"];
			
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
		
		$sql = "UPDATE accounts SET last_active_date = '$date', last_active_time = '$time' WHERE usercode = '" . mysqli_real_escape_string($conn, $user["account"]["usercode"]) . "' ";
		
		mysqli_query($conn, $sql);
		
	}
	
 ?>