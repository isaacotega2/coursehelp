<?php

	$page = array("rootPath" => "../", "title" => "Admin panel");
	
	include_once("../scripts/php/general-info.php");
	
	include_once("../scripts/php/methods.php");
	
	include_once("templates/bottom-page.php");
	
	//	echo json_encode(accountDetails($user["account"]["usercode"]));
	
?>

<!DOCTYPE html PUBLIC -//W3C//DTD XHTML 1.0 Strict//EN http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd>

<html lang="en">

	<head>
		
		<script src="<?php echo $page["rootPath"]; ?>scripts/js/JQuery.js"></script>

		<script src="scripts/main.js"></script>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
		<meta name=”robots” content="noindex, nofollow">
		
		<title><?php echo ($page["title"] . " - " . $website["name"]); ?></title>
		
		<link rel="stylesheet" type="text/css" href="<?php echo $page["rootPath"]; ?>styles/admin.css">

	</head>
	
	<body>
		
		<div id="header">Admin panel</div>
		
		<br><br><br><br><br><br>

<?php
	
	if(!accountDetails($user["account"]["usercode"])["is"]["websiteAdmin"]) {
		
		include_once("pages/login.php");
		
		die();
	
	}
		

?>

		<div id="main"></div>
		
		<div id="footer">
		
			<div class="item" page="general">
			
				<span id="text">General</span>
			
			</div>
		
			<div class="item" page="handouts">
			
				<span id="text">Handouts</span>
			
			</div>
		
			<div class="item" page="posts">
			
				<span id="text">Posts</span>
			
			</div>
		
		</div>
		
	</body>
	
</html>