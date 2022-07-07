<?php

	$page = array("rootPath" => "");
	
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
		
	
	$page["title"] = $website["description"];
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>

<br><br>

Home page goes here


<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>