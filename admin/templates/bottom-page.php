<?php

	$page = array("rootPath" => "../");
	
	include_once("../scripts/php/general-info.php");
	
?>

<div id="bottomPage">

	<div id="background"></div>

	<div id="container"></div>

</div>

<script>

	var bottomPageInfo = {
	page: JSON.parse('<?php echo json_encode($page); ?>')
}

</script>

<script src="<?php echo $page["rootPath"]; ?>admin/scripts/bottom-page.js"></script>