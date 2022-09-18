<?php
	
	function relocate($url) {
	
		die('<script> document.location.replace("' . $url . '"); </script>');
	
	}
	
	function alert($text) {
	
		echo('<script> alert("' . $text . '"); </script>');
	
	}
	
 ?>