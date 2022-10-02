<?php
	
	$page = array("rootPath" => "../../");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	
	$handoutId = $_GET["id"];
	
	$handoutDetails = donatedHandoutDetails($handoutId);
	
	$filename = $handoutDetails["name"] . "_by_" . accountDetails($handoutDetails["donatorUsercode"])["nickname"] . ".zip";
	
	$url = "../archives/" . $filename;
	
	
	header("Content-type: application/zip");
	
	header('Content-Disposition: attachment; filename="' . $filename . '"');
	
	header('Content-Description: File Transfer');
	
	header('Content-Transfer-Encoding: binary');
	
	header('Expires: 0');
	
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	
	header('Pragma: public');
	
	flush();
	
	ob_end_clean();
	
	echo file_get_contents($url);
	
	
	//exit();
	
 ?>