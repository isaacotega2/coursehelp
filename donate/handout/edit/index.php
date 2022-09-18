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
    	
    	
    	if($handoutDetails["status"] == "approved") {
    	
    		relocate("../approved?id=" . $handoutId);
    	
    	}
    	
    	
    	if(isset($_POST["name"])) {
    		
    		$name = mysqli_real_escape_string($conn, $_POST["name"]);
    	
    		$sql = "UPDATE donated_handouts SET name = '$name' WHERE handout_id = '$handoutId' ";
    		
    		if(mysqli_query($conn, $sql)) {
			
			relocate("?id=" . $handoutId);
			
		}
    	
    	}
 			
    	if(isset($_GET["delete-page"])) {
    	
    		$sql = "UPDATE donated_handouts SET pages_number = (pages_number - 1) WHERE handout_id = '$handoutId' ";
    		
    		if(mysqli_query($conn, $sql)) {
			
			relocate("?id=" . $handoutId);
			
		}
    	
    	}
 			
    	if(isset($_GET["new-page"])) {
    	
    		$sql = "UPDATE donated_handouts SET pages_number = (pages_number + 1) WHERE handout_id = '$handoutId' ";
    		
    		if(mysqli_query($conn, $sql)) {
			
			relocate("?id=" . $handoutId);
			
		}
    	
    	}
 			
    	if(isset($_GET["review"])) {
    	
    		$sql = "UPDATE donated_handouts SET status = 'reviewing' WHERE handout_id = '$handoutId' ";
    		
    		if(mysqli_query($conn, $sql)) {
			
			relocate("?id=" . $handoutId);
			
		}
    	
    	}
 			
	
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

</style>

<script>
	
	var handoutId = '<?php echo $handoutId; ?>';
	
</script>

<script src="<?php echo $page["rootPath"]; ?>scripts/js/donate/edit.js"></script>

<h1> <a href="../"><<</a> Name</h1>

<form method="post" autocomplete="off">
	
	<input name="name" value="<?php echo $handoutDetails["name"]; ?>">
	
</form>

     <?php
     
     	if($handoutDetails["status"] == "reviewing") {
     		
     		echo '
     
<div class="centerHolder">
	
	<h1>Pending review by the admins.</h1> <br> You will be notified once it is reviewed. In the meantime, you can still make any adjustment you wish to make.
	
</div>';

		}
		
	?>


     <br><br>
     
<h1>Pages</h1>

     <div id="imageContainer">
     
     <?php
     
     	for($i = 0; $i < $handoutDetails["pagesNumber"]; $i++) {
     		
     		$index = ($i + 1);
     		
     		echo '
     			
     		<div class="imageHolder" page="' . $index . '"> 
     		
     			<label class="holder" for="input' . $index . '">
     	
  				<img alt="' . $handoutDetails["name"] . ' >> page ' . $index . '. ' . $departmentDetails["name"] . ' department" src="' . $page["rootPath"] . 'handout-page?id=' . $handoutId . '&page=' . $index . '" id="image"><!img>
  				
  			 ' . (($index == $handoutDetails["pagesNumber"]) ? ('<a href="?id=' . $handoutId . '&delete-page"> <span id="delete">x</span> </a>') : '') . '
  			   
  			 <span id="page">' . $index . '</span>
  			   
  			  </label>
  			  
  			  <input type="file" id="input' . $index . '">
  			  
  			  </div>

    			';
    			
     	}
     	
     ?>
     	<a href="?id=<?php echo $handoutId; ?>&new-page">
     	
     		<div class="imageHolder"> 
     		
  				 <span id="plus">+</span>
  			   
  			  </div>
  			  
  		 </a>

     </div>
     
     <?php
     
     	if($handoutDetails["status"] == "building") {
     		
     		echo '
     
<div class="centerHolder">
	
	<a href="?id=' . $handoutId . '&review">

		<button id="submitButton" type="submit">Submit for review</button>
		
	</a>
	
</div>';

		}
		
	?>



<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>