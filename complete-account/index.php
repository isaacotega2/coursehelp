<?php
	
	$page = array("rootPath" => "../", "title" => "Complete account", "restriction" => array("account"), "buttonLine" => array("exists" => false));
	
	include_once("../scripts/php/connection.php");
	
	if(isset($_COOKIE["accountCookieCode"])) {
		
		$cookieCode = $_COOKIE["accountCookieCode"];
		
		if(isset($_POST["institution"])) {
		
			$institution = $_POST["institution"];
	
			$course = $_POST["course"];
	
			$level = $_POST["level"];
	
			$sql = "UPDATE accounts SET institution = '$institution', course = '$course', level = '$level' WHERE cookie_code = '$cookieCode' ";
	
			if(mysqli_query($conn, $sql)) {
			
				echo '<script> window.location.href = "success"; </script>';
		
			}
		
	//		else echo mysqli_error($conn);
			
		}
	
	}
	
	else {
	
		echo '<script> window.location.href = "../login"; </script>';
	
	}
	
	include_once("../scripts/php/general-info.php");
	
	include_once("../scripts/php/methods.php");
	
	include_once($page["rootPath"] . "templates/header.php");
	
 ?>
 
<form method="post">
  <h2>Select your Institution</h2>
<!--surround the select box with a "custom-select" DIV element. Remember to set the width:-->
<div>
  <select name="institution">
    <option value="0">Select Institution :</option>
    
    <?php
    	
    		foreach($website["content"]["institutions"]["ids"] as $eachId) {
    		
 			echo '<option>' . institutionDetails($eachId)["name"] . '</option>';
 			
 		}
 		
 	?>
 	
  </select>

</div>


  <h2>Choose your course of study</h2>


  <select name="course">
  
    <option value="0">Select your course of study :</option>
    
    <?php
    	
    		foreach($website["content"]["departments"]["ids"] as $eachId) {
    		
 			echo '<option>' . departmentDetails($eachId)["name"] . '</option>';
 			
 		}
 		
 	?>
 	
  </select>


    <h2>Select Your Level</h2>

       <input type="radio" id="R1" name="level" value="100 Level">
       <label for="R1">100 Level</label> <br>
 
       <input type="radio" id="R2" name="level" value="200 Level">
       <label for="R2">200 Level</label> <br>

       <input type="radio" id="R3" name="level" value="300 Level">
       <label for="R3">300 Level</label> <br>

       <input type="radio" id="R4" name="level" value="400 Level">
       <label for="R4">400 Level</label> <br>

       <input type="radio" id="R5" name="level" value="500 Level">
       <label for="R5">500 Level</label> <br>

       <input type="radio" id="R6" name="level" value="ND 1">
       <label for="R6">ND 1</label> <br>

       <input type="radio" id="R7" name="level" value="ND 2">
       <label for="R7">ND 2</label> <br>

       <input type="radio" id="R8" name="level" value="HND 1">
       <label for="R8">HND 1</label> <br>

       <input type="radio" id="R9" name="level" value="HND 2">
       <label for="R9">HND 2</label> <br>

       <input type="radio" id="R10" name="level" value="Graduate">
       <label for="R10">Graduate</label> <br>

       <input type="radio" id="R11" name="level" value="Post Graduate">
       <label for="R11">Post Graduate</label> <br>

       <input type="radio" id="R12" name="level" value="Guest">
       <label for="R12">Guest</label> <br>
       
       
<div class="button-div">
  <button class="button-1" role="button">Proceed</button>
</div>


</form>

<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>