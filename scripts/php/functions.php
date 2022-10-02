<?php
	
	require_once("connection.php");
	
	require_once("general-info.php");
	
	require_once("methods.php");
	
	$date = date("Y m d");
	
	$time = date("h:i");
		
		
	function relocate($url) {
	
		die('<script> document.location.replace("' . $url . '"); </script>');
	
	}
	
	function alert($text) {
	
		echo('<script> alert("' . $text . '"); </script>');
	
	}
	
	function notify($receiverUsercode, $imageSrc, $link, $text) {
	
		global $conn, $date, $time;
		
		$notificationId = randomDigits(20);
		
		$imageSrc = mysqli_real_escape_string($conn, $imageSrc);
	
		$text = mysqli_real_escape_string($conn, $text);
	
		$link = mysqli_real_escape_string($conn, $link);
	
		$sql = "INSERT INTO notifications (notification_id, receiver_usercode, image_src, text, link, date_sent, time_sent) VALUES ('$notificationId', '$receiverUsercode', '$imageSrc', '$text', '$link', '$date', '$time') ";
		
		if(mysqli_query($conn, $sql)) {
		
			return true;
		
		}
	
	}
	
 ?>