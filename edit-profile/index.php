<?php
	
	$page = array("rootPath" => "../", "title" => "Edit Profile", "restriction" => array("account"));
	
	
	include_once("../scripts/php/functions.php");
	
	include_once("../scripts/php/methods.php");
	
	require_once("../scripts/php/connection.php");
	
	$accountDetails = accountDetails($user["account"]["usercode"]);
	
	
	if(isset($_POST["institution"])) {
	
		$bio = mysqli_real_escape_string($conn, $_POST["bio"]);
	
		$nickname = mysqli_real_escape_string($conn, $_POST["nickname"]);
	
		$institution = mysqli_real_escape_string($conn, $_POST["institution"]);
	
		$department = mysqli_real_escape_string($conn, $_POST["department"]);
	
		$level = mysqli_real_escape_string($conn, $_POST["level"]);
		
		$sql = "UPDATE accounts SET bio = '$bio', nickname = '$nickname', course = '$department', institution = '$institution', level = '$level' WHERE usercode = '" . $user["account"]["usercode"] . "' ";
		
		if(mysqli_query($conn, $sql)) {
		
			alert("Profile updated successfully");
			
			relocate($page["rootPath"] . "profile?id=" . $user["account"]["usercode"]);
		
		}else {echo mysqli_error($conn);}
	
	}
	
	
	include_once($page["rootPath"] . "templates/header.php");
	
?>

    <div class="head-div"> <span style="display: flex; justify-content: center;"> Edit Profile</span></div>
       <br>
       <h4>Edit Profile Picture</h4>
       
     <img style="height: 200px;" src="<?php echo $accountDetails["profilePicture"]; ?>">
		
	<br>
	
	<form method="post" enctype="multipart/form-data" action="<?php echo $page["rootPath"]; ?>scripts/php/image-uploader.php?next=<?php echo urlencode("http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]); ?>&path=<?php echo urlencode("images/profile-pictures/" . $accountDetails["usercode"] . ".jpg"); ?>">
		
       <input type="file" name="profilePicture">
       <input type="submit" type="submit>" value="Upload">
       
       </form>
       
       <form method="post">
       
       <hr>
       <h4>About Me </h4>
       <textarea name="bio" rows=8 cols=40 wrap=virtual><?php echo $accountDetails["bio"]; ?></textarea>
       <hr>
       <label><b>Also Known As</b></label>
       <input type="text" name="nickname" value="<?php echo $accountDetails["nickname"]; ?>"> 
       
       <br><br>

       <label><b>Institution</b></label>
       
  <select name="institution">
    <option value="0">Select Institution :</option>
    
    <?php
    	
    		foreach($website["content"]["institutions"]["ids"] as $eachId) {
    			
    			$institutionDetails = institutionDetails($eachId);
    		
 			echo '<option' . ($institutionDetails["name"] == $accountDetails["institution"] ? ' selected' : '') . '>' . $institutionDetails["name"] . '</option>';
 			
 		}
 		
 	?>
 	
  </select>

       <br><br>

   <label><b>Course of Study</b></label>
   
  <select name="department">
  
    <option value="0">Select your course of study :</option>
    
    <?php
    	
    		foreach($website["content"]["departments"]["ids"] as $eachId) {
    		
    			$departmentDetails = departmentDetails($eachId);
    		
 			echo '<option' . ($departmentDetails["name"] == $accountDetails["course"] ? ' selected' : '') . '>' . $departmentDetails["name"] . '</option>';
 			
 		}
 		
 	?>
 	
  </select>

       <br><br>

       <label><b>Level</b></label>
       
       <br>

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
       

       <p><button class="sub" type="submit>">Submit</button></p>
       
       </form>
       
       
       <script>
       
		$("[name=level][value=<?php echo $accountDetails["level"]; ?>]").attr("checked", "true");
		
       </script>
       
<?php
	
	include($page["rootPath"] . "templates/footer.php");
	
?>