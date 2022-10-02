<?php
	
	$page = array("rootPath" => "../../../", "title" => "Donate material", "restriction" => array("account"), "buttonLine" => array("exists" => false), "footer" => array("exists" => false));
	
	
	include_once($page["rootPath"] . "scripts/php/general-info.php");
	
	include_once($page["rootPath"] . "scripts/php/functions.php");
	
	include_once($page["rootPath"] . "scripts/php/methods.php");
	
	require_once($page["rootPath"] . "scripts/php/connection.php");
	
	$date = date("Y m d");
	
	$time = date("h:i");
		
	
	$handoutId = $_GET["id"];
	
    	$accountDetails = accountDetails($user["account"]["usercode"]);
    	
	$handoutDetails = donatedHandoutDetails($handoutId);
	
    	$courseDetails = courseDetails($handoutDetails["courseId"]);
 			
    	$departmentDetails = departmentDetails($courseDetails["departmentId"]);
 			
    	$institutionDetails = institutionDetails($courseDetails["institutionId"]);
    	
    	
	include_once($page["rootPath"] . "templates/header.php");
	
?>

<style>

	[name=name] {
		font-size: 34px;
		width: 94%;
		height: 2cm;
		margin: 0 0 5mm 1%;
		border: none;
		border-bottom: 1px solid black;
		transition: 0.3s;
		background-color: rgba(0, 0, 0, 0);
	}

	[name=name]:focus {
		font-size: 36px;
		box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.5);
	}

	#imageContainer {
		width: 100%;
		text-align: center;
	}

 	#imageContainer .imageHolder {
 		width: 8cm;
		height: 8cm;
 		margin: 1mm;
 		display: inline-block;
 		overflow: scroll;
 		position: relative;
 		box-shadow: 0 0 5px 0 black;
 		overflow: hidden;
 	}
 
 	#imageContainer .imageHolder #image {
 		width: 100%;
 		height: 100%;
 	}
 
 	#imageContainer .imageHolder #page {
 		width: 1cm;
 		height: 1cm;
 		background-color: rgba(0, 0, 0, 0.2);
 		line-height: 1cm;
 		padding: 2mm;
 		position: absolute;
 		bottom: 0;
 		right: 0;
 		color: black;
 		font-weight: 700;
 	}
 	
 	#imageContainer .imageHolder #delete {
 		width: 1cm;
 		height: 1cm;
 		background-color: rgba(0, 0, 0, 0.2);
 		line-height: 1cm;
 		padding: 2mm;
 		position: absolute;
 		top: 0;
 		right: 0;
 		color: red;
 		font-weight: 700;
 	}
 	
 	[type=file] {
 		display: none;
 	}
 	
 	.imageHolder #plus {
 		font-size: 220px;
 	}
 
	#submitButton {
		padding: 1cm 3cm;
		border-radius: 5px;
		font-size: 35px;
		width: 96%;
		background-color: green;
		color: white;
	}
	
	ol {
		text-align: left;
		padding: 1cm 3cm;
	}

</style>

<script>
	
	var handoutId = '<?php echo $handoutId; ?>';
	
</script>

<script src="<?php echo $page["rootPath"]; ?>scripts/js/donate/edit.js"></script>

<h1><?php echo $handoutDetails["name"]; ?></h1>

<br><br>
	
<div class="centerHolder">
	
	<h1>Handout Rejected</h1>
	
	<br>
	
	<p class="statement">Your handout donation has been rejected by the admins of <?php echo $website["name"]; ?> as it does not comply with our <a href="../policy">handout donations policy</a>. Kindly make the following changes to your handout and resubmit for approval.
	
		<ol>
		
			<?php
			
				foreach(explode("\n", $handoutDetails["rejectionMessage"]) as $eachMessage) {
				
					echo '<li>' . $eachMessage . '</li>';
				
				}
			
			?>
		
		</ol>
		
		<div class="centerHolder">
	
			<a href="../edit?id=<?php echo $handoutId; ?>&revive">

				<button id="submitButton" type="submit">Begin making changes</button>
		
			</a>
	
		</div>
	
	</p>
	
</div>



<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>